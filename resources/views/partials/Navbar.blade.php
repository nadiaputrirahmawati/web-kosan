<!-- Bungkus semua konten dalam 1 x-data -->
<div x-data="{
    isMobileMenuOpen: false,
    isProfileMenuOpen: false,
    isLoginModalOpen: false,
    isRegisterModalOpen: false
}">
    <nav class="fixed top-0 left-0 right-0 bg-white shadow-sm z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between h-16">
            <!-- Logo -->
            <div class="flex items-center">
                <img src="{{ asset('img/simkost.png') }}" alt="Logo" class="w-10 h-10">
                <a href="/" class="ml-2 text-lg font-bold text-primary">SIMKOST</a>
            </div>

            <!-- Desktop Menu -->
            <div class="hidden md:flex space-x-6">
                <a href="/"
                    class="nav-link text-sm hover:text-green-600 {{ request()->is('/') ? 'text-primary font-bold' : '' }}">Cari
                    Kos ?</a>
                <a href="/pricing"
                    class="nav-link text-sm hover:text-primary {{ request()->is('pricing') ? 'text-primary font-bold' : '' }}">Cara
                    Sewa</a>
                <a href="/faqs"
                    class="nav-link text-sm hover:text-primary {{ request()->is('faqs') ? 'text-primary font-bold' : '' }}">Tentang</a>
                <a href="/solutions"
                    class="nav-link text-sm hover:text-primary {{ request()->is('solutions') ? 'text-primary font-bold' : '' }}">Pusat
                    Bantuan</a>
            </div>

            <!-- Desktop Profile -->
            <div class="hidden md:flex space-x-3 items-center">
                @if (Auth::check())
                    <div class="relative">
                        <button @click="isProfileMenuOpen = !isProfileMenuOpen" class="focus:outline-none">
                            <img class="w-8 h-8 rounded-full object-cover"
                                src="{{ Auth::user()->profile_picture ? asset('storage/' . Auth::user()->profile_picture) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) }}"
                                alt="Profile" />
                        </button>
                        <div x-show="isProfileMenuOpen" @click.outside="isProfileMenuOpen = false"
                            class="absolute right-0 mt-2 w-56 bg-white border rounded-lg shadow-md z-50 p-3"
                            x-transition x-cloak>
                            <div class="flex items-center space-x-2">
                                <img class="w-10 h-10 rounded-full object-cover"
                                    src="{{ Auth::user()->profile_picture ? asset('storage/' . Auth::user()->profile_picture) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) }}"
                                    alt="Profile">
                                <div>
                                    <h1 class="text-sm font-semibold">{{ Auth::user()->name }}</h1>
                                    <h1 class="text-xs text-gray-500">{{ Auth::user()->email }}</h1>
                                </div>
                            </div>
                            <a href="#" class="block text-sm pt-3">View Profile</a>
                            <a href="#" class="block text-sm">Account Settings</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="text-sm text-red-600 hover:text-red-700 mt-2">Logout</button>
                            </form>
                        </div>
                    </div>
                @else
                    <button @click="isLoginModalOpen = true"
                        class="text-sm text-gray-700 hover:underline border-2 border-primary px-4 rounded-lg py-2">Log
                        In</button>

                    <button @click="isRegisterModalOpen = true"
                        class="text-sm text-white bg-primary border border-primary px-4 rounded-lg py-2">Sign
                        Up</button>
                @endif
            </div>

            <!-- Mobile Hamburger + Profile -->
            <div class="md:hidden flex items-center space-x-4 ml-auto">
                <!-- Hamburger -->
                <button @click="isMobileMenuOpen = !isMobileMenuOpen" class="text-gray-700 focus:outline-none">
                    <svg x-show="!isMobileMenuOpen" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg x-show="isMobileMenuOpen" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" x-cloak>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>

                <!-- Profile Button -->
                @if (Auth::check())
                    <div class="relative">
                        <button @click="isProfileMenuOpen = !isProfileMenuOpen" class="focus:outline-none">
                            <img class="w-8 h-8 rounded-full object-cover"
                                src="{{ Auth::user()->profile_picture ? asset('storage/' . Auth::user()->profile_picture) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) }}"
                                alt="Profile">
                        </button>

                        <!-- Dropdown Profile -->
                        <div x-show="isProfileMenuOpen" @click.outside="isProfileMenuOpen = false"
                            class="absolute right-0 mt-2 w-56 bg-white border rounded-lg shadow-md z-50 p-3"
                            x-transition x-cloak>
                            <div class="flex items-center space-x-2">
                                <img class="w-10 h-10 rounded-full object-cover"
                                    src="{{ Auth::user()->profile_picture ? asset('storage/' . Auth::user()->profile_picture) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) }}"
                                    alt="Profile">
                                <div>
                                    <h1 class="text-sm font-semibold">{{ Auth::user()->name }}</h1>
                                    <h1 class="text-xs text-gray-500">{{ Auth::user()->email }}</h1>
                                </div>
                            </div>
                            <a href="#" class="block text-sm pt-3">View Profile</a>
                            <a href="#" class="block text-sm">Account Settings</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="text-sm text-red-600 hover:text-red-700 mt-2">Logout</button>
                            </form>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Mobile Menu -->
        <div x-show="isMobileMenuOpen" class="md:hidden absolute top-16 left-0 w-full bg-white shadow-md border-t z-40"
            x-cloak x-transition>
            <div class="p-4 space-y-2">
                <a href="/" class="block text-sm {{ request()->is('/') ? 'text-primary font-bold' : '' }}">Cari
                    Kos
                    ?</a>
                <a href="/pricing"
                    class="block text-sm {{ request()->is('pricing') ? 'text-primary font-bold' : '' }}">Cara Sewa</a>
                <a href="/faqs"
                    class="block text-sm {{ request()->is('faqs') ? 'text-primary font-bold' : '' }}">Tentang</a>
                <a href="/solutions"
                    class="block text-sm {{ request()->is('solutions') ? 'text-primary font-bold' : '' }}">Pusat
                    Bantuan</a>
            </div>
        </div>
    </nav>

    <div x-show="isLoginModalOpen" x-transition x-cloak
        class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
        <div @click.outside="isLoginModalOpen = false" class="bg-white w-96 p-6 rounded-lg shadow-lg">
            {{-- <div class="flex justify-end text-end"> --}}
            <button @click="isLoginModalOpen = false"
                class="w-full text-sm text-gray-600 hover:underline text-end"><i
                    class="fa-solid fa-xmark-large"></i></button>
            {{-- </div> --}}
            <h2 class="text-xl font-semibold mb-4 text-center"> Silahkan Login </h2>
            <div class="space-y-3">
                <div class="bg-white p-2 shadow">
                    <a href="/user/login" class="">
                        <div class="flex">
                            <img src="{{ asset('img/1.png') }}" alt="" class="w-16">
                            <h1 class="mt-5 font-semibold">Masuk Sebagai Penghuni Kost</h1>
                        </div>
                    </a>
                </div>
                <div class="bg-white p-2 shadow">
                    <a href="/owner/login" class="">
                        <div class="flex">
                            <img src="{{ asset('img/5.png') }}" alt="" class="w-16">
                            <h1 class="mt-5 font-semibold">Masuk Sebagai Pemilik Kost</h1>
                        </div>
                    </a>
                </div>
            </div>

        </div>
    </div>

    <div x-show="isRegisterModalOpen" x-transition x-cloak
        class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
        <div @click.outside="isRegisterModalOpen = false" class="bg-white w-96 p-6 rounded-lg shadow-lg">
            <button  @click="isRegisterModalOpen = false"
                class=" w-full text-sm text-gray-600 hover:underline text-end"><i
                    class="fa-solid fa-xmark-large"></i></button>
            <h2 class="text-xl font-semibold mb-4 text-center"> Silahkan Register </h2>
            <div class="space-y-3">
                <div class="bg-white p-2 shadow">
                    <a href="/user/register" class="">
                        <div class="flex">
                            <img src="{{ asset('img/1.png') }}" alt="" class="w-16">
                            <h1 class="mt-5 font-semibold">Masuk Sebagai Penghuni Kost</h1>
                        </div>
                    </a>
                </div>
                <div class="bg-white p-2 shadow">
                    <a href="/owner/register" class="">
                        <div class="flex">
                            <img src="{{ asset('img/5.png') }}" alt="" class="w-16">
                            <h1 class="mt-5 font-semibold">Masuk Sebagai Pemilik Kost</h1>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
