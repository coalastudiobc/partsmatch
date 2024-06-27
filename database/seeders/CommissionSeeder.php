<?php

namespace Database\Seeders;

use App\Models\Commission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $commission = [
            "value" => "15",
            "type" => "Percentage",
        ];
        Commission::insert($commission);
    }
}
