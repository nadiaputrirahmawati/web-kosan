<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SimKos-Pemilik</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/all.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    @vite('resources/css/app.css')


    <style>
        * {
             font-family: "Nunito", sans-serif;
        }
    </style>
</head>

<body x-data="{ isSidebarCollapsed: false }">
    <div class="flex h-screen bg-white">
        @include('partials.SidebarPemilik')
        <div class="flex flex-col flex-1 w-full">
            @include('partials.NavbarPemilik')
            <main class="h-full overflow-y-auto  lg:p-6 p-2 bg-base">
                    @yield('content')
            </main>
        </div>
    </div>
</body>

</html>
