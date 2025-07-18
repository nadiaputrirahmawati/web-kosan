<div x-data="{ isSidebarOpen: false, isProfileMenuOpen: false }" class="relative">
    <!-- Header -->
    <header class="z-10 py-4 bg-transparent ">
        <div class="container flex items-center justify-between  h-full lg:px-16 px-10 mx-auto text-primary">
            <!-- Buka Tutup Icons -->
            <button @click="isSidebarCollapsed = !isSidebarCollapsed"
                class="p-1 -ml-14 hidden lg:flex rounded-md focus:outline-none focus:shadow-outline-purple">
                <i class="fa-solid fa-bars text-2xl"></i>
            </button>
            <!-- Mobile hamburger -->
            <button @click="isSidebarOpen = !isSidebarOpen"
                class="p-1 mr-5 -ml-2 rounded-md md:hidden focus:outline-none focus:shadow-outline-purple">
                <i class="fa-solid fa-bars text-2xl"></i>
            </button>
            <!-- Profile menu -->
            <ul class="flex items-center flex-shrink-0 space-x-6">
                <li class="relative">
                    <button @click="isProfileMenuOpen = !isProfileMenuOpen"
                        class="align-middle rounded-full focus:shadow-outline-purple focus:outline-none"
                        aria-label="Account" aria-haspopup="true">
                        <img class="object-cover w-8 h-8 rounded-full"
                            src="{{ Auth::user()->profile_picture ? asset('storage/' . Auth::user()->profile_picture) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&background=0D8ABC&color=fff&size=128' }}"
                            alt="Foto Profil">

                    </button>

                    <!-- Dropdown -->
                    <div x-show="isProfileMenuOpen" @click.outside="isProfileMenuOpen = false"
                        class="absolute right-0 w-56 p-3 mt-2 space-y-2 text-gray-600 bg-white border border-gray-100 rounded-lg shadow-md "
                        x-transition:enter="transition ease-out duration-150"
                        x-transition:enter-start="opacity-0 transform scale-95"
                        x-transition:enter-end="opacity-100 transform scale-100"
                        x-transition:leave="transition ease-in duration-100"
                        x-transition:leave-start="opacity-100 transform scale-100"
                        x-transition:leave-end="opacity-0 transform scale-95">
                        <div class="flex items-center space-x-2">
                            <img class="object-cover w-8 h-8 rounded-full"
                                src="{{ Auth::user()->profile_picture ? asset('storage/' . Auth::user()->profile_picture) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&background=0D8ABC&color=fff&size=128' }}"
                                alt="Foto Profil">
                            <div>
                                <h1 class="text-sm font-semibold"> {{ Auth::user()->name }} </h1>
                                <h1 class="text-xs font-light"> {{ Auth::user()->email }}</h1>
                            </div>
                        </div>

                        <a href="{{ route('profile.update') }}" class="flex items-center w-full px-1 py-1 text-sm pt-3">
                            <i class="fas fa-user-circle mr-3 text-black font-medium"></i>
                            <span class="tracking-wider  text-black font-medium"> View Profile</span>
                        </a>
                        <a href="{{ route('owner.profile.create', Auth::user()->id) }}"
                            class="flex items-center w-full px-1 py-1 text-sm">
                            <i class="fas fa-sliders-h mr-3 text-black font-medium"></i>
                            <span class="tracking-wider  text-black font-medium"> Account Settings </span>
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-sm text-red-600 hover:text-red-700">Logout</button>
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </header>

    <!-- Sidebar -->
    <aside x-show="isSidebarOpen" @click.outside="isSidebarOpen = false"
        class="fixed inset-y-0 z-20 w-60 mt-16 overflow-y-auto bg-white  shadow-xl md:hidden"
        x-transition:enter="transition ease-out duration-150"
        x-transition:enter-start="opacity-0 transform -translate-x-20"
        x-transition:enter-end="opacity-100 transform translate-x-0"
        x-transition:leave="transition ease-in duration-100"
        x-transition:leave-start="opacity-100 transform translate-x-0"
        x-transition:leave-end="opacity-0 transform -translate-x-20">

        <div class="py-4 text-gray-500 dark:text-gray-400">
            <div class="flex items-center justify-center space-x-3 mt-4">
                <img src="{{ asset('img/simcard.png') }}" alt="" class="w-[120px]">
            </div>
            <div class="mt-3">
                <ul class="mt-2">
                    <li class="relative font-medium py-3 px-7 flex items-center gap-3  {{ request()->is('owner/dashboard') ? 'bg-gradient-to-r from-primary to-secondary text-white font-semibold' : 'text-primary font-semibold ' }}"
                        :class="{ 'justify-center': isSidebarCollapsed }">
                        <a class="flex items-center text-sm  " href="{{ url('/owner/dashboard') }}">
                            <i class="fa-solid fa-grid-2 text-xl"></i>
                            <span x-show="!isSidebarCollapsed" class="whitespace-nowrap ml-4">Dashboard</span>
                        </a>
                    </li>
                </ul>
                <ul class="mt-2">
                    <li class="relative font-medium py-3 px-7 flex items-center gap-3  {{ request()->is('owner/room') ? 'bg-gradient-to-r from-primary to-secondary text-white font-semibold' : 'text-primary hover:font-semibold' }}"
                        :class="{ 'justify-center': isSidebarCollapsed }">
                        <a class="flex items-center text-sm  " href="{{ url('/owner/room') }}">
                            <i class="fas fa-tags text-xl"></i>
                            <span x-show="!isSidebarCollapsed" class="whitespace-nowrap ml-4">Kost</span>
                        </a>
                    </li>
                </ul>
                <ul class="mt-2">
                    <li class="relative font-medium py-3 px-7 flex items-center gap-3  {{ request()->is('owner/room/contract') ? 'bg-gradient-to-r from-primary to-secondary text-white font-semibold' : 'text-primary hover:font-semibold' }}"
                        :class="{ 'justify-center': isSidebarCollapsed }">
                        <a class="flex items-center text-sm  " href="{{ url('/owner/room/contract') }}">
                            <i class="fa-solid fa-chart-simple text-xl"></i>
                            <span x-show="!isSidebarCollapsed" class="whitespace-nowrap ml-4">Management Penghuni</span>
                        </a>
                    </li>
                </ul>
                <ul class="mt-2">
                    <li class="relative font-medium py-3 px-7 flex items-center gap-3 {{ request()->is('owner/withdrawals*') ? 'bg-gradient-to-r from-primary to-secondary text-white font-semibold' : 'text-primary font-semibold' }}"
                        :class="{ 'justify-center': isSidebarCollapsed }">
                        <a class="flex items-center text-sm" href="{{ url('owner/withdrawals') }}">
                            <i class="fas fa-cubes text-xl"></i>
                            <span x-show="!isSidebarCollapsed" class="whitespace-nowrap ml-4">Pendapatan</span>
                        </a>
                    </li>
                </ul>
                <ul class="mt-2">
                    <li class="relative font-medium py-3 px-7 flex items-center gap-3 {{ request()->is('owner/complaints*') ? 'bg-gradient-to-r from-primary to-secondary text-white font-semibold' : 'text-primary font-semibold' }}"
                        :class="{ 'justify-center': isSidebarCollapsed }">
                        <a class="flex items-center text-sm" href="{{ url('owner/complaints') }}">
                            <i class="fas fa-comments text-xl"></i>
                            <span x-show="!isSidebarCollapsed" class="whitespace-nowrap ml-4">Komplain</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </aside>
</div>
