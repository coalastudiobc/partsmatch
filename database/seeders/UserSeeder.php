<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::firstOrCreate([ 'name' =>  'Dealer' ]);
        Role::firstOrCreate([ 'name' =>  'Manager' ]);
        Role::firstOrCreate([ 'name' =>  'User' ]);
        Role::firstOrCreate([ 'name' =>  'Administrator' ]);
        $user =['name' => 'Admin', 'status' => 'APPROVED', 'email' => 'admin@gmail.com', 'email_verified_at' => '2024-02-16 17:46:29' ,'password' => Hash::make('Shine@123')];

        $user = User::create($user);
        $user->assignRole(['Administrator']);
    }
}
