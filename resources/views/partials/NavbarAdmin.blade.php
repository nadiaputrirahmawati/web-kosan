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
            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button type="submit" class="text-sm text-red-600 hover:text-red-700 px-2 py-1 rounded-lg shadow bg-red-200"><i class="fa-solid fa-right-from-bracket"></i></button>
            </form>
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
            <div class="flex justify-center space-x-3 mt-1">
                <a class=" text-2xl font-bold text-gray-800 " href="#">
                    <img src="{{ asset('img/simcard.png') }}" alt="" class="w-24">
                </a>
            </div>
            <div class="mt-3">
                <ul class="mt-2">
                    <li class="relative font-medium py-3 px-7 flex items-center gap-3  {{ request()->is('admin/dashboard*') ? 'bg-gradient-to-r from-primary to-secondary text-white font-semibold' : 'text-primary font-semibold ' }}"
                        :class="{ 'justify-center': isSidebarCollapsed }">
                        <a class="flex items-center text-sm  " href="{{ url('/admin/dashboard') }}">
                            <i class="fa-solid fa-grid-2 text-xl"></i>
                            <span x-show="!isSidebarCollapsed" class="whitespace-nowrap ml-4">Dashboard</span>
                        </a>
                    </li>
                </ul>
                {{-- <ul class="mt-2">
                <li class="relative font-medium py-3 px-7 flex items-center gap-3  {{ request()->is('owner/room') ? 'bg-gradient-to-r from-primary to-secondary text-white font-semibold' : 'text-primary hover:font-semibold' }}"
                    :class="{ 'justify-center': isSidebarCollapsed }">
                    <a class="flex items-center text-sm  " href="{{ url('/owner/room') }}">
                        <i class="fas fa-tags text-xl"></i>
                        <span x-show="!isSidebarCollapsed" class="whitespace-nowrap ml-4">Room</span>
                    </a>
                </li>
            </ul> --}}
                {{-- <ul class="mt-2">
                <li class="relative font-medium py-3 px-7 flex items-center gap-3  {{ request()->is('/product') ? 'bg-gradient-to-r from-purple-100 to-transparent  font-semibold' : 'text-primary hover:font-semibold' }}"
                    :class="{ 'justify-center': isSidebarCollapsed }">
                    <a class="flex items-center text-sm  " href="{{ url('') }}">
                        <i class="fa-solid fa-chart-simple text-xl"></i>
                        <span x-show="!isSidebarCollapsed" class="whitespace-nowrap ml-4">Management Penghuni</span>
                    </a>
                </li>
            </ul> --}}
                <ul class="mt-2">
                    <li class="relative font-medium py-3 px-7 flex items-center gap-3 {{ request()->is('admin/withdrawals*') ? 'bg-gradient-to-r from-primary to-secondary text-white font-semibold' : 'text-primary font-semibold ' }}"
                        :class="{ 'justify-center': isSidebarCollapsed }">
                        <a class="flex items-center text-sm  " href="{{ url('admin/withdrawals') }}">
                            <i class="fas fa-cubes text-xl"></i>
                            <span x-show="!isSidebarCollapsed" class="whitespace-nowrap ml-4">Pendapatan</span>
                        </a>
                    </li>
                </ul>
                <ul class="mt-2">
                    <li class="relative font-medium py-3 px-7 flex items-center gap-3 {{ request()->is('admin/user-management*') ? 'bg-gradient-to-r from-primary to-secondary text-white font-semibold' : 'text-primary font-semibold' }}"
                        :class="{ 'justify-center': isSidebarCollapsed }">
                        <a class="flex items-center text-sm  " href="{{ url('admin/user-management') }}">
                            <i class="fas fa-user text-xl"></i>
                            <span x-show="!isSidebarCollapsed" class="whitespace-nowrap ml-4">User Management</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </aside>
</div>
