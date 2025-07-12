<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to SimKost</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
    <style>
        * {
            font-family: "Plus Jakarta Sans", sans-serif;
        }
    </style>
</head>

<body class="bg-gray-100">
    <div class="min-h-screen">
        <!-- Header -->
        <header class="bg-white shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center py-4">
                    <div class="flex items-center">
                        <h1 class="text-2xl font-bold text-gray-900">SimKost</h1>
                    </div>
                    <div class="flex items-center space-x-4">
                        @auth
                        <span class="text-sm text-gray-700">Welcome, {{ Auth::user()->name }}</span>
                        <span class="px-2 py-1 
                                @if(Auth::user()->role === 'admin') bg-red-100 text-red-800
                                @elseif(Auth::user()->role === 'owner') bg-green-100 text-green-800
                                @else bg-blue-100 text-blue-800
                                @endif
                                text-xs rounded-full">{{ ucfirst(Auth::user()->role) }}</span>
                        <a href="
                                @if(Auth::user()->role === 'admin') {{ route('admin.dashboard') }}
                                @elseif(Auth::user()->role === 'owner') {{ route('owner.dashboard') }}
                                @else {{ route('user.dashboard') }}
                                @endif
                            " class="text-blue-600 hover:text-blue-700 text-sm">Go to Dashboard</a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-sm text-red-600 hover:text-red-700">Logout</button>
                        </form>
                        @else
                        <a href="{{ route('user.login') }}" class="text-blue-600 hover:text-blue-700 text-sm">Login</a>
                        <a href="{{ route('user.register') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm">Register</a>
                        @endauth
                    </div>
                </div>
            </div>
        </header>

        <!-- Hero Section -->
        <main class="max-w-7xl mx-auto py-12 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl font-bold text-gray-900 sm:text-6xl">
                    Welcome to <span class="text-blue-600">SimKost</span>
                </h1>
                <p class="mt-6 text-lg leading-8 text-gray-600 max-w-2xl mx-auto">
                    Platform terpercaya untuk mencari kost nyaman dan mengelola properti kost dengan mudah.
                    Bergabunglah dengan ribuan pengguna yang telah merasakan kemudahan SimKost.
                </p>
            </div>
        </main>
    </div>
</body>

</html>