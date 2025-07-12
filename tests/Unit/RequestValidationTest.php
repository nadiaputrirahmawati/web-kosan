<?php

namespace Tests\Unit;

use App\Http\Requests\RegisterUserRequest;
use App\Http\Requests\LoginUserRequest;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class RequestValidationTest extends TestCase
{
    /** @test */
    public function register_user_request_validates_required_fields()
    {
        $request = new RegisterUserRequest();
        $rules = $request->rules();

        $validator = Validator::make([], $rules);

        $this->assertTrue($validator->fails());
        $this->assertArrayHasKey('name', $validator->errors()->toArray());
        $this->assertArrayHasKey('email', $validator->errors()->toArray());
        $this->assertArrayHasKey('password', $validator->errors()->toArray());
    }

    /** @test */
    public function register_user_request_validates_email_format()
    {
        $request = new RegisterUserRequest();
        $rules = $request->rules();

        $data = [
            'name' => 'Test User',
            'email' => 'invalid-email',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ];

        $validator = Validator::make($data, $rules);

        $this->assertTrue($validator->fails());
        $this->assertArrayHasKey('email', $validator->errors()->toArray());
    }

    /** @test */
    public function register_user_request_validates_password_confirmation()
    {
        $request = new RegisterUserRequest();
        $rules = $request->rules();

        $data = [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password123',
            'password_confirmation' => 'different-password',
        ];

        $validator = Validator::make($data, $rules);

        $this->assertTrue($validator->fails());
        $this->assertArrayHasKey('password', $validator->errors()->toArray());
    }

    /** @test */
    public function register_user_request_validates_password_length()
    {
        $request = new RegisterUserRequest();
        $rules = $request->rules();

        // Test minimum length
        $data = [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => '123', // Too short
            'password_confirmation' => '123',
        ];

        $validator = Validator::make($data, $rules);
        $this->assertTrue($validator->fails());
        $this->assertArrayHasKey('password', $validator->errors()->toArray());

        // Test maximum length
        $longPassword = str_repeat('a', 31); // Too long
        $data['password'] = $longPassword;
        $data['password_confirmation'] = $longPassword;

        $validator = Validator::make($data, $rules);
        $this->assertTrue($validator->fails());
        $this->assertArrayHasKey('password', $validator->errors()->toArray());
    }

    /** @test */
    public function register_user_request_validates_name_length()
    {
        $request = new RegisterUserRequest();
        $rules = $request->rules();

        $data = [
            'name' => str_repeat('a', 256), // Too long
            'email' => 'test@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ];

        $validator = Validator::make($data, $rules);

        $this->assertTrue($validator->fails());
        $this->assertArrayHasKey('name', $validator->errors()->toArray());
    }

    /** @test */
    public function register_user_request_validates_email_length()
    {
        $request = new RegisterUserRequest();
        $rules = $request->rules();

        $longEmail = str_repeat('a', 250) . '@example.com';
        $data = [
            'name' => 'Test User',
            'email' => $longEmail,
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ];

        $validator = Validator::make($data, $rules);

        $this->assertTrue($validator->fails());
        $this->assertArrayHasKey('email', $validator->errors()->toArray());
    }

    /** @test */
    public function register_user_request_validates_role_values()
    {
        $request = new RegisterUserRequest();
        $rules = $request->rules();

        // Test invalid role
        $data = [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'role' => 'invalid-role',
        ];

        $validator = Validator::make($data, $rules);

        $this->assertTrue($validator->fails());
        $this->assertArrayHasKey('role', $validator->errors()->toArray());

        // Test valid roles
        $validRoles = ['user', 'owner', 'admin'];
        foreach ($validRoles as $role) {
            $data['role'] = $role;
            $validator = Validator::make($data, $rules);
            $this->assertArrayNotHasKey('role', $validator->errors()->toArray());
        }
    }

    /** @test */
    public function register_user_request_has_custom_messages()
    {
        $request = new RegisterUserRequest();
        $messages = $request->messages();

        $this->assertIsArray($messages);
        $this->assertArrayHasKey('name.unique', $messages);
        $this->assertArrayHasKey('email.unique', $messages);
        $this->assertArrayHasKey('password.confirmed', $messages);
        $this->assertArrayHasKey('password.min', $messages);

        // Check message content
        $this->assertEquals('Username sudah digunakan, silakan pilih username lain.', $messages['name.unique']);
        $this->assertEquals('Email sudah terdaftar, silakan gunakan email lain.', $messages['email.unique']);
        $this->assertEquals('Konfirmasi password tidak cocok.', $messages['password.confirmed']);
        $this->assertEquals('Password minimal harus 8 karakter.', $messages['password.min']);
    }

    /** @test */
    public function login_user_request_validates_required_fields()
    {
        $request = new LoginUserRequest();
        $rules = $request->rules();

        $validator = Validator::make([], $rules);

        $this->assertTrue($validator->fails());
        $this->assertArrayHasKey('email', $validator->errors()->toArray());
        $this->assertArrayHasKey('password', $validator->errors()->toArray());
    }

    /** @test */
    public function login_user_request_validates_email_format()
    {
        $request = new LoginUserRequest();
        $rules = $request->rules();

        $data = [
            'email' => 'invalid-email',
            'password' => 'password123',
        ];

        $validator = Validator::make($data, $rules);

        $this->assertTrue($validator->fails());
        $this->assertArrayHasKey('email', $validator->errors()->toArray());
    }

    /** @test */
    public function login_user_request_validates_password_length()
    {
        $request = new LoginUserRequest();
        $rules = $request->rules();

        $data = [
            'email' => 'test@example.com',
            'password' => '123', // Too short
        ];

        $validator = Validator::make($data, $rules);

        $this->assertTrue($validator->fails());
        $this->assertArrayHasKey('password', $validator->errors()->toArray());
    }

    /** @test */
    public function login_user_request_validates_remember_field()
    {
        $request = new LoginUserRequest();
        $rules = $request->rules();

        // Test valid boolean values
        $validData = [
            'email' => 'test@example.com',
            'password' => 'password123',
            'remember' => true,
        ];

        $validator = Validator::make($validData, $rules);
        $this->assertArrayNotHasKey('remember', $validator->errors()->toArray());

        // Test invalid remember value
        $invalidData = [
            'email' => 'test@example.com',
            'password' => 'password123',
            'remember' => 'invalid-boolean',
        ];

        $validator = Validator::make($invalidData, $rules);
        $this->assertTrue($validator->fails());
    }

    /** @test */
    public function login_user_request_has_custom_messages()
    {
        $request = new LoginUserRequest();
        $messages = $request->messages();

        $this->assertIsArray($messages);
        $this->assertArrayHasKey('email.required', $messages);
        $this->assertArrayHasKey('email.email', $messages);
        $this->assertArrayHasKey('email.exists', $messages);
        $this->assertArrayHasKey('password.required', $messages);
        $this->assertArrayHasKey('password.min', $messages);

        // Check message content
        $this->assertEquals('Email wajib diisi.', $messages['email.required']);
        $this->assertEquals('Format email tidak valid.', $messages['email.email']);
        $this->assertEquals('Email tidak terdaftar.', $messages['email.exists']);
        $this->assertEquals('Password wajib diisi.', $messages['password.required']);
        $this->assertEquals('Password minimal 8 karakter.', $messages['password.min']);
    }

    /** @test */
    public function both_requests_authorize_properly()
    {
        $registerRequest = new RegisterUserRequest();
        $loginRequest = new LoginUserRequest();

        $this->assertTrue($registerRequest->authorize());
        $this->assertTrue($loginRequest->authorize());
    }
}
