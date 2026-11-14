<?php

namespace Tests\Feature;

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

    public function test_password_sama_dengan_username_wajib_diganti(): void
    {
        $user = $this->buatPengguna('WRG');
        $user->update(['password' => Hash::make($user->username)]);

        $this->post('/login_proses', ['username' => $user->username, 'password' => $user->username])
            ->assertRedirect(route('password.ganti'));

        $this->get(route('user.index'))->assertRedirect(route('password.ganti'));

        $this->put(route('password.update'), [
            'password' => 'passwordbaru123',
            'password_confirmation' => 'passwordbaru123',
        ])->assertRedirect(route('user.index'));

        $this->assertTrue(Hash::check('passwordbaru123', $user->fresh()->password));
        $this->get(route('user.index'))->assertOk();
    }

    public function test_password_baru_tidak_boleh_sama_dengan_username(): void
    {
        $user = $this->buatPengguna('WRG');

        $this->actingAs($user)
            ->withSession(['wajib_ganti_password' => true])
            ->put(route('password.update'), [
                'password' => $user->username,
                'password_confirmation' => $user->username,
            ])
            ->assertSessionHasErrors('password');
    }

    public function test_logout_hanya_lewat_post(): void
    {
        $user = $this->buatPengguna('WRG');

        $this->actingAs($user)->get('/logout')->assertStatus(405);

        $this->actingAs($user)->post('/logout')->assertRedirect('/');
        $this->assertGuest();
    }
}
