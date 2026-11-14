<?php

namespace Tests\Feature;

use App\Models\Level;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AksesRtTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->siapkanDataWilayah();
    }

    private function dataWarga(string $nik, string $nama): array
    {
        return [
            'nik' => $nik,
            'nama' => $nama,
            'jenis_kelamin' => 'laki-laki',
            'tempat_lahir' => 'Malang',
            'tanggal_lahir' => '1990-01-01',
            'agama' => 'Islam',
            'alamat' => 'Jl. Marsose',
            'status_keluarga' => 'lainnya',
            'status_kependudukan' => 'asli',
        ];
    }

    public function test_rt_tidak_bisa_membuka_halaman_rt_lain(): void
    {
        $ketuaRt1 = $this->buatPengguna('RT1', '01');

        $this->actingAs($ketuaRt1)
            ->get(route('admin.index', ['rt' => 2]))
            ->assertRedirect('/login');
    }

    public function test_rt_tidak_bisa_mengubah_warga_rt_lain(): void
    {
        $ketuaRt1 = $this->buatPengguna('RT1', '01');
        $wargaRt3 = $this->buatPengguna('WRG', '03')->warga;

        $this->actingAs($ketuaRt1)
            ->put(route('warga-admin.update', ['rt' => 1, 'id' => $wargaRt3->id_warga]), $this->dataWarga($wargaRt3->nik, 'Diubah RT 1'))
            ->assertRedirect(route('admin.index', ['rt' => 1]));

        $this->assertDatabaseHas('warga', [
            'id_warga' => $wargaRt3->id_warga,
            'nama' => $wargaRt3->nama,
            'no_rt' => '03',
        ]);
    }

    public function test_rt_tidak_bisa_menghapus_warga_rt_lain(): void
    {
        $ketuaRt1 = $this->buatPengguna('RT1', '01');
        $wargaRt3 = $this->buatPengguna('WRG', '03')->warga;

        $this->actingAs($ketuaRt1)
            ->delete(route('warga-admin.destroy', ['rt' => 1, 'id' => $wargaRt3->id_warga]))
            ->assertRedirect(route('admin.index', ['rt' => 1]));

        $this->actingAs($ketuaRt1)
            ->post(route('warga-admin.deleteSelected', ['rt' => 1]), ['selectedIds' => json_encode([$wargaRt3->id_warga])]);

        $this->assertDatabaseHas('warga', ['id_warga' => $wargaRt3->id_warga]);
    }

    public function test_rt_bisa_mengubah_warga_rt_sendiri_dengan_format_nomor_rt_konsisten(): void
    {
        $ketuaRt1 = $this->buatPengguna('RT1', '01');
        $wargaRt1 = $this->buatPengguna('WRG', '01')->warga;

        $this->actingAs($ketuaRt1)
            ->put(route('warga-admin.update', ['rt' => 1, 'id' => $wargaRt1->id_warga]), $this->dataWarga($wargaRt1->nik, 'Nama Baru'))
            ->assertRedirect(route('warga-admin.index', ['rt' => 1]));

        $this->assertDatabaseHas('warga', [
            'id_warga' => $wargaRt1->id_warga,
            'nama' => 'Nama Baru',
            'no_rt' => '01',
        ]);
    }

    public function test_rt_tidak_bisa_memberi_jabatan_rw(): void
    {
        $ketuaRt1 = $this->buatPengguna('RT1', '01');
        $wargaRt1 = $this->buatPengguna('WRG', '01');

        $this->actingAs($ketuaRt1)
            ->put(route('wargauser-admin.update', ['rt' => 1, 'id' => $wargaRt1->id_user]), [
                'username' => $wargaRt1->username,
                'id_level' => Level::where('level_kode', 'RW')->value('id_level'),
            ])
            ->assertSessionHasErrors('id_level');

        $this->assertEquals('WRG', $wargaRt1->fresh()->level->level_kode);
    }
}
