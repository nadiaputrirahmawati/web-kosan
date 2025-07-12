@extends('auth.register')

@section('content')
<div class="w-96 mx-auto my-auto bg-white rounded-md shadow-md p-6">
    <h2 class="text-2xl font-bold mb-4 text-center">Daftar Akun</h2> {{-- Determine register route based on current URL --}}
    @php
    if (request()->is('admin/*')) {

    $registerRoute = 'admin.register';
    $loginRoute = 'admin.login';

    } elseif (request()->is('owner/*')) {

    $registerRoute = 'owner.register';
    $loginRoute = 'owner.login';

    } else {

    $registerRoute = 'user.register';
    $loginRoute = 'user.login';

    }
    @endphp

    <form method="POST" action="{{ route($registerRoute) }}" x-data="{ nameErr: true, emailErr: true, passwordErr: true, confirmPasswordErr: true }">
        @csrf

        {{-- Nama --}}
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required
                @input="nameErr = false"
                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:outline-none">
            @error('name')
            <p class="text-red-500 text-sm mt-1" x-show="nameErr" x-transition>{{ $message }}</p>
            @enderror
        </div>

        {{-- Email --}}
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required
                @input="emailErr = false"
                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:outline-none">
            @error('email')
            <p class="text-red-500 text-sm mt-1" x-show="emailErr" x-transition>{{ $message }}</p>
            @enderror
        </div>

        {{-- Password --}}
        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
            <input type="password" id="password" name="password" required
                @input="passwordErr = false"
                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:outline-none">
            <small class="text-gray-500 text-xs">Minimal 8 karakter</small>
            @error('password')
            <p class="text-red-500 text-sm mt-1" x-show="passwordErr" x-transition>{{ $message }}</p>
            @enderror
        </div>

        {{-- Password Confirmation --}}
        <div class="mb-6">
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required
                @input="confirmPasswordErr = false"
                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:outline-none">
            @error('password_confirmation')
            <p class="text-red-500 text-sm mt-1" x-show="confirmPasswordErr" x-transition>{{ $message }}</p>
            @enderror
        </div>

        <button type="submit"
            class="w-full bg-indigo-600 text-white font-semibold py-2 px-4 rounded hover:bg-indigo-700 transition duration-200">
            Daftar
        </button>

        {{-- Link to Login --}}
        <div class="mt-4 text-center">
            <p class="text-sm text-gray-600">
                Sudah punya akun?
                <a href="{{ route($loginRoute) }}" class="text-indigo-600 hover:text-indigo-500 font-medium">
                    Masuk di sini
                </a>
            </p>
        </div>
    </form>
</div>
@endsection