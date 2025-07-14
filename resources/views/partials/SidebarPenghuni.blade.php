<aside class="z-20 hidden md:block flex-shrink-0 transition-all duration-300  w-[233px]  rounded-xl">
    <div class="py-2 h-full overflow-y-auto  text-gray-800">
        <div class="flex items-center justify-center space-x-3 mt-4">
            <div class="bg-white shadow-sm rounded-xl p-2 w-full">
                <h1 class="text-sm font-semibold"> Lengkapi Profile Anda </h1>
                <h1 class="text-xs font-semibold"> {{ Auth::user()->name }}</h1>
                <p class="text-xs">Silahkan Lengkapi Profile Anda </p>
            </div>
            {{-- <span x-show="!isSidebarCollapsed" class="text-2xl font-medium text-gray-800">Base</span> --}}
        </div>
        {{-- <div class="flex justify-center mt-2">
            <h1 x-show="isSidebarCollapsed" class="text-2xl font-medium text-gray-800">Base</h1>
        </div> --}}

        <div class="mt-3">
            <ul class="mt-2">
                <li class="relative font-medium py-3 px-7 flex items-center gap-3  {{ request()->is('admin/dashboard') ? 'bg-gradient-to-r from-primary to-secondary text-white font-semibold' : 'text-primary font-semibold ' }}"
                    :class="{ 'justify-center': isSidebarCollapsed }">
                    <a class="flex items-center text-sm  " href="{{ url('') }}">
                        <i class="fa-solid fa-grid-2 text-xl"></i>
                        <span x-show="!isSidebarCollapsed" class="whitespace-nowrap ml-4">Dashboard</span>
                    </a>
                </li>
            </ul>
            <ul class="mt-2">
                <li class="relative font-medium py-3 px-7 flex items-center gap-3  {{ request()->is('s/dashboard') ? 'bg-gradient-to-r from-primary to-secondary text-white font-semibold' : 'text-primary hover:font-semibold' }}"
                    :class="{ 'justify-center': isSidebarCollapsed }">
                    <a class="flex items-center text-sm  " href="{{ url('') }}">
                        <i class="fas fa-tags text-xl"></i>
                        <span x-show="!isSidebarCollapsed" class="whitespace-nowrap ml-4">Price</span>
                    </a>
                </li>
            </ul>
            <ul class="mt-2">
                <li class="relative font-medium py-3 px-7 flex items-center gap-3  {{ request()->is('/product') ? 'bg-gradient-to-r from-purple-100 to-transparent  font-semibold' : 'text-primary hover:font-semibold' }}"
                    :class="{ 'justify-center': isSidebarCollapsed }">
                    <a class="flex items-center text-sm  " href="{{ url('') }}">
                        <i class="fa-solid fa-chart-simple text-xl"></i>
                        <span x-show="!isSidebarCollapsed" class="whitespace-nowrap ml-4">Grafik</span>
                    </a>
                </li>
            </ul>
            <ul class="mt-2">
                <li class="relative font-medium py-3 px-7 flex items-center gap-3 {{ request()->is('/product') ? 'bg-gradient-to-r from-purple-100 to-transparent  font-semibold' : 'text-primary hover:font-semibold' }}"
                    :class="{ 'justify-center': isSidebarCollapsed }">
                    <a class="flex items-center text-sm  " href="{{ url('') }}">
                        <i class="fas fa-cubes text-xl"></i>
                        <span x-show="!isSidebarCollapsed" class="whitespace-nowrap ml-4">Product</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</aside>
