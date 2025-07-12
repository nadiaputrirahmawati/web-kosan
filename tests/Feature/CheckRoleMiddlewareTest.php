<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CheckRoleMiddlewareTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('migrate:fresh');
    }

    /** @test */
    public function admin_can_access_admin_routes()
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->get('/admin/dashboard');

        $response->assertStatus(200);
    }

    /** @test */
    public function admin_can_access_owner_routes()
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->get('/owner/dashboard');

        $response->assertStatus(200);
    }

    /** @test */
    public function admin_can_access_user_routes()
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->get('/user/dashboard');

        $response->assertStatus(200);
    }

    /** @test */
    public function owner_cannot_access_admin_routes()
    {
        $owner = User::factory()->create(['role' => 'owner']);

        $response = $this->actingAs($owner)->get('/admin/dashboard');

        $response->assertRedirect('/owner/dashboard');
        $response->assertSessionHas('error', 'Anda tidak memiliki akses ke halaman tersebut.');
    }

    /** @test */
    public function owner_can_access_owner_routes()
    {
        $owner = User::factory()->create(['role' => 'owner']);

        $response = $this->actingAs($owner)->get('/owner/dashboard');

        $response->assertStatus(200);
    }

    /** @test */
    public function owner_can_access_user_routes()
    {
        $owner = User::factory()->create(['role' => 'owner']);

        $response = $this->actingAs($owner)->get('/user/dashboard');

        $response->assertStatus(200);
    }

    /** @test */
    public function user_cannot_access_admin_routes()
    {
        $user = User::factory()->create(['role' => 'user']);

        $response = $this->actingAs($user)->get('/admin/dashboard');

        $response->assertRedirect('/user/dashboard');
        $response->assertSessionHas('error', 'Anda tidak memiliki akses ke halaman tersebut.');
    }

    /** @test */
    public function user_cannot_access_owner_routes()
    {
        $user = User::factory()->create(['role' => 'user']);

        $response = $this->actingAs($user)->get('/owner/dashboard');

        $response->assertRedirect('/user/dashboard');
        $response->assertSessionHas('error', 'Anda tidak memiliki akses ke halaman tersebut.');
    }

    /** @test */
    public function user_can_access_user_routes()
    {
        $user = User::factory()->create(['role' => 'user']);

        $response = $this->actingAs($user)->get('/user/dashboard');

        $response->assertStatus(200);
    }

    /** @test */
    public function admin_can_access_admin_specific_routes()
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->get('/admin/users');

        $response->assertStatus(200);
        $response->assertSee('Admin user page');
    }

    /** @test */
    public function owner_cannot_access_admin_specific_routes()
    {
        $owner = User::factory()->create(['role' => 'owner']);

        $response = $this->actingAs($owner)->get('/admin/users');

        $response->assertRedirect('/owner/dashboard');
        $response->assertSessionHas('error');
    }

    /** @test */
    public function user_cannot_access_admin_specific_routes()
    {
        $user = User::factory()->create(['role' => 'user']);

        $response = $this->actingAs($user)->get('/admin/users');

        $response->assertRedirect('/user/dashboard');
        $response->assertSessionHas('error');
    }

    /** @test */
    public function owner_can_access_owner_specific_routes()
    {
        $owner = User::factory()->create(['role' => 'owner']);

        $response = $this->actingAs($owner)->get('/owner/kost');

        $response->assertStatus(200);
        $response->assertSee('Owner Kost page');
    }

    /** @test */
    public function user_cannot_access_owner_specific_routes()
    {
        $user = User::factory()->create(['role' => 'user']);

        $response = $this->actingAs($user)->get('/owner/kost');

        $response->assertRedirect('/user/dashboard');
        $response->assertSessionHas('error');
    }

    /** @test */
    public function all_roles_can_access_user_specific_routes()
    {
        // Test admin
        $admin = User::factory()->create(['role' => 'admin']);
        $response = $this->actingAs($admin)->get('/user/profile');
        $response->assertStatus(200);

        // Test user
        $user = User::factory()->create(['role' => 'user']);
        $response = $this->actingAs($user)->get('/user/profile');
        $response->assertStatus(200);
    }
}
