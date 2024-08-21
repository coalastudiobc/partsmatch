<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            CmsPageSeeder::class,
            CommissionSeeder::class,
            PermissionsSeeder::class,
            AdminSettingSeeder::class,
            CountrySeeder::class,
            StateSeeder::class,
            CitySeeder::class,
            BrandSeeder::class,
            CarYearSeeder::class,
            CarAllMakeSeeder::class,
            AllModelSeeder::class,
            PostalCodesSeeder::class,
        ]);
    }
}
