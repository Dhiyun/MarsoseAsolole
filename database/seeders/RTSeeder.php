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
                'no_rt' => 'RT1',
                'id_rw' => 1,
            ],
            [
                'no_rt' => 'RT2',
                'id_rw' => 1,
            ],
            [
                'no_rt' => 'RT3',
                'id_rw' => 1,
            ],
            [
                'no_rt' => 'RT4',
                'id_rw' => 1, 
            ],
            [
                'no_rt' => 'RT5',
                'id_rw' => 1,
            ],
        ];

        DB::table('rt')->insert($rtData);
    }
}
