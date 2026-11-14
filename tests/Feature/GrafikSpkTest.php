<?php

namespace Tests\Feature;

use App\Models\LaporanPengaduan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class GrafikSpkTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->siapkanDataWilayah();
    }

    private function siapkanPenilaian(): void
    {
        $pelapor = $this->buatPengguna('WRG')->warga;
        $idKriteria = DB::table('kriterias')->insertGetId(['nama_kriteria' => 'Dampak', 'jenis_kriteria' => 'Benefit']);

        DB::table('detail_kriterias')->insert([
            ['id_kriteria' => $idKriteria, 'rentang' => 'Rendah', 'nilai' => 1, 'bobot_normalisasi' => 0],
            ['id_kriteria' => $idKriteria, 'rentang' => 'Tinggi', 'nilai' => 5, 'bobot_normalisasi' => 1],
        ]);

        foreach ([['A1', 'Lampu jalan mati', 'Rendah'], ['A2', 'Jembatan retak', 'Tinggi']] as [$kode, $judul, $nilai]) {
            $laporan = LaporanPengaduan::create([
                'judul' => $judul,
                'jenis_laporan' => 'Infrastruktur',
                'keterangan' => '-',
                'status' => 'diterima',
                'id_warga' => $pelapor->id_warga,
            ]);
            $idAlternatif = DB::table('alternatif')->insertGetId(['kode_alternatif' => $kode, 'id_laporan' => $laporan->id_laporan]);
            DB::table('laporan_spk')->insert(['id_kriteria' => $idKriteria, 'id_alternatif' => $idAlternatif, 'nilai' => $nilai]);
        }
    }

    public function test_grafik_menampilkan_petunjuk_jika_belum_ada_penilaian(): void
    {
        $this->actingAs($this->buatPengguna('RW'))
            ->get(route('laporan_spk.chart'))
            ->assertOk()
            ->assertSee('Belum ada laporan yang dinilai');
    }

    public function test_grafik_sama_dengan_hasil_perangkingan(): void
    {
        $this->siapkanPenilaian();
        $rw = $this->buatPengguna('RW');

        $grafik = $this->actingAs($rw)->get(route('laporan_spk.chart'))->assertOk()->viewData('peringkat');
        $perangkingan = $this->actingAs($rw)->get(route('laporan_spk.priority'))->assertOk()->viewData('scores');

        $this->assertEquals(['A2', 'A1'], $grafik->pluck('kode')->all());
        $this->assertEquals('Jembatan retak', $grafik[0]['judul']);
        $this->assertEquals(
            array_map(fn ($skor) => round($skor, 4), array_values($perangkingan)),
            $grafik->pluck('skor')->all()
        );
    }

    public function test_route_yang_dihapus_dialihkan_ke_dashboard(): void
    {
        $rw = $this->buatPengguna('RW');
        $warga = $this->buatPengguna('WRG');

        foreach (['/super-admin/laporan/detail/1', '/super-admin/surat/detail/1', '/super-admin/laporan_spk/form'] as $url) {
            $this->actingAs($rw)->get($url)->assertRedirect(route('super-admin.index'));
        }

        $this->actingAs($warga)->get('/user/laporan/all')->assertRedirect(route('user.index'));
    }

    public function test_detail_perangkingan_dengan_id_tidak_ada_dialihkan(): void
    {
        $this->actingAs($this->buatPengguna('RW'))
            ->get(route('laporan_spk.show', ['id' => 999]))
            ->assertRedirect(route('super-admin.index'));
    }
}
