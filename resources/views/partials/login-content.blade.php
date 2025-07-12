@extends('auth.login')

@section('content')
<div class="w-96 mx-auto my-auto bg-white rounded-md shadow-md p-6">
    <h2 class="text-2xl font-bold mb-4 text-center">Masuk Akun</h2>

    {{-- Determine login route based on current URL --}}
    @php
    if (request()->is('admin/*')) {

    $loginRoute = 'admin.login';
    $registerRoute = 'admin.register';

    } elseif (request()->is('owner/*')) {

    $loginRoute = 'owner.login';
    $registerRoute = 'owner.register';

    } else {

    $loginRoute = 'user.login';
    $registerRoute = 'user.register';
    }
    @endphp

    <form method="POST" action="{{ route($loginRoute) }}" x-data="{ emailErr: true, passwordErr: true }">
        @csrf

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
            @error('password')
            <p class="text-red-500 text-sm mt-1" x-show="passwordErr" x-transition>{{ $message }}</p>
            @enderror
        </div>

        {{-- Remember Me --}}
        <div class="mb-6">
            <label class="flex items-center">
                <input type="checkbox" name="remember" value="1" {{ old('remember') ? 'checked' : '' }}
                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                <span class="ml-2 text-sm text-gray-600">Ingat saya</span>
            </label>
        </div>

        <button type="submit"
            class="w-full bg-indigo-600 text-white font-semibold py-2 px-4 rounded hover:bg-indigo-700 transition duration-200">
            Masuk
        </button>

        {{-- Link to Register --}}
        <div class="mt-4 text-center">
            <p class="text-sm text-gray-600">
                Belum punya akun?
                <a href="{{ route($registerRoute) }}" class="text-indigo-600 hover:text-indigo-500 font-medium">
                    Daftar di sini
                </a>
            </p>
        </div>
    </form>
</div>
@endsection