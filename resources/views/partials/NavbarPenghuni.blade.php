<nav class="fixed top-0 left-0 right-0 bg-white shadow-sm z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <!-- Logo + Hamburger -->
            <div class="flex items-center">
                <img src="{{ asset('img/simkost.png') }}" alt="Logo" class="w-10 h-10">
                <a href="/" class="ml-2 text-lg font-bold text-primary">SIMKOST</a>
            </div>

            <!-- Hamburger button (mobile) -->
            <div class="md:hidden flex items-center">
                <button @click="isOpen = !isOpen" class="text-gray-700 focus:outline-none" x-data="{ isOpen: false }">
                    <svg x-show="!isOpen" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg x-show="isOpen" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" style="display: none;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>

                    <!-- Mobile Menu -->
                    <div x-show="isOpen" @click.outside="isOpen = false"
                        class="absolute top-16 right-4 w-56 bg-white border rounded-md shadow-lg py-2 z-50">
                        <a href="/" class="block px-4 py-2 text-sm hover:bg-gray-100 {{ request()->is('/') ? 'text-primary font-bold' : '' }}">
                            Cari Kos ?
                        </a>
                        <a href="/pricing" class="block px-4 py-2 text-sm hover:bg-gray-100 {{ request()->is('pricing') ? 'text-primary font-bold' : '' }}">
                            Cara Sewa
                        </a>
                        <a href="/faqs" class="block px-4 py-2 text-sm hover:bg-gray-100 {{ request()->is('faqs') ? 'text-primary font-bold' : '' }}">
                            Tentang
                        </a>
                        <a href="/solutions" class="block px-4 py-2 text-sm hover:bg-gray-100 {{ request()->is('solutions') ? 'text-primary font-bold' : '' }}">
                            Pusat Bantuan
                        </a>

                        @if(Auth::check())
                            <div class="border-t my-2"></div>
                            <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-100">View Profile</a>
                            <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-100">Account Settings</a>
                            <form method="POST" action="{{ route('logout') }}" class="block px-4 py-2">
                                @csrf
                                <button type="submit" class="w-full text-left text-sm text-red-600 hover:text-red-700">Logout</button>
                            </form>
                        @else
                            <div class="border-t my-2"></div>
                            <a href="/signin" class="block px-4 py-2 text-sm hover:bg-gray-100">Sign In</a>
                            <a href="/signup" class="block px-4 py-2 text-sm hover:bg-gray-100">Sign Up</a>
                        @endif
                    </div>
                </button>
            </div>

            <!-- Desktop Menu -->
            <div class="hidden md:flex items-center space-x-6">
                <a href="/" class="text-sm hover:text-primary {{ request()->is('/') ? 'text-primary font-bold' : '' }}">Cari Kos ?</a>
                <a href="/pricing" class="text-sm hover:text-primary {{ request()->is('pricing') ? 'text-primary font-bold' : '' }}">Cara Sewa</a>
                <a href="/faqs" class="text-sm hover:text-primary {{ request()->is('faqs') ? 'text-primary font-bold' : '' }}">Tentang</a>
                <a href="/solutions" class="text-sm hover:text-primary {{ request()->is('solutions') ? 'text-primary font-bold' : '' }}">Pusat Bantuan</a>

                @if (Auth::check())
                    <!-- Profile Dropdown Desktop -->
                    <div x-data="{ isProfileMenuOpen: false }" class="relative">
                        <button @click="isProfileMenuOpen = !isProfileMenuOpen"
                            class="focus:outline-none focus:shadow-outline">
                            <img class="w-8 h-8 rounded-full object-cover"
                                src="{{ Auth::user()->profile_picture ? asset('storage/' . Auth::user()->profile_picture) : 'https://images.unsplash.com/photo-1502378735452-bc7d86632805?ixlib=rb-0.3.5&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=200&fit=max&s=aa3a807e1bbdfd4364d1f449eaa96d82' }}"
                                alt="profile" />
                        </button>

                        <div x-show="isProfileMenuOpen" @click.outside="isProfileMenuOpen = false"
                            class="absolute right-0 w-56 p-3 mt-2 bg-white border rounded-md shadow-md z-50"
                            x-transition>
                            <div class="flex items-center space-x-2 mb-2">
                                <img class="w-10 h-10 rounded-full object-cover"
                                    src="{{ Auth::user()->profile_picture ? asset('storage/' . Auth::user()->profile_picture) : 'https://images.unsplash.com/photo-1502378735452-bc7d86632805?ixlib=rb-0.3.5&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=200&fit=max&s=aa3a807e1bbdfd4364d1f449eaa96d82' }}"
                                    alt="Profile">
                                <div>
                                    <h1 class="text-sm font-semibold">{{ Auth::user()->name }}</h1>
                                    <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
                                </div>
                            </div>

                            <a href="#" class="block text-sm py-1 hover:text-primary">View Profile</a>
                            <a href="#" class="block text-sm py-1 hover:text-primary">Account Settings</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left text-sm text-red-600 hover:text-red-700 mt-2">Logout</button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="/signin"
                        class="text-sm text-gray-700 hover:underline border border-primary px-4 py-2 rounded-lg">Sign In</a>
                    <a href="/signup"
                        class="text-sm text-white bg-primary hover:bg-primary/90 border border-primary px-4 py-2 rounded-lg">Sign Up</a>
                @endif
            </div>
        </div>
    </div>
</nav>
