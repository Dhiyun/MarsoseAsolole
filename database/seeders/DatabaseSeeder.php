<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Warga;
use App\Models\User;
use Database\Seeders\LaporanSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        // $this->call([
        //     // UserSeeder::class,
        //     WargaSeeder::class,
        // ]);
        // User::factory()->count(3)->create();
        // $startUserId = 5; // Mulai dari 4

        // Warga::factory()->count(3)->make()->each(function($warga) use (&$startUserId) {
        //     $warga->id_user = $startUserId++;
        //     $warga->save();
        // });
        $this->call([
            KriteriasTableSeeder::class,
            DetailKriteriaSeeder::class,
            LevelSeeder::class,
            RWSeeder::class,
            RTSeeder::class,
            UserSeeder::class,
            WargaSeeder::class,
            // LaporanSeeder::class,
        ]);
    }
    
}
