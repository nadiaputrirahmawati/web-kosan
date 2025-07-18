<aside class="z-20 hidden md:block flex-shrink-0 transition-all duration-300  "
    :class="isSidebarCollapsed ? 'w-20' : 'w-[233px]'">
    <div class="py-2 h-full overflow-y-auto bg-white  text-gray-500 dark:text-gray-400">
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
