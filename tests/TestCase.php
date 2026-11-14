<?php

namespace Tests;

use App\Models\Level;
use App\Models\RT;
use App\Models\RW;
use App\Models\Users;
use App\Models\Warga;
use Database\Seeders\LevelSeeder;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Hash;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function siapkanDataWilayah(): void
    {
        $this->seed(LevelSeeder::class);

        $rw = RW::create(['no_rw' => '03']);

        foreach (['01', '02', '03', '04', '05'] as $noRt) {
            RT::create(['no_rt' => $noRt, 'id_rw' => $rw->id_rw]);
        }
    }

    protected function buatPengguna(string $levelKode, string $noRt = '01', ?string $password = null): Users
    {
        $username = fake()->unique()->numerify('################');

        $user = Users::create([
            'username' => $username,
            'password' => Hash::make($password ?? 'rahasia123'),
            'id_level' => Level::where('level_kode', $levelKode)->value('id_level'),
        ]);

        Warga::create([
            'nik' => $username,
            'nama' => fake()->name(),
            'jenis_kelamin' => 'laki-laki',
            'tempat_lahir' => 'Malang',
            'tanggal_lahir' => '1990-01-01',
            'agama' => 'Islam',
            'alamat' => 'Jl. Marsose',
            'no_rt' => $noRt,
            'status_keluarga' => 'lainnya',
            'status_kependudukan' => 'asli',
            'id_user' => $user->id_user,
        ]);

        return $user;
    }
}
