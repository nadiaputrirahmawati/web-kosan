@extends('auth.login')
@section('content')

{{-- Determine login route based on current URL --}}
@php
if (request()->is('admin/*')) {
$loginRoute = 'admin.login';
$registerRoute = 'admin.register';
$roleText = 'admin';
$roleLabel = 'Admin';
$welcomeTitle = 'SELAMAT DATANG KEMBALI!';
$welcomeDesc = 'Anda hanya selangkah lagi untuk<br>mengakses panel admin<br>yang canggih dan lengkap.';
$loginTitle = 'Login ke akun admin kamu';
$registerText = 'Daftar sebagai admin';
} elseif (request()->is('owner/*')) {
$loginRoute = 'owner.login';
$registerRoute = 'owner.register';
$roleText = 'owner';
$roleLabel = 'Owner';
$welcomeTitle = 'SELAMAT DATANG KEMBALI!';
$welcomeDesc = 'Anda hanya selangkah lagi untuk<br>mengelola properti kost<br>yang menguntungkan.';
$loginTitle = 'Login ke akun owner kamu';
$registerText = 'Daftar sebagai owner';
} else {
$loginRoute = 'user.login';
$registerRoute = 'user.register';
$roleText = 'penghuni';
$roleLabel = 'Penghuni';
$welcomeTitle = 'SELAMAT DATANG KEMBALI!';
$welcomeDesc = 'Anda hanya selangkah lagi untuk<br>mengakses hunian kost<br>yang nyaman dan aman.';
$loginTitle = 'Login ke akun penghuni kamu';
$registerText = 'Daftar sebagai penghuni';
}
@endphp

<div class="h-full flex items-center justify-center bg-gradient-to-br from-green-50 to-blue-50 relative overflow-hidden">
    <div class="absolute top-0 left-0 w-32 h-32 bg-green-300 rounded-full opacity-60 -translate-x-16 -translate-y-16"></div>
    <div class="absolute top-20 right-20 w-24 h-24 bg-green-400 rounded-full opacity-50"></div>
    <div class="absolute bottom-20 left-20 w-20 h-20 bg-green-300 rounded-full opacity-40"></div>
    <div class="absolute bottom-0 right-0 w-40 h-40 bg-green-200 rounded-full opacity-30 translate-x-20 translate-y-20"></div>

    <div class="flex w-full max-w-6xl mx-auto px-4">
        <!-- Left Side - Login Form -->
        <div class="w-full md:w-1/2 flex items-center justify-center">
            <div class="bg-white rounded-lg shadow-xl p-8 w-full max-w-lg relative z-10">
                <!-- Logo -->
                <div class="text-center mb-8">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-gray-800 rounded-lg mb-4">
                        <div class="text-green-400 text-xs font-bold">KostKu</div>
                    </div>
                    <h2 class="text-2xl font-semibold text-gray-800 mb-2">{{ $loginTitle }}</h2>
                </div>

                <div class="mb-6">
                    <p class="text-sm text-gray-600 text-center">Atau gunakan email terdaftar</p>
                </div>

                <form method="POST" action="{{ route($loginRoute) }}" class="space-y-4" x-data="{ emailErr: true, passwordErr: true }">
                    @csrf

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <div class="relative">
                            <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                                </svg>
                            </span>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" required
                                @input="emailErr = false"
                                class="w-full pl-10 pr-3 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors duration-200"
                                placeholder="Masukkan email Anda">
                        </div>
                        @error('email')
                        <p class="text-red-500 text-sm mt-1" x-show="emailErr" x-transition>{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                        <div class="relative">
                            <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path>
                                </svg>
                            </span>
                            <input type="password" id="password" name="password" required
                                @input="passwordErr = false"
                                class="w-full pl-10 pr-3 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors duration-200"
                                placeholder="Masukkan password Anda">
                        </div>
                        @error('password')
                        <p class="text-red-500 text-sm mt-1" x-show="passwordErr" x-transition>{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Remember Me & Forgot Password -->
                    <div class="flex items-center justify-between">
                        <label class="flex items-center">
                            <input type="checkbox" name="remember" value="1" {{ old('remember') ? 'checked' : '' }}
                                class="w-4 h-4 text-green-600 bg-gray-100 border-gray-300 rounded focus:ring-green-500">
                            <span class="ml-2 text-sm text-gray-600">Ingat saya</span>
                        </label>
                    </div>

                    <!-- Login Button -->
                    <button type="submit"
                        class="w-full bg-gray-600 text-white py-3 px-4 rounded-md hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-colors duration-200 font-medium">
                        Masuk Sekarang
                    </button>

                    <!-- Register Link -->
                    <div class="text-center mt-6">
                        <p class="text-sm text-gray-600">
                            Belum punya akun {{ $roleText }}?
                            <a href="{{ route($registerRoute) }}" class="text-red-500 hover:text-red-700 font-medium">
                                {{ $registerText }}
                            </a>
                        </p>
                    </div>
                </form>
            </div>
        </div>

        <!-- Right Side - Welcome Message -->
        <div class="hidden md:flex md:w-1/2 items-center justify-center relative">
            <div class="text-center px-8">
                <h1 class="text-4xl font-bold text-gray-800 mb-6">{{ $welcomeTitle }}</h1>
                <p class="text-lg text-gray-600 mb-8 leading-relaxed">
                    {!! $welcomeDesc !!}
                </p>

                <!-- Kost Icon -->
                <div class="flex justify-center">
                    <div class="relative">
                        <div class="w-24 h-32 bg-white rounded-lg shadow-lg border-2 border-gray-200 flex items-center justify-center">
                            <div class="text-center">
                                <svg class="w-12 h-12 text-gray-400 mx-auto mb-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                                </svg>
                                <div class="text-xs text-gray-500">KOST</div>
                            </div>
                        </div>
                        <div class="absolute -top-2 -right-2 w-6 h-6 bg-green-500 rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <div class="absolute top-1/4 right-1/4 w-16 h-16 bg-green-200 rounded-full opacity-50"></div>
        </div>
    </div>
</div>
@endsection