{{-- layout.blade.php --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Landing Page')</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/all.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    @vite('resources/css/app.css')
    <script defer>
        document.addEventListener('DOMContentLoaded', () => {
            const links = document.querySelectorAll('.nav-link');
            const currentPath = window.location.pathname;
            links.forEach(link => {
                if (link.getAttribute('href') === currentPath) {
                    link.classList.add('text-primary', 'font-bold');
                }
            });
        });
    </script>

    <style>
        * {
            font-family: "Plus Jakarta Sans", sans-serif;
        }
    </style>
</head>

<body>
    @include('partials.Navbar')
        <div class="flex h-screen bg-gray-50 lg:px-28 px-6 pt-20 lg:pb-0 pb-20 lg:pt-20">
            @include('partials.SidebarPenghuni')
            <div class="flex flex-col flex-1 w-full pl-3">
                <main class="h-full overflow-y-auto  p-6 bg-slate-50 border border-gray-300 rounded-lg">
                    @yield('content')
                </main>
            </div>
        </div>
</body>
</html>
