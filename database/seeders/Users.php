<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Users extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'username' => '123',
                'password' => bcrypt('admin'),
                'id_level' => 1,
            ],
            [
                'username' => '234',
                'password' => bcrypt('admin'),
                'id_level' => 2,
            ],
            [
                'username' => '345',
                'password' => bcrypt('admin'),
                'id_level' => 7,
            ],
        ];

        DB::table('user')->insert($users);
    }
}
