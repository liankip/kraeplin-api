<?php

namespace Database\Seeders;

use App\Models\Student;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentKraeplinTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        $idStudent = Student::pluck('id')->all();

        foreach ($idStudent as $id_student) {
            DB::table('student_kreaplin_tests')->insert([
                'id_student' => $id_student,
                'id_kraeplin_schedule' => rand(1, 3),
                'start' => $faker->dateTimeBetween('-10 years', 'now'),
                'finish' => $faker->dateTimeBetween('-10 years', 'now'),
                'right_count' => $faker->numberBetween(20, 40),
                'false_count' => $faker->numberBetween(0, 10),
                'duration' => $faker->randomElement([60, 1800]),
            ]);
        }
    }
}
