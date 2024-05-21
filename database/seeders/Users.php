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
                'username' => '1234567890123456',
                'password' => bcrypt('password1'),
                'id_level' => 9,
            ],
        ];

        DB::table('user')->insert($users);
    }
}
