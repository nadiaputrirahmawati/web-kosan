<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterOwnerControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test bahwa halaman registrasi owner dapat ditampilkan.
     *
     * @return void
     */
    public function test_owner_registration_screen_can_be_rendered(): void
    {
        // Lakukan request GET ke route registrasi owner
        $response = $this->get('/owner/register');

        // Pastikan response sukses (status 200)
        $response->assertStatus(200);
        // Pastikan view yang benar ditampilkan
        $response->assertViewIs('auth.register-owner');
    }

    /**
     * Test bahwa owner baru dapat mendaftar.
     *
     * @return void
     */
    public function test_new_owners_can_register(): void
    {
        // Lakukan request POST dengan data yang valid
        $response = $this->post(route('owner.register'), [
            'name' => 'Test Owner',
            'email' => 'owner@example.com',
            'password' => 'password',
            'password_confirmation' => 'password'
        ]);

        $response->assertSessionHasNoErrors();

        $this->assertDatabaseHas('users', [
            'email' => 'owner@example.com',
            'role' => 'owner'
        ]);

        $this->assertAuthenticated();

        $response->assertRedirect(route('owner.login.show'));
    }

    /**
     * Test validasi gagal jika nama tidak diisi.
     *
     * @return void
     */
    public function test_validation_fails_if_name_is_not_provided(): void
    {
        $response = $this->post('/owner/register', [
            'name' => '', // Nama dikosongkan
            'email' => 'owner@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        // Pastikan session memiliki error untuk field 'name'
        $response->assertSessionHasErrors('name');
        // Pastikan tidak ada user yang dibuat
        $this->assertDatabaseMissing('users', ['email' => 'owner@example.com']);
    }

    /**
     * Test validasi gagal jika email tidak valid.
     *
     * @return void
     */
    public function test_validation_fails_if_email_is_invalid(): void
    {
        $response = $this->post('/owner/register', [
            'name' => 'Test Owner',
            'email' => 'not-an-email', // Email tidak valid
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertSessionHasErrors('email');
    }

    /**
     * Test validasi gagal jika password tidak cocok.
     *
     * @return void
     */
    public function test_validation_fails_if_passwords_do_not_match(): void
    {
        $response = $this->post('/owner/register', [
            'name' => 'Test Owner',
            'email' => 'owner@example.com',
            'password' => 'password',
            'password_confirmation' => 'wrong-password',
        ]);

        $response->assertSessionHasErrors('password');
    }
}
