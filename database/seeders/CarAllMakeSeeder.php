<?php

namespace Database\Seeders;

use App\Models\CarMake;
use CarApiSdk\CarApi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CarAllMakeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    protected $sdk;
    
    public function run(): void
    {
        $this->initializeSdk();
        $this->authenticateSdk();
        $this->processData();
    }
    protected function initializeSdk()
    {
        $this->sdk = CarApi::build([
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
        $years = $this->sdk->years();
        foreach ($years as $yearkey => $value) {
            $models = $this->sdk->makes(['query' => ['year' => $value]]);
            $modeldata = $models->data;

            foreach ($modeldata as $value) {
                // $array[['year_id' => $yearkey, 'make_id' => $value->id, 'make_value' => $value->name]];
                array_push($array, ['year_id' => $yearkey + 1, 'make_id' => $value->id, 'value' => $value->name]);
            }
        }
        $this->insertDataMake($array);
    }
    protected function insertDataMake($array)
    {
        DB::beginTransaction();
        try {
            CarMake::insert($array);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            Log::channel('daily')->error("Database Insertion Error: " . $e->getMessage());
        }
    }
}
