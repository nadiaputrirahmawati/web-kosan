<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginUserController extends Controller
{
    public function create()
    {
        return view('partials.login-content');
    }

    public function store(LoginUserRequest $request)
    {
        $request->ensureIsNotRateLimited();

        // logika login
        $credentials = $request->only('email', 'password');
        $remember = $request->boolean('remember');

        if (!Auth::attempt($credentials, $remember)) {
            // Jika login gagal, buat rate limiter
            $request->hitRateLimiter();

            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        $request->clearRateLimiter();

        $request->session()->regenerate();

        // Redirect berdasarkan role
        return $this->redirectAfterLogin();
    }

    /**
     * Redirect user setelah login
     */
    private function redirectAfterLogin()
    {
        $user = Auth::user();

        // Cek intended URL sebelumnya
        if (session()->has('url.intended')) {
            return redirect()->intended();
        }

        // Redirect berdasarkan role
        switch ($user->role) {
            case 'admin':
                // notyf()->success('Welcome back, Admin!');
                return redirect()->route('admin.dashboard');

            case 'owner':
                // notyf()->success('Welcome back, Owner!');
                return redirect()->route('owner.dashboard');

            case 'user':
            default:
                // notyf()->success('Welcome back, User!');
                return redirect()->route('user.dashboard');
        }
    }
}
