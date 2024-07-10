<?php

namespace Database\Seeders;

use CarApiSdk\CarApi;
use App\Models\CarBrandMake;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CarMakeSeeder extends Seeder
{
    public $sdk;
    public function __construct()
    {
        $this->sdk = \CarApiSdk\CarApi::build([
            'token' => "1e9f178a-f016-4aa9-b582-99934fc52ff9",
            'secret' => "37e149448eeae0e28026dcdbaea8d8c7",
        ]);
        $filePath = storage::path('text.txt');
        $jwt = file_get_contents($filePath);
        if (empty($jwt) || $this->sdk->loadJwt($jwt)->isJwtExpired() !== false) {
            try {
                $jwt = $this->sdk->authenticate();
                file_put_contents($filePath, $jwt);
            } catch (\CarApiSdk\CarApiException $e) {
                // handle errors here
                Log::channel('daily')->info("error:" . $e->getMessage());
            }
        }
    }
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [];
        $years = $this->sdk->years();
        $processedMakes = [];
        $realData = [];
        $index = 1;

        foreach ($years as $year) {
            $makes = $this->sdk->makes(['query' => ['year' => $year]]);

            foreach ($makes->data as $make) {
                if (!in_array($make->name, $processedMakes)) {
                    // $data[$index++] = $make->name;
                    $rowData = [
                        'makes' => $make->name,
                        'image_url' => asset('assets/images/car-logo6.png'),
                        'image_name' => 'car-logo6',
                    ];

                    // Add to $realData array
                    $realData[] = $rowData;

                    // Mark the make as processed
                    $processedMakes[] = $make->name;
                    $processedMakes[] = $make->name;
                }
            }
        }
       
        CarBrandMake::insert($realData);
    }
}
