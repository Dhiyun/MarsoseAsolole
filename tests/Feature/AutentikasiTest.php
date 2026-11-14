<?php

namespace Tests\Feature;

use App\Models\Level;
use App\Models\Users;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AutentikasiTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->siapkanDataWilayah();
    }

    public function test_login_gagal_kembali_ke_halaman_login_dengan_pesan(): void
    {
        $user = $this->buatPengguna('RW');

        $this->from('/login')
            ->post('/login_proses', ['username' => $user->username, 'password' => 'salah'])
            ->assertRedirect('/login')
            ->assertSessionHas('error');

        $this->assertGuest();
    }

    public function test_rw_diarahkan_ke_dashboard_rw(): void
    {
        $user = $this->buatPengguna('RW');

        $this->post('/login_proses', ['username' => $user->username, 'password' => 'rahasia123'])
            ->assertRedirect(route('super-admin.index'));

        $this->assertAuthenticatedAs($user);
    }

    public function test_rt_diarahkan_ke_dashboard_rt_miliknya(): void
    {
        $user = $this->buatPengguna('RT3', '03');

        $this->post('/login_proses', ['username' => $user->username, 'password' => 'rahasia123'])
            ->assertRedirect(route('admin.index', ['rt' => 3]));
    }

    private function dataProfil($user, array $tambahan = []): array
    {
        $warga = $user->warga;

        return array_merge([
            'nama' => $warga->nama,
            'nik' => $warga->nik,
            'jenis_kelamin' => $warga->jenis_kelamin,
            'tempat_lahir' => $warga->tempat_lahir,
            'tanggal_lahir' => $warga->tanggal_lahir,
            'alamat' => $warga->alamat,
            'no_rt' => $warga->no_rt,
            'agama' => $warga->agama,
        ], $tambahan);
    }

    public function test_password_bisa_diganti_lewat_profil(): void
    {
        $user = $this->buatPengguna('WRG');

        $this->actingAs($user)
            ->put(route('user.updateProfile'), $this->dataProfil($user, [
                'password_lama' => 'rahasia123',
                'password' => 'passwordbaru123',
                'password_confirmation' => 'passwordbaru123',
            ]))
            ->assertRedirect(route('profile-user'))
            ->assertSessionHasNoErrors();

        $this->assertTrue(Hash::check('passwordbaru123', $user->fresh()->password));
    }

    public function test_ganti_password_lewat_profil_butuh_password_lama_yang_benar(): void
    {
        $user = $this->buatPengguna('WRG');

        $this->actingAs($user)
            ->put(route('user.updateProfile'), $this->dataProfil($user, [
                'password_lama' => 'salah12345',
                'password' => 'passwordbaru123',
                'password_confirmation' => 'passwordbaru123',
            ]))
            ->assertSessionHasErrors('password_lama');

        $this->assertTrue(Hash::check('rahasia123', $user->fresh()->password));
    }

    public function test_update_profil_tanpa_isi_password_tidak_mengubah_password(): void
    {
        $user = $this->buatPengguna('WRG');

        $this->actingAs($user)
            ->put(route('user.updateProfile'), $this->dataProfil($user, ['nama' => 'Nama Baru']))
            ->assertSessionHasNoErrors();

        $this->assertTrue(Hash::check('rahasia123', $user->fresh()->password));
        $this->assertEquals('Nama Baru', $user->fresh()->warga->nama);
    }

    public function test_url_tidak_ditemukan_untuk_tamu_diarahkan_ke_landing_page(): void
    {
        $this->get('/halaman-yang-tidak-ada')->assertRedirect('/');
    }

    public function test_url_tidak_ditemukan_setelah_login_diarahkan_ke_dashboard(): void
    {
        $warga = $this->buatPengguna('WRG');
        $rw = $this->buatPengguna('RW');

        $this->actingAs($warga)->get('/halaman-yang-tidak-ada')->assertRedirect(route('user.index'));
        $this->actingAs($rw)->get('/super-admin/tidak-ada')->assertRedirect(route('super-admin.index'));
    }

    public function test_akun_tanpa_data_warga_ditolak_saat_login(): void
    {
        $user = Users::create([
            'username' => '9876543210987654',
            'password' => Hash::make('rahasia123'),
            'id_level' => Level::where('level_kode', 'WRG')->value('id_level'),
        ]);

        $this->from('/login')
            ->post('/login_proses', ['username' => $user->username, 'password' => 'rahasia123'])
            ->assertRedirect('/login')
            ->assertSessionHas('error');

        $this->assertGuest();
    }

    public function test_sesi_akun_tanpa_data_warga_dikeluarkan_bukan_error(): void
    {
        $user = Users::create([
            'username' => '9876543210987654',
            'password' => Hash::make('rahasia123'),
            'id_level' => Level::where('level_kode', 'WRG')->value('id_level'),
        ]);

        $this->actingAs($user)
            ->get(route('user.index'))
            ->assertRedirect('/login')
            ->assertSessionHas('error');

        $this->assertGuest();

        $this->get('/login')->assertOk();
    }

    public function test_logout_hanya_lewat_post(): void
    {
        $user = $this->buatPengguna('WRG');

        $this->actingAs($user)->get('/logout')->assertRedirect(route('user.index'));
        $this->assertAuthenticatedAs($user);

        $this->actingAs($user)->post('/logout')->assertRedirect('/');
        $this->assertGuest();
    }
}
