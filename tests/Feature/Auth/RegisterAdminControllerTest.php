<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use Illuminate\Auth\Events\Registered;

class RegisterAdminControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function it_can_show_register_admin_form()
    {
        $response = $this->get(route('admin.register.show'));

        $response->assertStatus(200);
        $response->assertViewIs('auth.register-admin');
    }

    /** @test */
    public function it_can_register_admin_with_valid_data()
    {
        Event::fake();

        $adminData = [
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => 'password123',
        ];

        $response = $this->post(route('admin.register.store'), $adminData);

        $response->assertSessionHasNoErrors();

        // Assert user was created in database
        $this->assertDatabaseHas('users', [
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'role' => 'admin',
        ]);

        $this->assertAuthenticated();

        $response->assertRedirect(route('admin.login.show'));
    }

    /** @test */
    public function it_requires_name_field()
    {
        $adminData = [
            'email' => 'admin@example.com',
            'password' => 'password123',
        ];

        $response = $this->post(route('admin.register.store'), $adminData);

        $response->assertSessionHasErrors(['name']);
        $this->assertDatabaseMissing('users', ['email' => 'admin@example.com']);
    }

    /** @test */
    public function it_requires_email_field()
    {
        $adminData = [
            'name' => 'Admin User',
            'password' => 'password123',
        ];

        $response = $this->post(route('admin.register.store'), $adminData);

        $response->assertSessionHasErrors(['email']);
        $this->assertDatabaseMissing('users', ['name' => 'Admin User']);
    }

    /** @test */
    public function it_requires_valid_email_format()
    {
        $adminData = [
            'name' => 'Admin User',
            'email' => 'invalid-email',
            'password' => 'password123',
        ];

        $response = $this->post(route('admin.register.store'), $adminData);

        $response->assertSessionHasErrors(['email']);
        $this->assertDatabaseMissing('users', ['name' => 'Admin User']);
    }

    /** @test */
    public function it_requires_unique_email()
    {
        // Create existing user
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

        $response = $this->post(route('admin.register.store'), $adminData);

        $response->assertSessionHasErrors(['email']);
        $this->assertDatabaseMissing('users', ['name' => 'Admin User']);
    }

    /** @test */
    public function it_requires_password_field()
    {
        $adminData = [
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password_confirmation' => 'password123',
        ];

        $response = $this->post(route('admin.register.store'), $adminData);

        $response->assertSessionHasErrors(['password']);
        $this->assertDatabaseMissing('users', ['email' => 'admin@example.com']);
    }

    /** @test */
    public function it_requires_minimum_password_length()
    {
        $adminData = [
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => '12',
        ];

        $response = $this->post(route('admin.register.store'), $adminData);

        $response->assertSessionHasErrors(['password']);
        $this->assertDatabaseMissing('users', ['email' => 'admin@example.com']);
    }

    /** @test */
    public function it_creates_user_with_owner_role()
    {
        $adminData = [
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => 'password123',
        ];

        $response = $this->post(route('admin.register.store'), $adminData);

        $user = User::where('email', 'admin@example.com')->first();
        $this->assertEquals('admin', $user->role);
    }

    /** @test */
    public function it_redirects_to_admin_login_after_successful_registration()
    {
        $adminData = [
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => 'password123',
        ];

        $response = $this->post(route('admin.register.store'), $adminData);

        $response->assertRedirect(route('admin.login.show'));
    }
}
