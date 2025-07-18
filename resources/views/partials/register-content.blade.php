@extends('auth.register')
@section('content')

{{-- Determine register route based on current URL --}}
@php
if (request()->is('admin/*')) {
$registerRoute = 'admin.register';
$loginRoute = 'admin.login';
$roleText = 'admin';
$roleLabel = 'Admin';
$welcomeTitle = 'MULAI MENGELOLA SISTEM KOST!';
$welcomeDesc = 'Bergabunglah sebagai administrator<br>untuk mengelola sistem kost<br>dengan lebih efisien.';
} elseif (request()->is('owner/*')) {
$registerRoute = 'owner.register';
$loginRoute = 'owner.login';
$roleText = 'owner';
$roleLabel = 'Owner';
$welcomeTitle = 'MULAI BISNIS KOST ANDA!';
$welcomeDesc = 'Bergabunglah sebagai pemilik kost<br>dan kelola properti Anda<br>dengan mudah bersama kami.';
} else {
$registerRoute = 'user.register';
$loginRoute = 'user.login';
$roleText = 'penghuni';
$roleLabel = 'Penghuni';
$welcomeTitle = 'MULAI PERJALANAN KOST ANDA!';
$welcomeDesc = 'Bergabunglah dengan ribuan<br>penghuni kost yang sudah<br>merasakan kenyamanan bersama kami.';
}
@endphp

<div class="h-full flex items-center justify-center bg-gradient-to-br from-green-50 to-blue-50 relative overflow-hidden">
    <div class="absolute top-0 left-0 w-32 h-32 bg-green-300 rounded-full opacity-60 -translate-x-16 -translate-y-16"></div>
    <div class="absolute top-20 right-20 w-24 h-24 bg-green-400 rounded-full opacity-50"></div>
    <div class="absolute bottom-20 left-20 w-20 h-20 bg-green-300 rounded-full opacity-40"></div>
    <div class="absolute bottom-0 right-0 w-40 h-40 bg-green-200 rounded-full opacity-30 translate-x-20 translate-y-20"></div>

    <div class="flex w-full max-w-6xl mx-auto px-4">
        <!-- Left Side - Welcome Message -->
        <div class="hidden md:flex md:w-1/2 items-center justify-center relative">
            <div class="text-center px-8">
                <h1 class="text-4xl font-bold text-gray-800 mb-6">{{ $welcomeTitle }}</h1>
                <p class="text-lg text-gray-600 mb-8 leading-relaxed">
                    {!! $welcomeDesc !!}
                </p>

                <!-- House/Kost Icon -->
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

            <!-- Additional decorative elements -->
            <div class="absolute top-1/4 left-1/4 w-16 h-16 bg-green-200 rounded-full opacity-50"></div>
        </div>

        <!-- Right Side - Register Form -->
        <div class="w-full md:w-1/2 flex items-center justify-center">
            <div class="bg-white rounded-lg shadow-xl p-6 w-full max-w-lg relative z-10">
                <!-- Logo -->
                <div class="text-center mb-6">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-gray-800 rounded-lg mb-4">
                        <div class="text-green-400 text-xs font-bold">KostKu</div>
                    </div>
                    <h2 class="text-2xl font-semibold text-gray-800 mb-2">Daftar akun {{ $roleText }} baru</h2>
                </div>

                <div class="mb-4">
                    <p class="text-sm text-gray-600 text-center">Lengkapi data diri Anda untuk mendaftar sebagai {{ $roleText }}</p>
                </div>

                <form method="POST" action="{{ route($registerRoute) }}" class="space-y-4" x-data="{ nameErr: true, emailErr: true, passwordErr: true, confirmPasswordErr: true }">
                    @csrf

                    <!-- Nama -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                        <div class="relative">
                            <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                                </svg>
                            </span>
                            <input type="text" id="name" name="name" value="{{ old('name') }}" required
                                @input="nameErr = false"
                                class="w-full pl-10 pr-3 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors duration-200"
                                placeholder="Masukkan nama lengkap Anda">
                        </div>
                        @error('name')
                        <p class="text-red-500 text-sm mt-1" x-show="nameErr" x-transition>{{ $message }}</p>
                        @enderror
                    </div>

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
                                placeholder="Buat password Anda">
                        </div>
                        <small class="text-gray-500 text-xs">Minimal 8 karakter</small>
                        @error('password')
                        <p class="text-red-500 text-sm mt-1" x-show="passwordErr" x-transition>{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password Confirmation -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password</label>
                        <div class="relative">
                            <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path>
                                </svg>
                            </span>
                            <input type="password" id="password_confirmation" name="password_confirmation" required
                                @input="confirmPasswordErr = false"
                                class="w-full pl-10 pr-3 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors duration-200"
                                placeholder="Ulangi password Anda">
                        </div>
                        @error('password_confirmation')
                        <p class="text-red-500 text-sm mt-1" x-show="confirmPasswordErr" x-transition>{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Register Button -->
                    <button type="submit"
                        class="w-full bg-gray-600 text-white py-3 px-4 rounded-md hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-colors duration-200 font-medium">
                        Daftar Sebagai {{ $roleLabel }}
                    </button>

                    <!-- Login Link -->
                    <div class="text-center mt-4">
                        <p class="text-sm text-gray-600">
                            Sudah punya akun {{ $roleText }}?
                            <a href="{{ route($loginRoute) }}" class="text-red-500 hover:text-red-700 font-medium">
                                Masuk di sini
                            </a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection