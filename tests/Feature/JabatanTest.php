<?php

namespace Tests\Feature;

use App\Models\Level;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class JabatanTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->siapkanDataWilayah();
    }

    public function test_rw_bisa_mengangkat_warga_menjadi_rw(): void
    {
        $rw = $this->buatPengguna('RW');
        $warga = $this->buatPengguna('WRG');

        $this->actingAs($rw)
            ->from(route('warga.show', ['id' => $warga->warga->id_warga]))
            ->put(route('user.update', ['id' => $warga->id_user]), [
                'username' => $warga->username,
                'id_level' => Level::where('level_kode', 'RW')->value('id_level'),
                'periode_jabatan_awal' => '2026-01-01',
                'periode_jabatan_akhir' => '2029-01-01',
            ])
            ->assertSessionHasNoErrors();

        $this->assertEquals('RW', $warga->fresh()->level->level_kode);
        $this->assertEquals('2026-01-01', $warga->fresh()->warga->periode_jabatan_awal);
    }

    public function test_jabatan_tidak_tersimpan_jika_periode_kosong(): void
    {
        $rw = $this->buatPengguna('RW');
        $warga = $this->buatPengguna('WRG');

        $this->actingAs($rw)
            ->put(route('user.update', ['id' => $warga->id_user]), [
                'username' => $warga->username,
                'id_level' => Level::where('level_kode', 'RW')->value('id_level'),
            ])
            ->assertSessionHasErrors(['periode_jabatan_awal', 'periode_jabatan_akhir']);

        $this->assertEquals('WRG', $warga->fresh()->level->level_kode);
    }

    public function test_periode_akhir_tidak_boleh_sebelum_periode_awal(): void
    {
        $rw = $this->buatPengguna('RW');
        $warga = $this->buatPengguna('WRG');

        $this->actingAs($rw)
            ->put(route('user.update', ['id' => $warga->id_user]), [
                'username' => $warga->username,
                'id_level' => Level::where('level_kode', 'RW')->value('id_level'),
                'periode_jabatan_awal' => '2029-01-01',
                'periode_jabatan_akhir' => '2026-01-01',
            ])
            ->assertSessionHasErrors('periode_jabatan_akhir');

        $this->assertEquals('WRG', $warga->fresh()->level->level_kode);
    }

    public function test_rt_tidak_menyimpan_jabatan_rt_jika_periode_kosong(): void
    {
        $ketuaRt1 = $this->buatPengguna('RT1', '01');
        $warga = $this->buatPengguna('WRG', '01');

        $this->actingAs($ketuaRt1)
            ->put(route('wargauser-admin.update', ['rt' => 1, 'id' => $warga->id_user]), [
                'username' => $warga->username,
                'id_level' => Level::where('level_kode', 'RT1')->value('id_level'),
            ])
            ->assertSessionHasErrors('periode_jabatan_awal');

        $this->assertEquals('WRG', $warga->fresh()->level->level_kode);
    }
}
