<?php

namespace Database\Factories;

use App\Models\Warga;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class WargaFactory extends Factory
{
    protected $model = Warga::class;

    public function definition()
    {
        return [
            'nik' => $this->faker->unique()->numerify('################'),
            'nama' => $this->faker->name,
            'jenis_kelamin' => $this->faker->randomElement(['perempuan', 'laki-laki']),
            'tempat_lahir' => $this->faker->city,
            'tanggal_lahir' => $this->faker->date,
            'alamat' => 'jalan marsose Kesatrian no. ' . $this->faker->numberBetween(1, 200) . ', Blimbing, Kota Malang',
            'agama' => $this->faker->randomElement(['Islam', 'Kristen', 'Hindu', 'Budha', 'Katolik', 'Konghucu']),
            'no_rt' => $this->faker->randomElement(['RT01', 'RT02', 'RT03', 'RT04', 'RT05']),
            'status' => $this->faker->randomElement(['pendatang', 'asli']),
            'periode_jabatan_awal' => null,
            'periode_jabatan_akhir' => null,
            'id_user' => null, // Kita atur manual di seeder
            'id_kk' => null, // Kita atur manual di seeder
        ];
    }
}
