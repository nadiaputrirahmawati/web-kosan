<?php

namespace App\Http\Controllers;

use App\Http\Requests\OwnerLoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginOwnerController extends Controller
{
    /**
     * Menampilkan halaman login untuk owner.
     */
    public function show()
    {
        return view('auth.login-owner');
    }

    /**
     * Memproses login owner.
     */
    // app/Http/Controllers/LoginOwnerController.php
    public function store(OwnerLoginRequest $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();

            if (Auth::user()->role !== 'owner') {
                Auth::logout();
                throw ValidationException::withMessages([
                    'email' => 'You are not authorized to access this area.',
                ]);
            }

            return redirect()->route('owner.dashboard');
        }

        throw ValidationException::withMessages([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }


    /**
     * Logout user owner.
     */
    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('owner.login.show');
    }
}
