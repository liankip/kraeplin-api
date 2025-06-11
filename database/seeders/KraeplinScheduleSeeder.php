<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KraeplinScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        for ($i = 0; $i < 5; $i++) {
            DB::table('kraeplin_schedules')->insert([
                'id_kraeplin' => $faker->randomElement([1, 2, 3, 4, 5]),
                'date' => $faker->dateTime($max = 'now', $timezone = null),
            ]);
        }
    }
}
