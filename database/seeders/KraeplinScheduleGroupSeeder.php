<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KraeplinScheduleGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        for ($i = 0; $i < 5; $i++) {
            DB::table('kraeplin_schedule_groups')->insert([
                'id_group' => $faker->randomElement([1, 2, 3]),
                'id_kraeplin_schedule' => $faker->randomElement([1, 2, 3, 4, 5]),
            ]);
        }
    }
}
