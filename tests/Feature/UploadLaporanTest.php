<?php

namespace Tests\Feature;

use App\Models\LaporanPengaduan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class UploadLaporanTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->siapkanDataWilayah();
    }

    public function test_ekstensi_gambar_mengikuti_isi_file_bukan_nama_kiriman(): void
    {
        $warga = $this->buatPengguna('WRG');
        $path = tempnam(sys_get_temp_dir(), 'png');
        file_put_contents($path, base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNkYAAAAAYAAjCB0C8AAAAASUVORK5CYII='));

        $this->actingAs($warga)
            ->post(route('user-laporan.store'), [
                'judul' => 'Jalan berlubang',
                'jenis_laporan' => 'Infrastruktur',
                'keterangan' => 'Lubang besar di depan pos ronda',
                'gambar' => new UploadedFile($path, 'shell.pht', null, null, true),
            ])
            ->assertRedirect(route('user-laporan.history'));

        $gambar = LaporanPengaduan::firstOrFail()->gambar;

        $this->assertStringEndsWith('.png', $gambar);
        $this->assertStringNotContainsString('.pht', $gambar);
        $this->assertFileExists(public_path($gambar));

        unlink(public_path($gambar));
    }

    public function test_file_svg_ditolak(): void
    {
        $warga = $this->buatPengguna('WRG');
        $svg = '<svg xmlns="http://www.w3.org/2000/svg"><script>alert(1)</script></svg>';

        $this->actingAs($warga)
            ->post(route('user-laporan.store'), [
                'judul' => 'Laporan',
                'jenis_laporan' => 'Keamanan',
                'keterangan' => 'Keterangan',
                'gambar' => UploadedFile::fake()->createWithContent('gambar.svg', $svg),
            ])
            ->assertSessionHasErrors('gambar');

        $this->assertDatabaseCount('laporan_pengaduan', 0);
    }
}
