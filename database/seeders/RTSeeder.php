<?php

namespace Database\Seeders;

use App\Models\RT;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RTSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rtData = [
            [
                'no_rt' => '01',
                'id_rw' => 1,
            ],
            [
                'no_rt' => '02',
                'id_rw' => 1,
            ],
            [
                'no_rt' => '03',
                'id_rw' => 1,
            ],
            [
                'no_rt' => '04',
                'id_rw' => 1, 
            ],
            [
                'no_rt' => '05',
                'id_rw' => 1,
            ],
        ];

        DB::table('rt')->insert($rtData);
    }
}
