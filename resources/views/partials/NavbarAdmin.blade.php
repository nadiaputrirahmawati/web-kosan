<div x-data="{ isSidebarOpen: false, isProfileMenuOpen: false }" class="relative">
    <!-- Header -->
    <header class="z-10 py-4 bg-transparent ">
        <div class="container flex items-center justify-between  h-full lg:px-16 px-10 mx-auto text-primary">
            <!-- Buka Tutup Icons -->
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
            <div class="flex justify-center space-x-3 mt-4">
                <a class=" text-2xl font-bold text-gray-800 " href="#">
                    <img src="{{ asset('img/image.png') }}" alt="" class="w-12">
                </a>
                <a class=" text-2xl font-medium text-gray-800 mt-2 " href="#">
                    Base
                </a>
            </div>
            <div class="mt-10">
                <ul class="mt-2">
                    <li
                        class="relative font-medium px-8 py-3  text-gray-600  tracking-wider  
                        {{ request()->is('/') ? 'bg-gradient-to-r from-purple-100 to-transparent text-purple-600 font-semibold' : 'text-gray-600 hover:text-purple-600 hover:font-semibold' }}">
                        <a class="flex items-center text-md  " href="{{ url('') }}">
                            <i class="fa-solid fa-grid-2 text-xl"></i>
                            <span class="ml-3 ">Dashboard</span>
                        </a>
                    </li>
                    <li
                        class="relative font-medium px-8 py-3 mt-2  text-gray-600  tracking-wider  
                        {{ request()->is('/form') ? 'bg-gradient-to-r from-purple-100 to-transparent text-purple-600 font-semibold' : 'text-gray-600 hover:text-purple-600 hover:font-semibold' }}">
                        <a class="flex items-center text-md  " href="{{ url('') }}">
                            <i class="fa-light fa-grid-2-plus text-xl"></i>
                            <span class="ml-3">Price</span>
                        </a>
                    </li>
                    <li
                        class="relative font-medium px-8 py-3 mt-2  text-gray-600  tracking-wider  
                        {{ request()->is('/product') ? 'bg-gradient-to-r from-purple-100 to-transparent text-purple-600 font-semibold' : 'text-gray-600 hover:text-purple-600 hover:font-semibold' }}">
                        <a class="flex items-center text-md  " href="{{ url('') }}">
                            <i class="fa-solid fa-grid-2 text-xl"></i>
                            <span class="ml-3 ">Grafik</span>
                        </a>
                    </li>
                </ul>
                <ul class="mt-2">
                    <li
                        class="relative font-medium px-8 py-3  text-gray-600  tracking-wider  
                        {{ request()->is('/typo') ? 'bg-gradient-to-r from-purple-100 to-transparent text-purple-600 font-semibold' : 'text-gray-600 hover:text-purple-600 hover:font-semibold' }}">
                        <a class="flex items-center text-md  " href="{{ url('') }}">
                            <i class="fa-regular fa-box"></i>
                            <span class="ml-3">Product</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </aside>
</div>
