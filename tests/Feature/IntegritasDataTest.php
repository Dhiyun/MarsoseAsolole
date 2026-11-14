<?php

namespace Tests\Feature;

use App\Models\KK;
use App\Models\LaporanPengaduan;
use App\Models\RT;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IntegritasDataTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->siapkanDataWilayah();
    }

    private function buatKeluarga(string $noKk = '3573000000000001'): array
    {
        $kk = KK::create([
            'no_kk' => $noKk,
            'alamat' => 'Jl. Marsose No. 1',
            'id_rt' => RT::where('no_rt', '01')->value('id_rt'),
        ]);

        $anak = $this->buatPengguna('WRG', '01')->warga;
        $anak->update(['id_kk' => $kk->id_kk, 'status_keluarga' => 'anak', 'nama' => 'Nama Anak']);

        $kepala = $this->buatPengguna('WRG', '01')->warga;
        $kepala->update(['id_kk' => $kk->id_kk, 'status_keluarga' => 'kepala_keluarga', 'nama' => 'Nama Kepala']);

        return [$kk, $kepala, $anak];
    }

    public function test_nama_kepala_keluarga_diambil_dari_data_warga(): void
    {
        [$kk] = $this->buatKeluarga();

        $this->assertEquals('Nama Kepala', $kk->fresh()->kepala_keluarga);
    }

    public function test_edit_kk_mengubah_kepala_keluarga_bukan_anggota_pertama(): void
    {
        [$kk, $kepala, $anak] = $this->buatKeluarga();
        $ketuaRt1 = $this->buatPengguna('RT1', '01');

        $this->actingAs($ketuaRt1)
            ->put(route('kk-admin.update', ['rt' => 1, 'id' => $kk->id_kk]), [
                'no_kk' => $kk->no_kk,
                'kepala_keluarga' => 'Kepala Baru',
                'alamat' => 'Jl. Marsose No. 2',
                'nik' => $kepala->nik,
                'jenis_kelamin' => 'laki-laki',
                'tempat_lahir' => 'Malang',
                'tanggal_lahir' => '1980-01-01',
                'agama' => 'Islam',
            ])
            ->assertSessionHasNoErrors();

        $this->assertEquals('Kepala Baru', $kepala->fresh()->nama);
        $this->assertEquals('Nama Anak', $anak->fresh()->nama);
        $this->assertEquals('Kepala Baru', $kk->fresh()->kepala_keluarga);
    }

    public function test_warga_yang_punya_laporan_tidak_terhapus_sebagian(): void
    {
        [$kk, $kepala] = $this->buatKeluarga();
        $ketuaRt1 = $this->buatPengguna('RT1', '01');

        LaporanPengaduan::create([
            'judul' => 'Jalan rusak',
            'jenis_laporan' => 'Infrastruktur',
            'keterangan' => 'Lubang besar',
            'status' => 'menunggu',
            'id_warga' => $kepala->id_warga,
        ]);

        $this->actingAs($ketuaRt1)
            ->delete(route('warga-admin.destroy', ['rt' => 1, 'id' => $kepala->id_warga]))
            ->assertSessionHas('error');

        $this->assertDatabaseHas('warga', ['id_warga' => $kepala->id_warga]);
        $this->assertDatabaseHas('user', ['id_user' => $kepala->id_user]);
        $this->assertDatabaseHas('kk', ['id_kk' => $kk->id_kk]);
        $this->assertDatabaseCount('laporan_pengaduan', 1);
    }

    public function test_rt_yang_masih_punya_kk_tidak_bisa_dihapus(): void
    {
        $this->buatKeluarga();

        $this->expectException(QueryException::class);

        RT::where('no_rt', '01')->delete();
    }
}
