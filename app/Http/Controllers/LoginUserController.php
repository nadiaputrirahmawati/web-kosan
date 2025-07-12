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
                return redirect()->route('admin.dashboard')
                    ->with('success', 'Welcome back, Admin!');

            case 'owner':
                return redirect()->route('owner.dashboard')
                    ->with('success', 'Welcome back, Owner!');

            case 'user':
            default:
                return redirect()->route('user.dashboard')
                    ->with('success', 'Welcome back!');
        }
    }
}
