@extends('layout.LandingPage')

@section('content')
    {{-- Gallery Section --}}
    @if ($room->galleries->isNotEmpty())
        @php
            $firstImage = asset('storage/' . $room->galleries[0]->image_url);
            $thumbnails = $room->galleries->slice(0, 4);
            $hasMoreThanFour = $room->galleries->count() > 4;
        @endphp

        <div class="bg-gray-50 py-8" x-data="{ activeImage: '{{ $firstImage }}', showModal: false }">
            <div class="max-w-7xl mx-auto px-4">
                {{-- Breadcrumb --}}
                <nav class="mb-6 text-sm">
                    <ol class="flex items-center space-x-2 text-gray-600">
                        <li><a href="/" class="hover:text-primary">Home</a></li>
                        <li><span class="text-gray-400">/</span></li>
                        <li><a href="#" class="hover:text-primary">Kost</a></li>
                        <li><span class="text-gray-400">/</span></li>
                        <li class="text-gray-900 font-medium">{{ Str::limit($room->name, 30) }}</li>
                    </ol>
                </nav>

                {{-- Gallery Grid --}}
                <div class="grid lg:grid-cols-4 md:grid-cols-3 grid-cols-2 gap-3 rounded-2xl overflow-hidden">
                    {{-- Main Image --}}
                    <div class="lg:col-span-2 lg:row-span-2 md:col-span-2 md:row-span-2 col-span-2 relative group cursor-pointer"
                        @click="showModal = true">
                        <img :src="activeImage" class="w-full h-full object-cover" alt="Foto Utama">
                        <div
                            class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 transition-all duration-300 flex items-center justify-center">
                            <span
                                class="text-white opacity-0 group-hover:opacity-100 transition-all duration-300 text-lg font-semibold">
                                <i class="fa-regular fa-expand mr-2"></i>Lihat Foto
                            </span>
                        </div>
                    </div>

                    {{-- Thumbnails --}}
                    @foreach ($thumbnails->skip(1) as $index => $gallery)
                        @php
                            $imageUrl = asset('storage/' . $gallery->image_url);
                        @endphp
                        <div class="relative group cursor-pointer h-48" @click="activeImage = '{{ $imageUrl }}'">
                            <img src="{{ $imageUrl }}" class="w-full h-full object-cover" alt="Thumbnail">
                            <div
                                class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-300">
                            </div>
                        </div>
                    @endforeach

                    {{-- More Images Button --}}
                    @if ($hasMoreThanFour)
                        <a href="{{ route('room.gallery', $room->room_id) }}"
                            class="relative group cursor-pointer h-48 bg-gray-900 flex items-center justify-center">
                            <div class="text-center text-white">
                                <i class="fa-regular fa-images text-3xl mb-2"></i>
                                <p class="font-bold text-lg">+{{ $room->galleries->count() - 4 }}</p>
                                <p class="text-sm">Foto Lainnya</p>
                            </div>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    @endif

    {{-- Main Content --}}
    <div class="bg-white py-8">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex lg:flex-row flex-col gap-8">
                {{-- Left: Room Details --}}
                <div class="lg:w-8/12 w-full">
                    {{-- Header Info --}}
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-6">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex-1">
                                @php
                                    $badgeColor = match ($room->type) {
                                        'putri' => 'bg-pink-100 text-pink-700',
                                        'putra' => 'bg-blue-100 text-blue-700',
                                        'campur' => 'bg-purple-100 text-purple-700',
                                        default => 'bg-gray-100 text-gray-700',
                                    };
                                @endphp
                                <span class="{{ $badgeColor }} px-4 py-1.5 rounded-full text-sm font-bold capitalize">
                                    <i class="fa-light fa-users mr-1"></i>Kos {{ $room->type }}
                                </span>
                                <h1 class="text-3xl font-bold text-gray-900 mt-4 mb-2">{{ $room->name }}</h1>
                                <p class="text-gray-600 flex items-center">
                                    <i class="fa-light fa-location-dot mr-2 text-red-500"></i>
                                    {{ $room->address }}
                                </p>
                            </div>

                            {{-- Favorite Button --}}
                            <div>
                                @if ($isFavorited)
                                    <form action="{{ route('favorite.delete', $favorite?->favorite_id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="room_id" value="{{ $room->room_id }}">
                                        <button type="submit"
                                            class="bg-red-50 text-red-600 px-6 py-3 font-semibold rounded-xl hover:bg-red-100 transition-all flex items-center gap-2 shadow-sm">
                                            <i class="fa-solid fa-heart text-lg"></i>
                                            <span class="hidden sm:inline">Tersimpan</span>
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('favorite.save') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="room_id" value="{{ $room->room_id }}">
                                        <button type="submit"
                                            class="bg-white border-2 border-gray-200 text-gray-700 px-6 py-3 font-semibold rounded-xl hover:border-primary hover:text-primary transition-all flex items-center gap-2 shadow-sm">
                                            <i class="fa-regular fa-heart text-lg"></i>
                                            <span class="hidden sm:inline">Simpan</span>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>

                        {{-- Quick Stats --}}
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-6 pt-6 border-t border-gray-100">
                            <div class="flex items-center gap-3">
                                <div class="bg-green-100 text-primary p-3 rounded-xl">
                                    <i class="fa-light fa-money-bill-wave text-xl"></i>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">Harga/Bulan</p>
                                    <p class="font-bold text-gray-900">Rp {{ number_format($room->price, 0, ',', '.') }}
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-center gap-3">
                                <div class="bg-blue-100 text-blue-700 p-3 rounded-xl">
                                    <i class="fa-light fa-door-open text-xl"></i>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">Kamar Tersedia</p>
                                    <p class="font-bold text-gray-900">{{ $room->quantity }} Kamar</p>
                                </div>
                            </div>

                            <div class="flex items-center gap-3">
                                <div class="bg-orange-100 text-orange-700 p-3 rounded-xl">
                                    <i class="fa-light fa-wallet text-xl"></i>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">Deposit</p>
                                    <p class="font-bold text-gray-900">Rp
                                        {{ number_format($room->deposit_amount, 0, ',', '.') }}</p>
                                </div>
                            </div>

                            <div class="flex items-center gap-3">
                                <div class="bg-purple-100 text-purple-700 p-3 rounded-xl">
                                    <i class="fa-light fa-users text-xl"></i>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">Tipe Kos</p>
                                    <p class="font-bold text-gray-900 capitalize">{{ $room->type }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Description --}}
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-6">
                        <h2 class="text-xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                            <i class="fa-light fa-file-lines text-primary"></i>
                            Deskripsi Kamar
                        </h2>
                        <p class="text-gray-700 leading-relaxed">{{ $room->description }}</p>
                    </div>

                    {{-- Facilities --}}
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-6">
                        <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-2">
                            <i class="fa-light fa-star text-primary"></i>
                            Fasilitas
                        </h2>

                        <div class="space-y-6">
                            {{-- Room Facilities --}}
                            @if (!empty($room->room_facility))
                                <div>
                                    <h3 class="font-semibold text-gray-900 mb-3 flex items-center gap-2">
                                        <span class="bg-green-100 text-primary px-2 py-1 rounded text-xs">Kamar</span>
                                        Fasilitas Kamar
                                    </h3>
                                    <div class="grid md:grid-cols-2 gap-3">
                                        @foreach ($room->room_facility as $item)
                                            <div class="flex items-center gap-3 text-gray-700">
                                                <i class="fa-regular fa-circle-check text-primary"></i>
                                                <span class="text-sm">{{ $item }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            {{-- Public Facilities --}}
                            @if (!empty($room->public_facility))
                                <div class="pt-6 border-t border-gray-100">
                                    <h3 class="font-semibold text-gray-900 mb-3 flex items-center gap-2">
                                        <span class="bg-blue-100 text-blue-700 px-2 py-1 rounded text-xs">Umum</span>
                                        Fasilitas Umum
                                    </h3>
                                    <div class="grid md:grid-cols-2 gap-3">
                                        @foreach ($room->public_facility as $item)
                                            <div class="flex items-center gap-3 text-gray-700">
                                                <i class="fa-regular fa-circle-check text-blue-600"></i>
                                                <span class="text-sm">{{ $item }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Regulations --}}
                    @if (!empty($room->regulation))
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-6">
                            <h2 class="text-xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                                <i class="fa-light fa-shield-check text-primary"></i>
                                Peraturan Kos
                            </h2>
                            <div class="space-y-3">
                                @foreach ($room->regulation as $item)
                                    <div class="flex items-start gap-3 text-gray-700">
                                        <i class="fa-regular fa-octagon-exclamation text-orange-500 mt-1"></i>
                                        <span class="text-sm">{{ $item }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    {{-- Info Box --}}
                    <div class="bg-gradient-to-r from-green-50 to-blue-50 rounded-2xl p-6 border border-green-100">
                        <div class="flex items-start gap-4">
                            <div class="bg-white p-3 rounded-xl shadow-sm">
                                <i class="fa-light fa-circle-info text-primary text-2xl"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-900 mb-2">Informasi Penting</h3>
                                <ul class="space-y-2 text-sm text-gray-700">
                                    <li class="flex items-start gap-2">
                                        <i class="fa-regular fa-check text-primary mt-1"></i>
                                        <span>Deposit akan dikembalikan saat kontrak berakhir</span>
                                    </li>
                                    <li class="flex items-start gap-2">
                                        <i class="fa-regular fa-check text-primary mt-1"></i>
                                        <span>Pembayaran dapat dilakukan melalui platform</span>
                                    </li>
                                    <li class="flex items-start gap-2">
                                        <i class="fa-regular fa-check text-primary mt-1"></i>
                                        <span>Hubungi pemilik kos untuk survei lokasi</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Right: Booking Card --}}
                <div class="lg:w-4/12 w-full">
                    <div class="lg:sticky lg:top-24">
                        {{-- Error Message --}}
                        @if (session('error'))
                            <div class="mb-4 bg-red-50 border-l-4 border-red-500 p-4 rounded-lg">
                                <div class="flex items-start gap-3">
                                    <i class="fa-regular fa-circle-exclamation text-red-500 text-xl mt-0.5"></i>
                                    <div>
                                        <p class="font-bold text-red-800">Terjadi Kesalahan!</p>
                                        <p class="text-sm text-red-700">{{ session('error') }}</p>
                                    </div>
                                </div>
                            </div>
                        @endif

                        {{-- Booking Card --}}
                        <div class="bg-white rounded-2xl shadow-lg border-2 border-gray-100 overflow-hidden">
                            {{-- Price Header --}}
                            <div class="bg-gradient-to-r from-primary to-green-600 p-6 text-white">
                                <p class="text-sm opacity-90 mb-1">Mulai dari</p>
                                <h2 class="text-3xl font-bold mb-2">
                                    Rp {{ number_format($room->price, 0, ',', '.') }}
                                </h2>
                                <p class="text-sm opacity-90">per bulan</p>
                            </div>

                            <div class="p-6">
                                {{-- Deposit Info --}}
                                <div class="bg-orange-50 border border-orange-200 rounded-xl p-4 mb-6">
                                    <div class="flex items-start gap-3">
                                        <i class="fa-regular fa-wallet text-orange-600 text-xl mt-0.5"></i>
                                        <div class="flex-1">
                                            <p class="font-semibold text-orange-900 mb-1">Deposit yang Diperlukan</p>
                                            <p class="text-2xl font-bold text-orange-600">
                                                Rp {{ number_format($room->deposit_amount, 0, ',', '.') }}
                                            </p>
                                            <p class="text-xs text-orange-700 mt-2">
                                                <i class="fa-regular fa-info-circle mr-1"></i>
                                                Deposit adalah uang jaminan yang dikembalikan saat kontrak berakhir
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                {{-- Booking Form --}}
                                <form action="{{ route('user.contract.store') }}" method="POST" class="space-y-4">
                                    @csrf
                                    <input type="hidden" name="room_id" value="{{ $room->room_id }}">
                                    <input type="hidden" name="owner_id" value="{{ $room->owner_id }}">
                                    <input type="hidden" name="deposit_amount" value="{{ $room->deposit_amount }}">

                                    <div>
                                        <label for="start_date"
                                            class="block text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                                            <i class="fa-regular fa-calendar text-primary"></i>
                                            Tanggal Mulai Sewa
                                        </label>
                                        <input type="date" id="start_date" name="start_date" required
                                            min="{{ date('Y-m-d') }}"
                                            class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all">
                                    </div>

                                    {{-- Summary --}}
                                    <div class="bg-gray-50 rounded-xl p-4 space-y-2">
                                        <div class="flex justify-between text-sm">
                                            <span class="text-gray-600">Harga Sewa</span>
                                            <span class="font-semibold">Rp
                                                {{ number_format($room->price, 0, ',', '.') }}</span>
                                        </div>
                                        <div class="flex justify-between text-sm">
                                            <span class="text-gray-600">Deposit</span>
                                            <span class="font-semibold">Rp
                                                {{ number_format($room->deposit_amount, 0, ',', '.') }}</span>
                                        </div>
                                        <div class="border-t border-gray-200 pt-2 mt-2">
                                            <div class="flex justify-between">
                                                <span class="font-bold text-gray-900">Total Bayar Pertama</span>
                                                <span class="font-bold text-primary text-lg">Rp
                                                    {{ number_format($room->price + $room->deposit_amount, 0, ',', '.') }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <button type="submit"
                                        class="w-full bg-primary hover:bg-green-700 text-white font-bold py-4 px-6 rounded-xl transition-all transform hover:scale-[1.02] active:scale-[0.98] shadow-lg flex items-center justify-center gap-2">
                                        <i class="fa-regular fa-paper-plane"></i>
                                        Ajukan Sewa Sekarang
                                    </button>
                                </form>

                                {{-- Additional Info --}}
                                <div class="mt-6 pt-6 border-t border-gray-100 space-y-3 text-sm text-gray-600">
                                    <div class="flex items-start gap-2">
                                        <i class="fa-regular fa-shield-check text-primary mt-0.5"></i>
                                        <span>Transaksi aman dan terpercaya</span>
                                    </div>
                                    <div class="flex items-start gap-2">
                                        <i class="fa-regular fa-headset text-primary mt-0.5"></i>
                                        <span>Customer support 24/7</span>
                                    </div>
                                    <div class="flex items-start gap-2">
                                        <i class="fa-regular fa-clock text-primary mt-0.5"></i>
                                        <span>Proses persetujuan cepat</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Contact Owner --}}
                        <div class="bg-white rounded-2xl shadow-md border border-gray-100 p-6 mt-6">
                            <h3 class="font-bold text-gray-900 mb-4">Ada Pertanyaan?</h3>
                            <p class="text-sm text-gray-600 mb-4">Hubungi pemilik kos untuk informasi lebih lanjut atau
                                survei lokasi</p>
                            <a href="#"
                                class="w-full bg-white border-2 border-primary text-primary font-semibold py-3 px-6 rounded-xl hover:bg-green-50 transition-all flex items-center justify-center gap-2">
                                <i class="fa-brands fa-whatsapp text-xl"></i>
                                Hubungi Pemilik
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection