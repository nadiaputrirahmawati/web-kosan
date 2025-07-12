<?php

namespace Tests\Unit;

use App\Http\Controllers\RegisterUserController;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Tests\TestCase;
use ReflectionClass;

class RegisterUserControllerUnitTest extends TestCase
{
    protected RegisterUserController $controller;
    protected ReflectionClass $reflection;

    protected function setUp(): void
    {
        parent::setUp();

        $this->controller = new RegisterUserController();
        $this->reflection = new ReflectionClass($this->controller);
    }

    /** @test */
    public function it_determines_admin_role_from_admin_route()
    {
        // Create mock request with admin route
        $request = $this->createMockRequestWithRoute('admin.register');

        // Access private method
        $method = $this->reflection->getMethod('determineRoleFromRoute');
        $method->setAccessible(true);

        $result = $method->invoke($this->controller, $request);

        $this->assertEquals('admin', $result);
    }

    /** @test */
    public function it_determines_owner_role_from_owner_route()
    {
        // Create mock request with owner route
        $request = $this->createMockRequestWithRoute('owner.register');

        // Access private method
        $method = $this->reflection->getMethod('determineRoleFromRoute');
        $method->setAccessible(true);

        $result = $method->invoke($this->controller, $request);

        $this->assertEquals('owner', $result);
    }

    /** @test */
    public function it_determines_user_role_from_user_route()
    {
        // Create mock request with user route
        $request = $this->createMockRequestWithRoute('user.register');

        // Access private method
        $method = $this->reflection->getMethod('determineRoleFromRoute');
        $method->setAccessible(true);

        $result = $method->invoke($this->controller, $request);

        $this->assertEquals('user', $result);
    }

    /** @test */
    public function it_defaults_to_user_role_for_unknown_route()
    {
        // Create mock request with unknown route
        $request = $this->createMockRequestWithRoute('unknown.register');

        // Access private method
        $method = $this->reflection->getMethod('determineRoleFromRoute');
        $method->setAccessible(true);

        $result = $method->invoke($this->controller, $request);

        $this->assertEquals('user', $result);
    }

    /** @test */
    public function it_redirects_admin_to_correct_dashboard()
    {
        // Access private method
        $method = $this->reflection->getMethod('redirectAfterRegister');
        $method->setAccessible(true);

        $result = $method->invoke($this->controller, 'admin');

        $this->assertEquals(route('admin.dashboard'), $result->getTargetUrl());
        $this->assertEquals('Admin account created and logged in successfully.', $result->getSession()->get('success'));
    }

    /** @test */
    public function it_redirects_owner_to_correct_dashboard()
    {
        // Access private method
        $method = $this->reflection->getMethod('redirectAfterRegister');
        $method->setAccessible(true);

        $result = $method->invoke($this->controller, 'owner');

        $this->assertEquals(route('owner.dashboard'), $result->getTargetUrl());
        $this->assertEquals('Owner account created and logged in successfully.', $result->getSession()->get('success'));
    }

    /** @test */
    public function it_redirects_user_to_correct_dashboard()
    {
        // Access private method
        $method = $this->reflection->getMethod('redirectAfterRegister');
        $method->setAccessible(true);

        $result = $method->invoke($this->controller, 'user');

        $this->assertEquals(route('user.dashboard'), $result->getTargetUrl());
        $this->assertEquals('User account created and logged in successfully.', $result->getSession()->get('success'));
    }

    /** @test */
    public function it_defaults_unknown_role_to_user_dashboard()
    {
        // Access private method
        $method = $this->reflection->getMethod('redirectAfterRegister');
        $method->setAccessible(true);

        $result = $method->invoke($this->controller, 'unknown-role');

        $this->assertEquals(route('user.dashboard'), $result->getTargetUrl());
        $this->assertEquals('User account created and logged in successfully.', $result->getSession()->get('success'));
    }

    /** @test */
    public function it_handles_null_role_gracefully()
    {
        // Access private method
        $method = $this->reflection->getMethod('redirectAfterRegister');
        $method->setAccessible(true);

        $result = $method->invoke($this->controller, null);

        $this->assertEquals(route('user.dashboard'), $result->getTargetUrl());
        $this->assertEquals('User account created and logged in successfully.', $result->getSession()->get('success'));
    }

    /** @test */
    public function it_handles_empty_string_role()
    {
        // Access private method
        $method = $this->reflection->getMethod('redirectAfterRegister');
        $method->setAccessible(true);

        $result = $method->invoke($this->controller, '');

        $this->assertEquals(route('user.dashboard'), $result->getTargetUrl());
        $this->assertEquals('User account created and logged in successfully.', $result->getSession()->get('success'));
    }

    /**
     * Create a mock request with specific route name
     */
    private function createMockRequestWithRoute(string $routeName): Request
    {
        $route = $this->createMock(Route::class);
        $route->expects($this->any())
            ->method('getName')
            ->willReturn($routeName);

        $request = $this->createMock(Request::class);
        $request->expects($this->any())
            ->method('route')
            ->willReturn($route);

        return $request;
    }
}
