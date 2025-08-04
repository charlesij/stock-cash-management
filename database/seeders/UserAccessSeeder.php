<?php

namespace Database\Seeders;

use App\Models\UserAccess;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserAccessSeeder extends Seeder
{
    public function run(): void
    {
        UserAccess::create([
            'access_name' => 'superadmin',
            'access_menu' => json_encode([
                'dashboard' => [
                    'access-menu' => true,
                    'overview' => true,
                ],
                'user' => [
                    'access-menu' => true,
                    'user-management' => true,
                ],
                'product' => [
                    'access-menu' => true,
                ],
                'transaction' => [
                    'access-menu' => true,
                    'transaction-management' => true,
                ],
                'report' => [
                    'access-menu' => true,
                ],
                'setting' => [
                    'access-menu' => true,
                    'setting-management' => true,
                ],
            ]),
            'access_description' => 'Superadmin access all menu',
            'access_status' => 1,
        ]);
    }
}
