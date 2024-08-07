<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use CarApiSdk\CarApi;
use App\Models\CarBrandMake;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BrandSeeder extends Seeder
{
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
        $processedMakes = [];
        $realData = [];

        foreach ($this->sdk->years() as $year) {
            $makes = $this->sdk->makes(['query' => ['year' => $year]]);

            foreach ($makes->data as $make) {
                if (!in_array($make->name, $processedMakes, true)) {
                    $realData[] = [
                        'makes' => $make->name,
                        'image_url' => null,
                        'image_name' => 'car-logo6',
                    ];

                    $processedMakes[] = $make->name;
                }
            }
        }
        $this->insertDataMake($realData);
    }

    protected function insertDataMake($realData)
    {
        DB::beginTransaction();
        try {
            if (!empty($realData)) {
                CarBrandMake::insert($realData);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            Log::channel('daily')->error("Database Insertion Error: " . $e->getMessage());
        }
    }
}
