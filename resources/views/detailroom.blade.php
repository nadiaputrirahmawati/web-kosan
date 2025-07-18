@extends('layout.LandingPage')

@section('content')
    @if ($room->galleries->isNotEmpty())
        @php
            $firstImage = asset('storage/' . $room->galleries[0]->image_url);
            $thumbnails = $room->galleries->slice(0, 3);
            $hasMoreThanTwo = $room->galleries->count() > 3;
        @endphp

        <div class="p-5" x-data="{ activeImage: '{{ $firstImage }}' }">
            <div class="flex">
                {{-- Gambar Utama --}}
                <div class="w-8/12">
                    <img :src="activeImage" class="w-full h-96 object-cover rounded-xl" alt="Foto Utama">
                </div>

                {{-- Thumbnail --}}
                <div class="w-4/12 pl-4 flex flex-col space-y-2 max-h-96 overflow-y-auto">
                    @foreach ($thumbnails as $gallery)
                        @php
                            $imageUrl = asset('storage/' . $gallery->image_url);
                        @endphp
                        <template x-if="activeImage !== '{{ $imageUrl }}'">
                            <img src="{{ $imageUrl }}" class="w-full h-[160px] object-cover rounded cursor-pointer"
                                alt="Thumbnail" @click="activeImage = '{{ $imageUrl }}'">
                        </template>
                    @endforeach

                    {{-- Tombol lihat semua gambar --}}
                    @if ($hasMoreThanTwo)
                        <a href="{{ route('room.gallery', $room->room_id) }}"
                            class="bg-primary lg:px-5 px-2 font-bold rounded-lg py-2 text-white text-sm hover:bg-primary/90 transition">
                            Lihat semua gambar ({{ $room->galleries->count() }})
                        </a>
                    @endif
                </div>
            </div>
        </div>
    @endif

    <div class="flex space-x-3 w-full">
        {{-- Kiri: Konten Detail Kamar --}}
        <div class="w-7/12 overflow-y-auto">
            {{-- Detail Kamar --}}
            <div class=" p-6 mt-4">
                <h1 class="text-3xl font-bold mt-1">{{ $room->name }}</h1>
                <div class="flex mt-4">
                    <h1 class="bg-base text-primary px-3 py-1 rounded-lg text-md font-bold capitalize">Kos
                        {{ $room->type }}</h1>
                    <h1 class="text-md"><i class="fa-light fa-location-dot mr-1 ml-2 mt-1"></i> {{ $room->address }}</h1>
                </div>

                <div class="mt-5 flex justify-between w-full">
                    <div>
                        <h1 class="text-lg text-black"> <i class="fa-light fa-door-open mr-3"></i> Simpan Dulu Kos Ini Yuk
                        </h1>
                    </div>
                    <div>
                        {{-- Jika sudah favorit --}}
                        @if ($isFavorited)
                            <form action="{{ route('favorite.delete',$favorite?->favorite_id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="room_id" value="{{ $room->room_id }}">
                                <button type="submit"
                                    class="bg-red-100 text-red-600 lg:px-5 px-2 font-bold rounded-lg py-2 text-sm hover:bg-red-200 transition">
                                    <i class="fa-solid fa-heart mr-2"></i> Disimpan
                                </button>
                            </form>
                        @else
                            {{-- Kalau belum favorit --}}
                            <form action="{{ route('favorite.save') }}" method="POST">
                                @csrf
                                <input type="hidden" name="room_id" value="{{ $room->room_id }}">
                                <button type="submit"
                                    class="bg-base lg:px-5 px-2 font-bold rounded-lg py-2 text-primary text-sm hover:bg-primary/90 hover:text-white transition">
                                    <i class="fa-regular fa-heart mr-2"></i> Simpan
                                </button>
                            </form>
                        @endif
                    </div>

                </div>

                <div class="flex flex-col justify-between  space-y-3 mt-5">
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
                        <i class="fa-light fa-money-bill-wave mr-2 bg-base text-primary px-3 py-2 rounded-lg text-xs"></i>
                        <div>
                            <h1 class="font-bold text-xs">Rp. {{ number_format($room->price, 0, ',', '.') }}</h1>
                            <h1 class="text-[11px]">Harga Kamar</h1>
                        </div>
                    </div>

                    {{-- Jumlah --}}
                    <div class="flex">
                        <i class="fa-light fa-door-open mr-2 bg-blue-100 text-blue-900 px-3 py-2 rounded-lg text-xs"></i>
                        <div>
                            <h1 class="font-bold text-xs">{{ $room->quantity }}</h1>
                            <h1 class="text-[11px] font-semibold text-black">Kamar Tersedia</h1>
                        </div>
                    </div>

                    {{-- Deposit --}}
                    <div class="flex">
                        <i class="fa-light fa-wallet mr-2 bg-orange-50 text-orange-900 px-3 py-2 rounded-lg text-xs"></i>
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
                @if (session('error'))
                    <div class="mb-4">
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
                            role="alert">
                            <strong class="font-bold">Oops!</strong>
                            <span class="block sm:inline">Ada beberapa kesalahan:</span>
                            {{ session('error') }}
                        </div>
                    </div>
                @endif
                <h1 class="font-bold text-xl">Rp. {{ number_format($room->price, 0, ',', '.') }} / Bulan </h1>
                <h1>Deposito: Rp. {{ number_format($room->deposit_amount, 0, ',', '.') }}</h1>

                <div class="bg-gray-200 p-3 mt-3">
                    <h1>Deposito adalah uang jaminan yang harus Anda bayarkan sebelum mulai sewa kamar.</h1>
                </div>

                <label for="start_date" required class="block mt-4 mb-2 text-sm font-medium text-gray-700">Tanggal Mulai
                    Sewa</label>
                <form action="{{ route('user.contract.store') }}" method="post">
                    @csrf
                    @method('POST')
                    <input type="hidden" name="room_id" value="{{ $room->room_id }}" id="">
                    <input type="hidden" name="owner_id" value="{{ $room->owner_id }}" id="">
                    <input type="hidden" name="deposit_amount" value="{{ $room->deposit_amount }}" id="">
                    <input type="date" id="start_date" name="start_date" required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring focus:border-primary">

                    {{-- Cek status login & profil --}}
                    <div class="mt-5">
                        <button type="submit"
                            class="bg-primary text-white py-3 px-4 rounded inline-block w-full text-center">
                            Ajukan Sewa
                        </button>
                </form>
                {{-- </form> --}}
            </div>
        </div>
    </div>

    </div>
    </div>
@endsection
