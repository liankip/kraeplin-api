<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DefaultAdmin extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            [
                'name' => 'admin',
                'username' => 'admin',
                'password' => bcrypt('password'),
            ],
            [
                'name' => 'entry',
                'username' => 'entry',
                'password' => bcrypt('password'),
            ]
        ]);
    }
}
