<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use App\Http\Middleware\EnsureRoleIsOwner;

class OwnerLoginTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function owner_can_login_with_correct_credentials()
    {
        $this->withoutMiddleware([
            EnsureRoleIsOwner::class,
        ]);

        // Buat user dengan role 'owner'
        $user = User::create([
            'name' => 'Test Owner',
            'email' => 'owner@example.com',
            'password' => Hash::make('password123'),
            'role' => 'owner',
        ]);

        $response = $this->post(route('owner.login.store'), [
            'email' => 'owner@example.com',
            'password' => 'password123',
        ]);

        $response->assertRedirect(route('owner.dashboard'));
        $this->assertAuthenticatedAs($user);
    }
}
