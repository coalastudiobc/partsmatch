<?php

namespace Database\Seeders;

use App\Models\AllModel;
use App\Models\CarMake;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AllModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    protected $sdk;

    public function run()
    {
        $this->initializeSdk();
        $this->authenticateSdk();
        $this->processData();
    }

    protected function initializeSdk()
    {
        $this->sdk = \CarApiSdk\CarApi::build([
            'token' => env('CAR_API_TOKEN'),
            'secret' => env('CAR_API_SECRET'),
        ]);
    }

    protected function authenticateSdk()
    {
        $filePath = storage_path('app/text.txt');
        $jwt = file_exists($filePath) ? file_get_contents($filePath) : null;

        if (empty($jwt) || $this->sdk->loadJwt($jwt)->isJwtExpired()) {
            try {
                $jwt = $this->sdk->authenticate();
                file_put_contents($filePath, $jwt);
            } catch (\CarApiSdk\CarApiException $e) {
                Log::channel('daily')->error("SDK Authentication Error: " . $e->getMessage());
                return;
            }
        }
    }

    protected function processData()
    {
        $array = [];
        $carmakes = CarMake::get();

        foreach ($carmakes as $carmake) {
            $models = $this->sdk->models([
                'query' => [
                    'year' => $carmake->carYear->years,
                    'make' => $carmake->make_value,
                ]
            ]);
            $modeldata = $models->data;

            foreach ($modeldata as $model) {
                array_push($array, ['make_table_id' => $carmake->id, 'model_id' => $model->id, 'value' => $model->name]);
            }
        }
        $this->insertDataInChunks($array);
    }

    protected function insertDataInChunks($array)
    {
        $chunks = array_chunk($array, 1000);
        DB::beginTransaction();
        try {
            foreach ($chunks as $chunk) {
                AllModel::insert($chunk);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            Log::channel('daily')->error("Database Insertion Error: " . $e->getMessage());
        }
    }
}
