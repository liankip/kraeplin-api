<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        for ($i = 0; $i < 50; $i++) {
            DB::table('students')->insert([
                'id_group' => $faker->randomElement([1, 2, 3]),
                'username' => $faker->unique()->userName,
                'password' => Hash::make('password123'),
                'name' => $faker->name,
                'nisn' => $faker->unique()->numerify('##########'),
            ]);
        }
    }
}
