<?php

namespace Database\Seeders;

use App\Models\AdminSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminsetting = [
            ["name" => "STRIPE_KEY", "value" => null],
            ["name" => "STRIPE_SECRET", "value" => null],
            ["name" => "order_commission_type", "value" => null],
            ["name" => "order_commission", "value" => null],
            ["name" => "shipping_charge_type", "value" => null],
            ["name" => "shipping_charge", "value" => null],
        ];
        AdminSetting::insert($adminsetting);
    }
}
