<aside class="z-20 hidden md:block flex-shrink-0 transition-all duration-300 w-[233px] rounded-xl">
    <div class="py-2 h-full  text-gray-800">
        <div class="flex items-center justify-center space-x-3">
            <div class="bg-white shadow rounded-xl p-2 w-full">
                <div class="flex justify-center">
                    @php
                        $profilePicture = Auth::user()->profile_picture
                            ? asset('storage/' . Auth::user()->profile_picture)
                            : asset('img/gambarkos.png');
                    @endphp

                    <img id="preview-profile" src="{{ $profilePicture }}" class="w-16 h-16 rounded-full object-cover">
                </div>
                <h1 class="text-md font-semibold text-center text-sm">{{ Auth::user()->name }}</h1>
                <div class="flex justify-center">
                    @if (Auth::user()->no_ktp == null)
                        <a href="{{ route('user.profile.update') }}" class="bg-primary py-2 px-3 text-white text-xs rounded-md">Lengkapi Profile Anda</a>
                    @else
                        <a href="{{ route('user.profile.update') }}" class="bg-base border-primary border text-primary py-1 px-2 mt-3 text-xs rounded-md">Update Profile</a>
                    @endif
                </div>
            </div>
        </div>

        <div class="mt-3">
            <ul class="mt-2">
                <li class="relative font-medium py-3 px-5 flex items-center gap-3 {{ request()->is('user/dashboard') ? 'bg-gradient-to-r from-tertiary to-quaternary text-primary font-semibold rounded-lg' : 'text-primary font-semibold' }}">
                    <a class="flex items-center text-sm" href="{{ url('user/dashboard') }}">
                        <i class="fa-solid fa-grid-2 text-xl"></i>
                        <span class="whitespace-nowrap ml-4">Dashboard</span>
                    </a>
                </li>
                <li class="relative font-medium py-3 px-5 flex items-center gap-3 {{ request()->is('user/room') ? 'bg-gradient-to-r from-tertiary to-quaternary text-primary font-semibold rounded-lg' : 'text-primary hover:font-semibold' }}">
                    <a class="flex items-center text-sm" href="{{ url('user/room') }}">
                        <i class="fa-light fa-door-open text-xl"></i>
                        <span class="whitespace-nowrap ml-4">Kost Saya</span>
                    </a>
                </li>
                <li class="relative font-medium py-3 px-5 flex items-center gap-3 {{ request()->is('user/room/contract') ? 'bg-gradient-to-r from-tertiary to-quaternary text-primary font-semibold rounded-lg' : 'text-primary hover:font-semibold' }}">
                    <a class="flex items-center text-sm" href="{{ url('user/room/contract') }}">
                        <i class="fa-solid fa-chart-simple text-xl"></i>
                        <span class="whitespace-nowrap ml-4">Riwayat Pengajuan Sewa</span>
                    </a>
                </li>
                <li class="relative font-medium py-3 px-5 flex items-center gap-3 {{ request()->is('user/complaints*') ? 'bg-gradient-to-r from-tertiary to-quaternary text-primary font-semibold rounded-lg' : 'text-primary hover:font-semibold' }}">
                    <a class="flex items-center text-sm" href="{{ url('user/complaints') }}">
                        <i class="fas fa-comments text-xl"></i>
                        <span class="whitespace-nowrap ml-4">Complaint</span>
                    </a>
                </li>
                <li class="relative font-medium py-3 px-5 flex items-center gap-3 {{ request()->is('user/room/favorite') ? 'bg-gradient-to-r from-tertiary to-quaternary text-primary font-semibold rounded-lg' : 'text-primary hover:font-semibold' }}">
                    <a class="flex items-center text-sm" href="{{ url('user/room/favorite') }}">
                        <i class="fas fa-cubes text-xl"></i>
                        <span class="whitespace-nowrap ml-4">Simpan Kost</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</aside>

<!-- Mobile Bottom Navbar -->
<nav class="fixed bottom-0 left-0 right-0 z-30 bg-white border-t border-gray-200 md:hidden shadow-md">
    <div class="flex justify-between items-center px-6 py-2 text-xs text-gray-700">
        <a href="{{ url('user/dashboard') }}" class="flex flex-col items-center justify-center {{ request()->is('user/dashboard') ? 'text-primary' : '' }}">
            <i class="fa-solid fa-grid-2 text-lg"></i>
            <span class="text-[11px] mt-1">Dashboard</span>
        </a>
        <a href="{{ url('user/room') }}" class="flex flex-col items-center justify-center {{ request()->is('user/room') ? 'text-primary' : '' }}">
            <i class="fa-light fa-door-open text-lg"></i>
            <span class="text-[11px] mt-1">Kost</span>
        </a>
        <a href="{{ url('user/room/contract') }}" class="flex flex-col items-center justify-center {{ request()->is('user/room/contract') ? 'text-primary' : '' }}">
            <i class="fa-solid fa-chart-simple text-lg"></i>
            <span class="text-[11px] mt-1">Riwayat</span>
        </a>
        <a href="{{ url('user/room/favorite') }}" class="flex flex-col items-center justify-center {{ request()->is('user/room/favorite') ? 'text-primary' : '' }}">
            <i class="fas fa-cubes text-lg"></i>
            <span class="text-[11px] mt-1">Simpan</span>
        </a>
    </div>
</nav>
