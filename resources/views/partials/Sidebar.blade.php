<aside class="z-20 hidden md:block flex-shrink-0 transition-all duration-300 bg-white"
    :class="isSidebarCollapsed ? 'w-20' : 'w-[233px]'">
    <div class="py-4 h-full overflow-y-auto bg-white  text-gray-500 dark:text-gray-400">
        <div class="flex items-center justify-center space-x-3 mt-4">
            <img src="{{ asset('img/image.png') }}" alt="" class="w-10">
            <span x-show="!isSidebarCollapsed" class="text-2xl font-medium text-gray-800">Base</span>
        </div>
        <div class="flex justify-center mt-2">
            <h1 x-show="isSidebarCollapsed" class="text-2xl font-medium text-gray-800">Base</h1>
        </div>

        <div class="mt-10">
            <ul class="mt-2">
                <li class="relative font-medium py-3 px-7 flex items-center gap-3 hover:text-purple-600 {{ request()->is('/') ? 'bg-gradient-to-r from-purple-100 to-transparent text-purple-600 font-semibold' : 'text-blue-500' }}"
                    :class="{ 'justify-center': isSidebarCollapsed }">
                    <a class="flex items-center text-sm  " href="{{ url('') }}">
                        <i class="fa-solid fa-grid-2 text-xl"></i>
                        <span x-show="!isSidebarCollapsed" class="whitespace-nowrap ml-4">Dashboard</span>
                    </a>
                </li>
            </ul>
            <ul class="mt-2">
                <li class="relative font-medium py-3 px-7 flex items-center gap-3 hover:text-purple-600 {{ request()->is('/product') ? 'bg-gradient-to-r from-purple-100 to-transparent text-purple-600 font-semibold' : 'text-gray-500' }}"
                    :class="{ 'justify-center': isSidebarCollapsed }">
                    <a class="flex items-center text-sm  " href="{{ url('') }}">
                        <i class="fas fa-tags text-xl"></i>
                        <span x-show="!isSidebarCollapsed" class="whitespace-nowrap ml-4">Price</span>
                    </a>
                </li>
            </ul>
            <ul class="mt-2">
                <li class="relative font-medium py-3 px-7 flex items-center gap-3 hover:text-purple-600 {{ request()->is('/product') ? 'bg-gradient-to-r from-purple-100 to-transparent text-purple-600 font-semibold' : 'text-gray-500' }}"
                    :class="{ 'justify-center': isSidebarCollapsed }">
                    <a class="flex items-center text-sm  " href="{{ url('') }}">
                        <i class="fa-solid fa-chart-simple text-xl"></i>
                        <span x-show="!isSidebarCollapsed" class="whitespace-nowrap ml-4">Grafik</span>
                    </a>
                </li>
            </ul>
            <ul class="mt-2">
                <li class="relative font-medium py-3 px-7 flex items-center gap-3 hover:text-purple-600 {{ request()->is('/product') ? 'bg-gradient-to-r from-purple-100 to-transparent text-purple-600 font-semibold' : 'text-gray-500' }}"
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
