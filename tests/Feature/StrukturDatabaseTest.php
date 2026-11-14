<?php

namespace Tests\Feature;

use App\Models\Jabatan;
use App\Models\KK;
use App\Models\LaporanPengaduan;
use App\Models\Level;
use App\Models\RT;
use App\Models\RW;
use App\Models\Warga;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StrukturDatabaseTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->siapkanDataWilayah();
    }

    private function idRt(string $noRt): int
    {
        return RT::where('no_rt', $noRt)->value('id_rt');
    }

    public function test_rt_dan_alamat_warga_mengikuti_kk_saat_dimasukkan_ke_kk(): void
    {
        $kk = KK::create(['no_kk' => '3573000000000001', 'alamat' => 'Jl. KK No. 1', 'id_rt' => $this->idRt('02')]);
        $warga = $this->buatPengguna('WRG', '05')->warga;

        $warga->update(['id_kk' => $kk->id_kk]);

        $this->assertEquals('02', $warga->fresh()->no_rt);
        $this->assertEquals('Jl. KK No. 1', $warga->fresh()->alamat);
    }

    public function test_anggota_kk_ikut_pindah_saat_rt_atau_alamat_kk_diubah(): void
    {
        $kk = KK::create(['no_kk' => '3573000000000001', 'alamat' => 'Jl. Lama', 'id_rt' => $this->idRt('01')]);
        $anggota = $this->buatPengguna('WRG', '01')->warga;
        $anggota->update(['id_kk' => $kk->id_kk]);
        $bukanAnggota = $this->buatPengguna('WRG', '01')->warga;

        $kk->update(['id_rt' => $this->idRt('04'), 'alamat' => 'Jl. Baru']);

        $this->assertEquals('04', $anggota->fresh()->no_rt);
        $this->assertEquals('Jl. Baru', $anggota->fresh()->alamat);
        $this->assertEquals('01', $bukanAnggota->fresh()->no_rt);
    }

    public function test_warga_tanpa_kk_tetap_punya_rt_sendiri(): void
    {
        $warga = $this->buatPengguna('WRG', '03')->warga;

        $this->assertNull($warga->id_kk);
        $this->assertEquals('03', $warga->fresh()->no_rt);
    }

    public function test_riwayat_jabatan_tersimpan_di_tabel_jabatan(): void
    {
        $rw = $this->buatPengguna('RW');
        $warga = $this->buatPengguna('WRG');
        $idRw = Level::where('level_kode', 'RW')->value('id_level');
        $idWarga = Level::where('level_kode', 'WRG')->value('id_level');

        $this->actingAs($rw)->put(route('user.update', ['id' => $warga->id_user]), [
            'username' => $warga->username,
            'id_level' => $idRw,
            'periode_jabatan_awal' => '2020-01-01',
            'periode_jabatan_akhir' => '2023-01-01',
        ])->assertSessionHasNoErrors();

        $this->actingAs($rw)->put(route('user.update', ['id' => $warga->id_user]), [
            'username' => $warga->username,
            'id_level' => $idRw,
            'periode_jabatan_awal' => '2023-01-01',
            'periode_jabatan_akhir' => '2026-01-01',
        ])->assertSessionHasNoErrors();

        $this->assertEquals(2, Jabatan::where('id_warga', $warga->warga->id_warga)->count());
        $this->assertEquals('2023-01-01', $warga->warga->fresh()->periode_jabatan_awal);

        $this->actingAs($rw)->put(route('user.update', ['id' => $warga->id_user]), [
            'username' => $warga->username,
            'id_level' => $idWarga,
        ])->assertSessionHasNoErrors();

        $this->assertEquals(2, Jabatan::where('id_warga', $warga->warga->id_warga)->count());
        $this->assertEquals('WRG', $warga->fresh()->level->level_kode);
    }

    public function test_jenis_laporan_di_luar_daftar_ditolak(): void
    {
        $warga = $this->buatPengguna('WRG');

        $this->actingAs($warga)
            ->post(route('user-laporan.store'), [
                'judul' => 'Laporan',
                'jenis_laporan' => 'kerusakan jalan',
                'keterangan' => 'Keterangan',
            ])
            ->assertSessionHasErrors('jenis_laporan');

        $this->expectException(QueryException::class);

        LaporanPengaduan::create([
            'judul' => 'Laporan',
            'jenis_laporan' => 'Jalan Rusak',
            'keterangan' => 'Keterangan',
            'status' => 'menunggu',
            'id_warga' => $warga->warga->id_warga,
        ]);
    }

    public function test_satu_akun_hanya_untuk_satu_warga(): void
    {
        $warga = $this->buatPengguna('WRG')->warga;

        $this->expectException(QueryException::class);

        Warga::create([
            'nik' => '9999999999999999',
            'nama' => 'Warga Lain',
            'tempat_lahir' => 'Malang',
            'tanggal_lahir' => '1990-01-01',
            'agama' => 'Islam',
            'alamat' => 'Jl. Marsose',
            'no_rt' => '01',
            'id_user' => $warga->id_user,
        ]);
    }

    public function test_nomor_rt_unik_per_rw(): void
    {
        $rwLain = RW::create(['no_rw' => '04']);

        RT::create(['no_rt' => '01', 'id_rw' => $rwLain->id_rw]);
        $this->assertEquals(2, RT::where('no_rt', '01')->count());

        $this->expectException(QueryException::class);

        RT::create(['no_rt' => '01', 'id_rw' => $rwLain->id_rw]);
    }
}
