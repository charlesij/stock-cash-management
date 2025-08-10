<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            UserAccessSeeder::class,
        ]);

        if (env('APP_DEBUG') == 'true') {
            $this->call([
                PostDevelopmentSeeder::class,
            ]);
        }
    }
}
