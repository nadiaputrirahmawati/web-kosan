<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class RegisterUserControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        // Ensure we have clean database for each test
        $this->artisan('migrate:fresh');
    }

    /** @test */
    public function it_can_show_register_form()
    {
        $response = $this->get(route('admin.register'));

        $response->assertStatus(200);
        $response->assertViewIs('partials.register-content');
    }

    /** @test */
    public function it_can_register_admin_user()
    {
        $userData = [
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ];

        $response = $this->post(route('admin.register'), $userData);

        // Assert user was created
        $this->assertDatabaseHas('users', [
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'role' => 'admin',
        ]);

        // Assert password was hashed
        $user = User::where('email', 'admin@example.com')->first();
        $this->assertTrue(Hash::check('password123', $user->password));

        // Assert user is logged in
        $this->assertAuthenticatedAs($user);

        // Assert redirect to admin dashboard
        $response->assertRedirect(route('admin.dashboard'));
        $response->assertSessionHas('success', 'Admin account created and logged in successfully.');
    }

    /** @test */
    public function it_can_register_owner_user()
    {
        $userData = [
            'name' => 'Owner User',
            'email' => 'owner@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ];

        $response = $this->post(route('owner.register'), $userData);

        // Assert user was created with owner role
        $this->assertDatabaseHas('users', [
            'name' => 'Owner User',
            'email' => 'owner@example.com',
            'role' => 'owner',
        ]);

        // Assert user is logged in
        $user = User::where('email', 'owner@example.com')->first();
        $this->assertAuthenticatedAs($user);

        // Assert redirect to owner dashboard
        $response->assertRedirect(route('owner.dashboard'));
        $response->assertSessionHas('success', 'Owner account created and logged in successfully.');
    }

    /** @test */
    public function it_can_register_regular_user()
    {
        $userData = [
            'name' => 'Regular User',
            'email' => 'user@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ];

        $response = $this->post(route('user.register'), $userData);

        // Assert user was created with user role
        $this->assertDatabaseHas('users', [
            'name' => 'Regular User',
            'email' => 'user@example.com',
            'role' => 'user',
        ]);

        // Assert user is logged in
        $user = User::where('email', 'user@example.com')->first();
        $this->assertAuthenticatedAs($user);

        // Assert redirect to user dashboard
        $response->assertRedirect(route('user.dashboard'));
        $response->assertSessionHas('success', 'User account created and logged in successfully.');
    }

    /** @test */
    public function it_validates_required_fields()
    {
        $response = $this->post(route('admin.register'), []);

        $response->assertSessionHasErrors(['name', 'email', 'password']);
    }

    /** @test */
    public function it_validates_email_format()
    {
        $userData = [
            'name' => 'Test User',
            'email' => 'invalid-email',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ];

        $response = $this->post(route('admin.register'), $userData);

        $response->assertSessionHasErrors(['email']);
    }

    /** @test */
    public function it_validates_unique_email()
    {
        // Create existing user
        User::factory()->create([
            'email' => 'existing@example.com'
        ]);

        $userData = [
            'name' => 'Test User',
            'email' => 'existing@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ];

        $response = $this->post(route('admin.register'), $userData);

        $response->assertSessionHasErrors(['email']);
    }

    /** @test */
    public function it_validates_unique_name()
    {
        // Create existing user
        User::factory()->create([
            'name' => 'Existing User'
        ]);

        $userData = [
            'name' => 'Existing User',
            'email' => 'new@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ];

        $response = $this->post(route('admin.register'), $userData);

        $response->assertSessionHasErrors(['name']);
    }

    /** @test */
    public function it_validates_password_confirmation()
    {
        $userData = [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password123',
            'password_confirmation' => 'different-password',
        ];

        $response = $this->post(route('admin.register'), $userData);

        $response->assertSessionHasErrors(['password']);
    }

    /** @test */
    public function it_validates_minimum_password_length()
    {
        $userData = [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => '123',
            'password_confirmation' => '123',
        ];

        $response = $this->post(route('admin.register'), $userData);

        $response->assertSessionHasErrors(['password']);
    }

    /** @test */
    public function it_validates_maximum_password_length()
    {
        $longPassword = str_repeat('a', 31); // 31 characters

        $userData = [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => $longPassword,
            'password_confirmation' => $longPassword,
        ];

        $response = $this->post(route('admin.register'), $userData);

        $response->assertSessionHasErrors(['password']);
    }

    /** @test */
    public function it_determines_role_correctly_from_route()
    {
        // Test admin route
        $adminData = [
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ];

        $this->post(route('admin.register'), $adminData);
        $this->assertDatabaseHas('users', ['email' => 'admin@example.com', 'role' => 'admin']);

        // Clear authentication for next test
        $this->app['auth']->logout();

        $ownerData = [
            'name' => 'Owner User',
            'email' => 'owner@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ];

        $this->post(route('owner.register'), $ownerData);
        $this->assertDatabaseHas('users', ['email' => 'owner@example.com', 'role' => 'owner']);

        // Clear authentication for next test
        $this->app['auth']->logout();

        // Test user route
        $userData = [
            'name' => 'Regular User',
            'email' => 'user@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ];

        $this->post(route('user.register'), $userData);
        $this->assertDatabaseHas('users', ['email' => 'user@example.com', 'role' => 'user']);
    }

    /** @test */
    public function it_regenerates_session_after_registration()
    {
        $userData = [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ];

        // Start session and get initial session ID
        $this->startSession();
        $initialSessionId = session()->getId();

        $response = $this->post(route('admin.register'), $userData);

        // Session should be regenerated (different ID)
        $this->assertNotEquals($initialSessionId, session()->getId());
    }

    /** @test */
    public function it_handles_database_errors_gracefully()
    {
        // Mock a database error scenario
        $userData = [
            'name' => str_repeat('a', 256), // Exceeds max length
            'email' => 'test@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ];

        $response = $this->post(route('admin.register'), $userData);

        // Should return validation error for name length
        $response->assertSessionHasErrors(['name']);
    }

    /** @test */
    public function registration_maintains_old_input_on_validation_failure()
    {
        $userData = [
            'name' => 'Test User',
            'email' => 'invalid-email', // Invalid email format
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ];

        $response = $this->post(route('admin.register'), $userData);

        $response->assertSessionHasInput('name', 'Test User');
        $response->assertSessionHasInput('email', 'invalid-email');
        // Password should not be in old input for security
        $response->assertSessionMissing('password');
    }
}
