<?php

namespace App\Http\Controllers;

use App\Http\Requests\OwnerRegisterRequest;
use Illuminate\Http\RedirectResponse;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

class RegisterOwnerController extends Controller
{
    /**
     * Display the login view.
     */
    public function show()
    {
        return view('auth.register-owner');
    }

    public function store(OwnerRegisterRequest $request): RedirectResponse
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'owner',
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('owner.login.show');
    }
}
