<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'username' => $this->faker->unique()->userName,
            'password' => bcrypt('password'), // Atau Anda bisa menggunakan Hash::make('password')
            'id_level' => 7, // Sesuai permintaan bahwa id_level adalah 7
        ];
    }
}
