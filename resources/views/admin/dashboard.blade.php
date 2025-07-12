<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - SimKost</title>
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
        <header class="bg-white shadow-sm border-b">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center py-4">
                    <div class="flex items-center">
                        <h1 class="text-2xl font-bold text-gray-900">SimKost Admin</h1>
                    </div>
                    <div class="flex items-center space-x-4">
                        <span class="text-sm text-gray-700">Welcome, {{ Auth::user()->name }}</span>
                        <span class="px-2 py-1 bg-red-100 text-red-800 text-xs rounded-full">Admin</span>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-sm text-red-600 hover:text-red-700">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </header>

        <!-- Navigation -->
        <nav class="bg-gray-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex space-x-8">
                    <a href="{{ route('admin.dashboard') }}" class="text-white px-3 py-2 text-sm font-medium border-b-2 border-white">Dashboard</a>
                    <a href="{{ route('admin.users') }}" class="text-gray-300 hover:text-white px-3 py-2 text-sm font-medium">Manage Users</a>
                    <a href="{{ route('admin.owners') }}" class="text-gray-300 hover:text-white px-3 py-2 text-sm font-medium">Manage Owners</a>
                    <a href="{{ route('admin.reports') }}" class="text-gray-300 hover:text-white px-3 py-2 text-sm font-medium">Reports</a>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-blue-500 rounded-md flex items-center justify-center">
                                    <span class="text-white text-sm font-bold">U</span>
                                </div>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Total Users</dt>
                                    <dd class="text-lg font-medium text-gray-900">{{ \App\Models\User::where('role', 'user')->count() }}</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-green-500 rounded-md flex items-center justify-center">
                                    <span class="text-white text-sm font-bold">O</span>
                                </div>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Total Owners</dt>
                                    <dd class="text-lg font-medium text-gray-900">{{ \App\Models\User::where('role', 'owner')->count() }}</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-purple-500 rounded-md flex items-center justify-center">
                                    <span class="text-white text-sm font-bold">A</span>
                                </div>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Total Admins</dt>
                                    <dd class="text-lg font-medium text-gray-900">{{ \App\Models\User::where('role', 'admin')->count() }}</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Quick Actions</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        <a href="{{ route('admin.users') }}" class="bg-blue-50 hover:bg-blue-100 p-4 rounded-lg border border-blue-200 transition-colors">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-blue-500 rounded-lg flex items-center justify-center mr-3">
                                    <span class="text-white font-bold">👥</span>
                                </div>
                                <div>
                                    <h4 class="text-sm font-medium text-gray-900">Manage Users</h4>
                                    <p class="text-sm text-gray-500">View and manage user accounts</p>
                                </div>
                            </div>
                        </a>

                        <a href="{{ route('admin.owners') }}" class="bg-green-50 hover:bg-green-100 p-4 rounded-lg border border-green-200 transition-colors">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-green-500 rounded-lg flex items-center justify-center mr-3">
                                    <span class="text-white font-bold">🏠</span>
                                </div>
                                <div>
                                    <h4 class="text-sm font-medium text-gray-900">Manage Owners</h4>
                                    <p class="text-sm text-gray-500">View and manage property owners</p>
                                </div>
                            </div>
                        </a>

                        <a href="{{ route('admin.reports') }}" class="bg-purple-50 hover:bg-purple-100 p-4 rounded-lg border border-purple-200 transition-colors">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-purple-500 rounded-lg flex items-center justify-center mr-3">
                                    <span class="text-white font-bold">📊</span>
                                </div>
                                <div>
                                    <h4 class="text-sm font-medium text-gray-900">View Reports</h4>
                                    <p class="text-sm text-gray-500">Generate system reports</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>

</html>