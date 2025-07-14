<nav class="fixed top-0 left-0 right-0 bg-white shadow-sm z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between h-16">
        <div class="flex items-center">
            <img src="{{ asset('img/simkost.png') }}" alt="" class="w-14">
            <a href="/" class="text-lg font-bold text-primary">SIMKOST</a>
        </div>

        <div class="flex space-x-6">
            <a href="/"
                class="nav-link text-sm hover:text-green-600 {{ request()->is('/') ? 'text-primary font-bold' : '' }}">Cari Kos ?</a>
            <a href="/pricing"
                class="nav-link text-sm hover:text-primary {{ request()->is('pricing') ? 'text-primary font-bold' : '' }}">Cara Sewa</a>
            <a href="/faqs"
                class="nav-link text-sm hover:text-primary {{ request()->is('faqs') ? 'text-primary font-bold' : '' }}">Tentang</a>
            <a href="/solutions"
                class="nav-link text-sm hover:text-primary {{ request()->is('solutions') ? 'text-primary font-bold' : '' }}">Pusat Bantuan</a>
        </div>
        <div class="flex space-x-3">
            <ul class="flex items-center flex-shrink-0 space-x-6" x-data="{ isProfileMenuOpen: false }">
                <li class="relative">
                    <button @click="isProfileMenuOpen = !isProfileMenuOpen"
                        class="align-middle rounded-full focus:shadow-outline-purple focus:outline-none"
                        aria-label="Account" aria-haspopup="true">
                        <img class="object-cover w-8 h-8 rounded-full"
                            src="https://images.unsplash.com/photo-1502378735452-bc7d86632805?ixlib=rb-0.3.5&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=200&fit=max&s=aa3a807e1bbdfd4364d1f449eaa96d82"
                            alt="" aria-hidden="true" />
                    </button>

                    <div x-show="isProfileMenuOpen" @click.outside="isProfileMenuOpen = false"
                        x-transition:enter="transition ease-out duration-150"
                        x-transition:enter-start="opacity-0 transform scale-95"
                        x-transition:enter-end="opacity-100 transform scale-100"
                        x-transition:leave="transition ease-in duration-100"
                        x-transition:leave-start="opacity-100 transform scale-100"
                        x-transition:leave-end="opacity-0 transform scale-95"
                        class="absolute right-0 w-56 p-3 mt-2 space-y-2 text-gray-600 bg-white border border-gray-100 rounded-lg shadow-md z-50"
                        style="display: none;">
                        <div class="flex items-center space-x-2">
                            <img class="object-cover w-10 h-10 rounded-full"
                                src="https://images.unsplash.com/photo-1502378735452-bc7d86632805?ixlib=rb-0.3.5&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=200&fit=max&s=aa3a807e1bbdfd4364d1f449eaa96d82"
                                alt="" aria-hidden="true" />
                            <div>
                                <h1 class="text-sm font-semibold">Admin</h1>
                                <h1 class="text-xs font-light">admin@gmail.com</h1>
                            </div>
                        </div>

                        <a href="#" class="flex items-center w-full px-1 py-1 text-sm pt-3">
                            <i class="fas fa-user-circle mr-3 text-black font-medium"></i>
                            <span class="tracking-wider text-black font-medium">View Profile</span>
                        </a>
                        <a href="#" class="flex items-center w-full px-1 py-1 text-sm">
                            <i class="fas fa-sliders-h mr-3 text-black font-medium"></i>
                            <span class="tracking-wider text-black font-medium">Account Settings</span>
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-sm text-red-600 hover:text-red-700">Logout</button>
                        </form>
                    </div>
                </li>
            </ul>
            <a href="/signin" class="text-sm text-gray-700 hover:underline border-2 border-primary px-4 rounded-lg py-2">Sign In</a>
            <a href="/signup"
                class="text-sm text-white hover:underline border-2 bg-primary border-primary px-4 rounded-lg py-2">Sign Up</a>
        </div>
    </div>
</nav>
