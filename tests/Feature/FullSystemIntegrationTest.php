<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FullSystemIntegrationTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('migrate:fresh');
    }

    /** @test */
    public function complete_user_registration_and_login_flow()
    {
        // Test user registration
        $response = $this->post(route('user.register'), [
            'name' => 'Test User',
            'email' => 'user@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertRedirect(route('user.dashboard'));
        $this->assertDatabaseHas('users', [
            'name' => 'Test User',
            'email' => 'user@example.com',
            'role' => 'user',
        ]);

        // Logout
        $this->post(route('logout'));
        $this->assertGuest();

        // Test login
        $response = $this->post(route('user.login'), [
            'email' => 'user@example.com',
            'password' => 'password123',
        ]);

        $response->assertRedirect(route('user.dashboard'));
        $this->assertAuthenticated();
    }

    /** @test */
    public function complete_owner_registration_and_access_control()
    {
        // Register as owner
        $response = $this->post(route('owner.register'), [
            'name' => 'Owner User',
            'email' => 'owner@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertRedirect(route('owner.dashboard'));
        $this->assertDatabaseHas('users', [
            'email' => 'owner@example.com',
            'role' => 'owner',
        ]);


        $response = $this->get('/owner/kost');
        $response->assertStatus(200);

        $response = $this->get('/user/profile');
        $response->assertStatus(403);

        // Test access control - owner cannot access admin routes (should get 403)
        $response = $this->get('/admin/users');
        $response->assertStatus(403);
    }

    /** @test */
    public function complete_admin_registration_and_access_control()
    {
        // Register as admin
        $response = $this->post(route('admin.register'), [
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertRedirect(route('admin.dashboard'));
        $this->assertDatabaseHas('users', [
            'email' => 'admin@example.com',
            'role' => 'admin',
        ]);

        // Test access control - admin can only access admin routes
        $response = $this->get('/admin/users');
        $response->assertStatus(200);

        $response = $this->get('/admin/owners');
        $response->assertStatus(200);

        $response = $this->get('/admin/reports');
        $response->assertStatus(200);

        // Test access control - admin cannot access owner routes (should get 403)
        $response = $this->get('/owner/kost');
        $response->assertStatus(403);

        // Test access control - admin cannot access user routes (should get 403)
        $response = $this->get('/user/profile');
        $response->assertStatus(403);
    }

    /** @test */
    public function role_based_navigation_works_correctly()
    {
        // Test admin navigation
        $response = $this->get('/admin/login');
        $response->assertStatus(200);
        $response->assertSee('Masuk Akun');

        $response = $this->get('/admin/register');
        $response->assertStatus(200);
        $response->assertSee('Daftar Akun');

        // Test owner navigation
        $response = $this->get('/owner/login');
        $response->assertStatus(200);

        $response = $this->get('/owner/register');
        $response->assertStatus(200);

        // Test user navigation
        $response = $this->get('/user/login');
        $response->assertStatus(200);

        $response = $this->get('/user/register');
        $response->assertStatus(200);
    }

    /** @test */
    public function middleware_protects_all_dashboard_routes()
    {
        // Test unauthenticated access
        $protectedRoutes = [
            '/admin/dashboard',
            '/owner/dashboard',
            '/user/dashboard',
            '/admin/users',
            '/admin/owners',
            '/admin/reports',
            '/owner/kost',
            '/user/profile',
            '/user/bookings',
            '/user/search',
        ];

        foreach ($protectedRoutes as $route) {
            $response = $this->get($route);
            $response->assertRedirect('/user/login');
        }
    }

    /** @test */
    public function system_handles_validation_errors_gracefully()
    {
        // Test registration validation
        $response = $this->post(route('admin.register'), [
            'name' => '',
            'email' => 'invalid-email',
            'password' => '123',
            'password_confirmation' => 'different',
        ]);

        $response->assertSessionHasErrors(['name', 'email', 'password']);
        $response->assertRedirect();

        // Test login validation
        $response = $this->post(route('admin.login'), [
            'email' => 'invalid-email',
            'password' => '',
        ]);

        $response->assertSessionHasErrors(['email', 'password']);
        $response->assertRedirect();
    }

    /** @test */
    public function system_prevents_duplicate_registrations()
    {
        // Create first user
        $this->post(route('admin.register'), [
            'name' => 'First User',
            'email' => 'test@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $this->post(route('logout'));

        // Try to register with same email
        $response = $this->post(route('admin.register'), [
            'name' => 'Second User',
            'email' => 'test@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertSessionHasErrors(['email']);

        // Try to register with same name
        $response = $this->post(route('admin.register'), [
            'name' => 'First User',
            'email' => 'different@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertSessionHasErrors(['name']);
    }

    /** @test */
    public function logout_functionality_works_correctly()
    {
        // Register and login
        $this->post(route('admin.register'), [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $this->assertAuthenticated();

        // Logout
        $response = $this->post(route('logout'));

        $this->assertGuest();
        $response->assertRedirect('/');
    }

    /** @test */
    public function user_role_has_restricted_access()
    {
        // Register as user
        $response = $this->post(route('user.register'), [
            'name' => 'Regular User',
            'email' => 'regularuser@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertRedirect(route('user.dashboard'));
        $this->assertDatabaseHas('users', [
            'email' => 'regularuser@example.com',
            'role' => 'user',
        ]);

        // Test access control - user can only access user routes
        $response = $this->get('/user/profile');
        $response->assertStatus(200);

        $response = $this->get('/user/bookings');
        $response->assertStatus(200);

        $response = $this->get('/user/search');
        $response->assertStatus(200);

        // Test access control - user cannot access owner routes (should get 403)
        $response = $this->get('/owner/kost');
        $response->assertStatus(403);

        $response = $this->get('/owner/dashboard');
        $response->assertStatus(403);

        // Test access control - user cannot access admin routes (should get 403)
        $response = $this->get('/admin/users');
        $response->assertStatus(403);

        $response = $this->get('/admin/dashboard');
        $response->assertStatus(403);
    }

    /** @test */
    public function strict_role_separation_enforced()
    {
        // Create users with different roles manually for testing
        $admin = \App\Models\User::create([
            'name' => 'Test Admin',
            'email' => 'admin@test.com',
            'password' => bcrypt('password123'),
            'role' => 'admin'
        ]);

        $owner = \App\Models\User::create([
            'name' => 'Test Owner',
            'email' => 'owner@test.com',
            'password' => bcrypt('password123'),
            'role' => 'owner'
        ]);

        $user = \App\Models\User::create([
            'name' => 'Test User',
            'email' => 'user@test.com',
            'password' => bcrypt('password123'),
            'role' => 'user'
        ]);

        // Test admin access - can access admin routes, 403 for others
        $this->actingAs($admin);
        $this->get('/admin/dashboard')->assertStatus(200);
        $this->get('/owner/dashboard')->assertStatus(403);
        $this->get('/user/dashboard')->assertStatus(403);

        // Test owner access - can access owner routes, 403 for others
        $this->actingAs($owner);
        $this->get('/owner/dashboard')->assertStatus(200);
        $this->get('/admin/dashboard')->assertStatus(403);
        $this->get('/user/dashboard')->assertStatus(403);

        // Test user access - can access user routes, 403 for others
        $this->actingAs($user);
        $this->get('/user/dashboard')->assertStatus(200);
        $this->get('/admin/dashboard')->assertStatus(403);
        $this->get('/owner/dashboard')->assertStatus(403);
    }
}
