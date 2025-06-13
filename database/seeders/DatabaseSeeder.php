<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            DefaultAdmin::class,
            StudentSeeder::class,
            GroupSeeder::class,
            KraeplinSeeder::class,
            KraeplinScheduleSeeder::class,
            KraeplinScheduleGroupSeeder::class,
            StudentKraeplinTestSeeder::class,
            RolePermissionSeeder::class,
        ]);
    }
}
