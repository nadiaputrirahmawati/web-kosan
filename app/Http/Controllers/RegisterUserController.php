<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterUserController extends Controller
{
    public function create()
    {
        return view('partials.register-content');
    }

    public function store(RegisterUserRequest $request)
    {
        $validatedData = $request->validated();

        $validatedData['password'] = Hash::make($validatedData['password']);

        // ambil role dari endpoint
        $validatedData['role'] = $this->determineRoleFromRoute($request);

        $user = User::create($validatedData);

        // Auto login setelah register akun
        Auth::login($user);

        $request->session()->regenerate();

        // Redirect berdasarkan role
        return $this->redirectAfterRegister($user->role);
    }

    /**
     * Determine user role based on the route endpoint
     */
    private function determineRoleFromRoute($request)
    {
        $routeName = $request->route()->getName();

        if (str_contains($routeName, 'admin')) {
            return 'admin';
        }

        if (str_contains($routeName, 'owner')) {
            return 'owner';
        }

        // Default role
        return 'user';
    }

    /**
     * Redirect berdasarkan role
     */
    private function redirectAfterRegister(?string $role)
    {
        switch ($role) {
            case 'admin':
                return redirect()->route('admin.dashboard')
                    ->with('success', 'Admin account created and logged in successfully.');

            case 'owner':
                return redirect()->route('owner.dashboard')
                    ->with('success', 'Owner account created and logged in successfully.');

            case 'user':
            default:
                return redirect()->route('user.dashboard')
                    ->with('success', 'User account created and logged in successfully.');
        }
    }
}
