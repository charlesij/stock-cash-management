<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Superadmin',
            'username' => 'superadmin',
            'email' => 'superadmin@gmail.com',
            'password' => Hash::make('superadmin123'),
            'access_id' => 1,
        ]);

        User::create([
            'name' => 'Charles',
            'username' => 'dedaunan',
            'email' => 'dedaunan@gmail.com',
            'password' => Hash::make('hapus123'),
            'access_id' => 1,
        ]);

        User::create([
            'name' => 'Wantos',
            'username' => 'wantos',
            'email' => 'wantos@gmail.com',
            'password' => Hash::make('wantos123'),
            'access_id' => 1,
        ]);

        User::create([
            'name' => 'Owner',
            'username' => 'owner',
            'email' => 'owner@gmail.com',
            'password' => Hash::make('owner123'),
            'access_id' => 2,
        ]);

        User::create([
            'name' => 'Cashier',
            'username' => 'cashier-1',
            'email' => 'cashier-1@gmail.com',
            'password' => Hash::make('cashier123'),
            'access_id' => 3,
        ]);
    }
}
