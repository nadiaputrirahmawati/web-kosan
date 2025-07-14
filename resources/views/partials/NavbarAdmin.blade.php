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
                            src="https://images.unsplash.com/photo-1502378735452-bc7d86632805?ixlib=rb-0.3.5&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=200&fit=max&s=aa3a807e1bbdfd4364d1f449eaa96d82"
                            alt="" aria-hidden="true" />
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
                            <img class="object-cover w-10 h-10 rounded-full"
                                src="https://images.unsplash.com/photo-1502378735452-bc7d86632805?ixlib=rb-0.3.5&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=200&fit=max&s=aa3a807e1bbdfd4364d1f449eaa96d82"
                                alt="" aria-hidden="true" />
                            <div>
                                <h1 class="text-sm font-semibold"> Admin </h1>
                                <h1 class="text-xs font-light"> admin@gmail.com</h1>
                            </div>
                        </div>

                        <a href="#" class="flex items-center w-full px-1 py-1 text-sm pt-3">
                            <i class="fas fa-user-circle mr-3 text-black font-medium"></i>
                            <span class="tracking-wider  text-black font-medium"> View Profile</span>
                        </a>
                        <a href="#" class="flex items-center w-full px-1 py-1 text-sm">
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
