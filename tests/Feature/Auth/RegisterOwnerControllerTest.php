<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
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
            'email' => 'not-an-email',
            'password' => 'password',
        ]);

        $response->assertSessionHasErrors('email');
    }

    /**
     * Test gagal jika email tidak unique
     * 
     * @return void
     */
    public function test_it_requires_unique_email(): void
    {
        User::create([
            'name' => 'Existing User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        $adminData = [
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => 'password123',
        ];

        $response = $this->post(route('owner.register'), $adminData);

        $response->assertSessionHasErrors(['email']);
        $this->assertDatabaseMissing('users', ['name' => 'Admin User']);
    }
}
