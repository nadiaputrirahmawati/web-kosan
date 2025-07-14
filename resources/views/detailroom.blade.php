@extends('layout.landingpage')

@section('content')
    <div class="p-5" x-data="{ activeImage: '{{ asset('storage/' . $room->galleries[0]->image_url) }}' }">
        {{-- Galeri Gambar --}}
        @if ($room->galleries->isNotEmpty())
            <div class="flex">
                {{-- Gambar Utama --}}
                <div class="w-4/5">
                    <img :src="activeImage" class="w-full h-64 object-cover rounded-xl" alt="Foto Utama">
                </div>
                {{-- Thumbnail --}}
                <div class="w-1/5 pl-4 flex flex-col space-y-2  max-h-64">
                    @foreach ($room->galleries as $gallery)
                        <img src="{{ asset('storage/' . $gallery->image_url) }}"
                            class="w-full h-16 object-cover rounded cursor-pointer border border-gray-200 hover:scale-105 transition-transform duration-150"
                            alt="Thumbnail" @click="activeImage = '{{ asset('storage/' . $gallery->image_url) }}'">
                    @endforeach
                </div>
            </div>
        @endif
        <div class="flex space-x-3 w-full">
            {{-- Kiri: Konten Detail Kamar --}}
            <div class="w-7/12 overflow-y-auto">
                {{-- Detail Kamar --}}
                <div class="bg-white shadow-sm rounded-xl p-6 mt-4">
                    <h1 class="text-sm font-semibold text-gray-800 mt-2">Nama Kamar</h1>
                    <h1 class="text-2xl font-bold mt-1">{{ $room->name }}</h1>
                    <h1 class="text-sm"><i class="fa-light fa-location-dot mr-1 ml-2 mt-1"></i> {{ $room->address }}</h1>

                    <h1
                        class="text-sm font-semibold text-gray-800 bg-orange-50 border-orange-400 border px-3 py-1 text-center rounded-lg">
                        Informasi Kamar
                    </h1>

                    <div class="flex flex-col justify-between mt-3 space-y-3">
                        {{-- Type --}}
                        <div class="flex">
                            <i class="fa-light fa-users mr-2 bg-base text-primary px-3 py-2 rounded-lg text-xs"></i>
                            <div>
                                <h1 class="font-bold text-xs capitalize">{{ $room->type }}</h1>
                                <h1 class="text-[11px]">Type Kamar</h1>
                            </div>
                        </div>

                        {{-- Harga --}}
                        <div class="flex">
                            <i
                                class="fa-light fa-money-bill-wave mr-2 bg-base text-primary px-3 py-2 rounded-lg text-xs"></i>
                            <div>
                                <h1 class="font-bold text-xs">Rp. {{ number_format($room->price, 0, ',', '.') }}</h1>
                                <h1 class="text-[11px]">Harga Kamar</h1>
                            </div>
                        </div>

                        {{-- Jumlah --}}
                        <div class="flex">
                            <i
                                class="fa-light fa-door-open mr-2 bg-blue-100 text-blue-900 px-3 py-2 rounded-lg text-xs"></i>
                            <div>
                                <h1 class="font-bold text-xs">{{ $room->quantity }}</h1>
                                <h1 class="text-[11px] font-semibold text-black">Kamar Tersedia</h1>
                            </div>
                        </div>

                        {{-- Deposit --}}
                        <div class="flex">
                            <i
                                class="fa-light fa-wallet mr-2 bg-orange-50 text-orange-900 px-3 py-2 rounded-lg text-xs"></i>
                            <div>
                                <h1 class="font-bold text-xs">Rp. {{ number_format($room->deposit_amount, 0, ',', '.') }}
                                </h1>
                                <h1 class="text-[11px] font-semibold text-black">Deposito</h1>
                            </div>
                        </div>
                    </div>

                    <h1 class="mt-4 font-bold text-lg">Deskripsi Kamar</h1>
                    <p class="text-sm text-gray-700">{{ $room->description }}</p>
                    {{-- Aturan Kos --}}
                    @if (!empty($room->regulation))
                        <h1 class="text-lg font-bold text-gray-800 mt-4">- Aturan Kos</h1>
                        <ul class="list-disc list-inside text-gray-700 mt-2">
                            @foreach ($room->regulation as $item)
                                <li class="text-sm">{{ $item }}</li>
                            @endforeach
                        </ul>
                    @endif

                    {{-- Fasilitas Umum --}}
                    @if (!empty($room->public_facility))
                        <h1 class="text-lg font-bold text-gray-800 mt-4">- Fasilitas Umum</h1>
                        <ul class="list-disc list-inside text-gray-700 mt-2">
                            @foreach ($room->public_facility as $item)
                                <li class="text-sm">{{ $item }}</li>
                            @endforeach
                        </ul>
                    @endif

                    {{-- Fasilitas Kamar --}}
                    @if (!empty($room->room_facility))
                        <h1 class="text-lg font-bold text-gray-800 mt-4">- Fasilitas Kamar</h1>
                        <ul class="list-disc list-inside text-gray-700 mt-2">
                            @foreach ($room->room_facility as $item)
                                <li class="text-sm">{{ $item }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>

            {{-- Kanan: Sticky Informasi Kamar --}}
            <div class="w-5/12 mt-5">
                <div class="bg-white shadow rounded-lg p-5 sticky top-24">
                    <h1 class="font-bold text-xl">Rp. {{ number_format($room->price, 0, ',', '.') }} / Bulan </h1>
                    <h1>Deposito: Rp. {{ number_format($room->deposit_amount, 0, ',', '.') }}</h1>

                    <div class="bg-gray-200 p-3 mt-3">
                        <h1>Deposito adalah uang jaminan yang harus Anda bayarkan sebelum mulai sewa kamar.</h1>
                    </div>

                    <label for="start_date" required class="block mt-4 mb-2 text-sm font-medium text-gray-700">Tanggal Mulai
                        Sewa</label>
                    <input type="date" id="start_date" name="start_date"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring focus:border-primary">

                    {{-- Cek status login & profil --}}
                    <div class="mt-5">
                        @guest
                            {{-- Belum login --}}
                            <a href="{{ route('user.login') }}" class="bg-primary text-white py-3 px-4 rounded inline-block">
                                Login untuk Sewa
                            </a>
                        @else
                            {{-- Sudah login --}}
                            @php
                                $user = Auth::user();
                                $isProfileComplete = $user->phone_number && $user->address;
                            @endphp

                            @if (!$isProfileComplete)
                                {{-- Profil belum lengkap --}}
                                <a href="{{ route('profile.edit') }}"
                                    class="bg-yellow-500 text-white py-3 px-4 rounded inline-block">
                                    Lengkapi Profil untuk Sewa
                                </a>
                            @else
                                {{-- Profil lengkap, bisa ajukan sewa --}}
                                {{-- <form action="{{ route('sewa.ajukan', $room->id) }}" method="POST"> --}}
                                    @csrf
                                    <input type="hidden" name="start_date" id="start_date_hidden">
                                    <button type="submit"
                                        onclick="document.getElementById('start_date_hidden').value = document.getElementById('start_date').value"
                                        class="bg-primary text-white py-3 px-4 rounded inline-block w-full text-center">
                                        Ajukan Sewa
                                    </button>
                                {{-- </form> --}}
                            @endif
                        @endguest
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
