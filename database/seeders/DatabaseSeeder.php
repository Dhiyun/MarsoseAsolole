<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        // Warga::factory()->count(50)->create();
        // Seed the application's database.
        $this->call([
            KriteriasTableSeeder::class,
            DetailKriteriaSeeder::class,
            LevelSeeder::class,
            RWSeeder::class,
            RTSeeder::class,
            Users::class,
            WargaSeeder::class,
            
        ]);
    }
    
}
