<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class LoginUserControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('migrate:fresh');
    }

    /** @test */
    public function it_can_show_login_form()
    {
        $response = $this->get(route('admin.login'));

        $response->assertStatus(200);
        $response->assertViewIs('partials.login-content');
    }

    /** @test */
    public function admin_can_login_and_redirect_to_admin_dashboard()
    {
        $admin = User::factory()->create([
            'email' => 'admin@example.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        $response = $this->post(route('admin.login'), [
            'email' => 'admin@example.com',
            'password' => 'password123',
        ]);

        $this->assertAuthenticatedAs($admin);
        $response->assertRedirect(route('admin.dashboard'));
        $response->assertSessionHas('success', 'Welcome back, Admin!');
    }

    /** @test */
    public function owner_can_login_and_redirect_to_owner_dashboard()
    {
        $owner = User::factory()->create([
            'email' => 'owner@example.com',
            'password' => Hash::make('password123'),
            'role' => 'owner',
        ]);

        $response = $this->post(route('owner.login'), [
            'email' => 'owner@example.com',
            'password' => 'password123',
        ]);

        $this->assertAuthenticatedAs($owner);
        $response->assertRedirect(route('owner.dashboard'));
        $response->assertSessionHas('success', 'Welcome back, Owner!');
    }

    /** @test */
    public function user_can_login_and_redirect_to_user_dashboard()
    {
        $user = User::factory()->create([
            'email' => 'user@example.com',
            'password' => Hash::make('password123'),
            'role' => 'user',
        ]);

        $response = $this->post(route('user.login'), [
            'email' => 'user@example.com',
            'password' => 'password123',
        ]);

        $this->assertAuthenticatedAs($user);
        $response->assertRedirect(route('user.dashboard'));
        $response->assertSessionHas('success', 'Welcome back!');
    }

    /** @test */
    public function it_validates_required_fields()
    {
        $response = $this->post(route('admin.login'), []);

        $response->assertSessionHasErrors(['email', 'password']);
    }

    /** @test */
    public function it_validates_email_format()
    {
        $response = $this->post(route('admin.login'), [
            'email' => 'invalid-email',
            'password' => 'password123',
        ]);

        $response->assertSessionHasErrors(['email']);
    }

    /** @test */
    public function it_validates_email_exists_in_database()
    {
        $response = $this->post(route('admin.login'), [
            'email' => 'nonexistent@example.com',
            'password' => 'password123',
        ]);

        $response->assertSessionHasErrors(['email']);
    }

    /** @test */
    public function it_fails_with_invalid_credentials()
    {
        User::factory()->create([
            'email' => 'user@example.com',
            'password' => Hash::make('correct-password'),
        ]);

        $response = $this->post(route('admin.login'), [
            'email' => 'user@example.com',
            'password' => 'wrong-password',
        ]);

        $this->assertGuest();
        $response->assertSessionHasErrors(['email']);
    }

    /** @test */
    public function it_handles_remember_me_functionality()
    {
        $user = User::factory()->create([
            'email' => 'user@example.com',
            'password' => Hash::make('password123'),
            'role' => 'user',
        ]);

        $response = $this->post(route('user.login'), [
            'email' => 'user@example.com',
            'password' => 'password123',
            'remember' => '1',
        ]);

        $this->assertAuthenticatedAs($user);

        // Check if remember token was set
        $user->refresh();
        $this->assertNotNull($user->remember_token);
    }

    /** @test */
    public function it_redirects_to_intended_url_if_exists()
    {
        $user = User::factory()->create([
            'email' => 'user@example.com',
            'password' => Hash::make('password123'),
            'role' => 'user',
        ]);

        // Simulate intended URL
        session(['url.intended' => '/user/profile']);

        $response = $this->post(route('user.login'), [
            'email' => 'user@example.com',
            'password' => 'password123',
        ]);

        $response->assertRedirect('/user/profile');
    }

    /** @test */
    public function it_regenerates_session_after_login()
    {
        $user = User::factory()->create([
            'email' => 'user@example.com',
            'password' => Hash::make('password123'),
            'role' => 'user',
        ]);

        $this->startSession();
        $initialSessionId = session()->getId();

        $response = $this->post(route('user.login'), [
            'email' => 'user@example.com',
            'password' => 'password123',
        ]);

        $this->assertNotEquals($initialSessionId, session()->getId());
    }

    /** @test */
    public function it_implements_rate_limiting_on_failed_attempts()
    {
        User::factory()->create([
            'email' => 'user@example.com',
            'password' => Hash::make('correct-password'),
        ]);

        // 5 kali gagal login
        for ($i = 0; $i < 5; $i++) {
            $this->post(route('admin.login'), [
                'email' => 'user@example.com',
                'password' => 'wrong-password',
            ]);
        }

        // setelah 5 kali gagal, rate limiter aktif
        $response = $this->post(route('admin.login'), [
            'email' => 'user@example.com',
            'password' => 'wrong-password',
        ]);

        $response->assertSessionHasErrors(['email']);
        $errors = session('errors')->get('email');
        $this->assertStringContainsString('Too many login attempts', $errors[0] ?? '');
    }

    /** @test */
    public function rate_limiting_is_cleared_on_successful_login()
    {
        $user = User::factory()->create([
            'email' => 'user@example.com',
            'password' => Hash::make('correct-password'),
        ]);

        // 3 kali gagal login
        for ($i = 0; $i < 3; $i++) {
            $this->post(route('admin.login'), [
                'email' => 'user@example.com',
                'password' => 'wrong-password',
            ]);
        }

        // setelah login sukses bersihkan rate limiter
        $response = $this->post(route('admin.login'), [
            'email' => 'user@example.com',
            'password' => 'correct-password',
        ]);

        $this->assertAuthenticatedAs($user);
        $response->assertRedirect();

        // cek rate limiter
        $this->post('/logout');

        $response = $this->post(route('admin.login'), [
            'email' => 'user@example.com',
            'password' => 'wrong-password',
        ]);

        $response->assertSessionHasErrors(['email']);
        $errors = session('errors')->get('email');
        $this->assertStringNotContainsString('Too many login attempts', $errors[0] ?? '');
    }

    /** @test */
    public function login_maintains_old_input_on_validation_failure()
    {
        $response = $this->post(route('admin.login'), [
            'email' => 'invalid-email',
            'password' => 'password123',
        ]);

        $response->assertSessionHasInput('email', 'invalid-email');
        $response->assertSessionMissing('password');
    }

    /** @test */
    public function different_login_routes_work_correctly()
    {
        $admin = User::factory()->create([
            'email' => 'admin@example.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        // Test admin login route
        $response = $this->post(route('admin.login'), [
            'email' => 'admin@example.com',
            'password' => 'password123',
        ]);
        $response->assertRedirect(route('admin.dashboard'));

        $this->post('/logout');

        // Test owner login route  
        $response = $this->post(route('owner.login'), [
            'email' => 'admin@example.com',
            'password' => 'password123',
        ]);
        $response->assertRedirect(route('admin.dashboard'));

        $this->post('/logout');

        // Test user login route
        $response = $this->post(route('user.login'), [
            'email' => 'admin@example.com',
            'password' => 'password123',
        ]);
        $response->assertRedirect(route('admin.dashboard'));
    }
}
