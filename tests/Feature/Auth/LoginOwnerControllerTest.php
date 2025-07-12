<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use App\Http\Middleware\EnsureRoleIsOwner;
use App\Models\User;
use Tests\TestCase;

class LoginOwnerControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_owner_can_login_with_correct_credentials()
    {

        $user = User::create([
            'name' => 'Owner User',
            'email' => 'owner@example.com',
            'password' => Hash::make('password123'),
            'role' => 'owner',
        ]);

        $response = $this->post(route('owner.login.store'), [
            'email' => $user->email,
            'password' => 'password123'
        ]);

        $this->assertAuthenticatedAs($user);
        $response->assertRedirect(route('owner.dashboard'));
    }


    public function test_owner_login_fails_with_wrong_password()
    {
        User::create([
            'name' => 'Owner User',
            'email' => 'owner@example.com',
            'password' => Hash::make('correctpassword'),
            'role' => 'owner',
        ]);

        $response = $this->from(route('owner.login.show'))->post(route('owner.login.store'), [
            'email' => 'owner@example.com',
            'password' => 'wrongpassword',
        ]);

        $response->assertRedirect(route('owner.login.show'));
        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    public function test_non_owner_user_cannot_login_as_owner()
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        $response = $this->from(route('owner.login.show'))->post(route('owner.login.store'), [
            'email' => 'admin@example.com',
            'password' => 'password123',
        ]);

        $response->assertRedirect(route('owner.login.show'));
        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    public function test_owner_can_logout()
    {
        $this->withoutMiddleware([EnsureRoleIsOwner::class]);

        $user = User::create([
            'name' => 'Owner User',
            'email' => 'owner@example.com',
            'password' => Hash::make('password123'),
            'role' => 'owner',
        ]);

        $this->actingAs($user);

        $response = $this->post(route('owner.logout'));

        $response->assertRedirect(route('owner.login.show'));
        $this->assertGuest();
    }
}
