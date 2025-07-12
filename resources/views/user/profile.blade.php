<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile - SimKost</title>
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
        <header class="bg-white shadow-sm border-b">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center py-4">
                    <h1 class="text-2xl font-bold text-gray-900">SimKost</h1>
                    <div class="flex items-center space-x-4">
                        <span class="text-sm text-gray-700">Welcome, {{ Auth::user()->name }}</span>
                        <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded-full">User</span>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-sm text-red-600 hover:text-red-700">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </header>
        <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
            <div class="text-center py-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">My Profile</h2>
                <p class="text-gray-600">Kelola profil Anda di sini</p>
            </div>
        </main>
    </div>
</body>

</html>