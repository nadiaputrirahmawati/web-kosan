<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class LoginAdminControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_shows_login_form()
    {
        $response = $this->get(route('admin.login.show'));

        $response->assertStatus(200);
        $response->assertViewIs('auth.login-admin');
    }

    public function test_it_can_login_admin_with_valid_credentials()
    {
        // Create admin user
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        $loginData = [
            'email' => 'admin@example.com',
            'password' => 'password123',
        ];

        $response = $this->post(route('admin.login.store'), $loginData);

        $this->assertAuthenticatedAs($admin);
        $response->assertRedirect(route('admin.dashboard'));
    }

    public function test_it_cannot_login_with_invalid_credentials()
    {
        $loginData = [
            'email' => 'admin@example.com',
            'password' => 'wrongpassword',
        ];

        $response = $this->post(route('admin.login.store'), $loginData);

        // Assert user is not authenticated
        $this->assertGuest();

        // Assert validation error
        $response->assertSessionHasErrors(['email']);
    }

    public function test_it_cannot_login_with_invalid_email()
    {
        $loginData = [
            'email' => 'nonexistent@example.com',
            'password' => 'password123',
        ];

        $response = $this->post(route('admin.login.store'), $loginData);

        // Assert user is not authenticated
        $this->assertGuest();

        // Assert validation error
        $response->assertSessionHasErrors(['email']);
    }

    public function test_it_cannot_login_non_admin_user()
    {
        // Create regular user (not admin)
        $user = User::create([
            'name' => 'Regular User',
            'email' => 'user@example.com',
            'password' => Hash::make('password123'),
            'role' => 'user',
        ]);

        $loginData = [
            'email' => 'user@example.com',
            'password' => 'password123',
        ];

        $response = $this->post(route('admin.login.store'), $loginData);

        // Assert user is not authenticated (logged out after role check)
        $this->assertGuest();

        // Assert validation error
        $response->assertSessionHasErrors(['email']);
    }

    public function test_it_requires_email_field()
    {
        $loginData = [
            // 'email' => 'admin@example.com', // Missing email
            'password' => 'password123',
        ];

        $response = $this->post(route('admin.login.store'), $loginData);

        $this->assertGuest();
        $response->assertSessionHasErrors(['email']);
    }

    public function test_it_requires_password_field()
    {
        $loginData = [
            'email' => 'admin@example.com',
            // 'password' => 'password123', // Missing password
        ];

        $response = $this->post(route('admin.login.store'), $loginData);

        $this->assertGuest();
        $response->assertSessionHasErrors(['password']);
    }

    public function test_it_requires_valid_email_format()
    {
        $loginData = [
            'email' => 'invalid-email', // Invalid email format
            'password' => 'password123',
        ];

        $response = $this->post(route('admin.login.store'), $loginData);

        $this->assertGuest();
        $response->assertSessionHasErrors(['email']);
    }

    public function test_it_can_logout_admin()
    {
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        $this->actingAs($admin);

        $this->assertAuthenticated();

        $response = $this->post(route('admin.logout'));

        $response->assertRedirect(route('admin.login.show'));
        $this->assertGuest();
    }

    public function test_session_is_regenerated_on_successful_login()
    {
        // Create admin user
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        $loginData = [
            'email' => 'admin@example.com',
            'password' => 'password123',
        ];

        // Start session
        $this->startSession();
        $oldSessionId = session()->getId();

        $response = $this->post(route('admin.login.store'), $loginData);

        // Session should be regenerated (new session ID)
        $newSessionId = session()->getId();
        $this->assertNotEquals($oldSessionId, $newSessionId);
    }

    public function test_session_is_invalidated_on_logout()
    {
        // Create and login admin user
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        $this->actingAs($admin);

        // Start session and add some data
        $this->startSession();
        session(['test_key' => 'test_value']);

        $this->post(route('admin.logout'));

        // Session should be invalidated
        $this->assertNull(session('test_key'));
    }
}
