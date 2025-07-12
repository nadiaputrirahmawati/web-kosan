<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 - Akses Ditolak - SimKost</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
    <style>
        * {
            font-family: "Plus Jakarta Sans", sans-serif;
        }
    </style>
</head>

<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8 text-center">
            <!-- Error Icon -->
            <div>
                <div class="mx-auto h-24 w-24 bg-red-100 rounded-full flex items-center justify-center">
                    <svg class="h-12 w-12 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z" />
                    </svg>
                </div>
            </div>

            <!-- Error Content -->
            <div class="space-y-4">
                <h1 class="text-4xl font-bold text-gray-900">403</h1>
                <h2 class="text-2xl font-semibold text-gray-700">Akses Ditolak</h2>
                <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                    <p class="text-red-800 text-sm font-medium">
                        {{ $exception->getMessage() ?: 'Anda tidak memiliki izin untuk mengakses halaman ini.' }}
                    </p>
                </div>
            </div>

            <!-- User Info -->
            @auth
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                <div class="flex items-center justify-center space-x-2">
                    <span class="text-sm text-blue-700">Anda masuk sebagai:</span>
                    <span class="px-2 py-1 
                        @if(Auth::user()->role === 'admin') bg-red-100 text-red-800
                        @elseif(Auth::user()->role === 'owner') bg-green-100 text-green-800
                        @else bg-blue-100 text-blue-800
                        @endif
                        text-xs rounded-full font-medium">
                        {{ ucfirst(Auth::user()->role) }}
                    </span>
                </div>
                <p class="text-sm text-blue-600 mt-2">{{ Auth::user()->name }}</p>
            </div>
            @endauth

            <!-- Action Buttons -->
            <div class="space-y-3">
                @auth
                <a href="
                    @if(Auth::user()->role === 'admin') {{ route('admin.dashboard') }}
                    @elseif(Auth::user()->role === 'owner') {{ route('owner.dashboard') }}
                    @else {{ route('user.dashboard') }}
                    @endif
                " class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Kembali ke Dashboard
                </a>
                @endauth

                <a href="{{ url()->previous() }}" class="w-full flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Kembali ke Halaman Sebelumnya
                </a>

                <a href="{{ route('user.login') }}" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-blue-600 bg-blue-50 hover:bg-blue-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Login dengan Akun Lain
                </a>
            </div>

            <!-- Help Text -->
            <div class="text-xs text-gray-500 space-y-1">
                <p>Jika Anda merasa ini adalah kesalahan, silakan hubungi administrator.</p>
                <p class="font-mono">Error Code: 403</p>
            </div>
        </div>
    </div>
</body>

</html>