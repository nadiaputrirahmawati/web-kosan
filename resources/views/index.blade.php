@extends('layout.LandingPage')
@section('content')
    {{-- Hero Section --}}
    <section class="bg-gradient-to-br from-green-50 to-white py-16 lg:py-24">
        <div class="max-w-7xl mx-8">
            <div class="flex flex-col-reverse lg:flex-row items-center gap-12">
                {{-- Left: Text Content --}}
                <div class="w-full lg:w-1/2 text-center lg:text-left">
                    <div class="inline-block bg-green-100 text-green-700 px-4 py-2 rounded-full text-sm font-semibold mb-6">
                        🏠 Platform Kost Terpercaya #1 di Indonesia
                    </div>
                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-gray-900 mb-6 leading-tight">
                        Temukan <span class="text-primary">Kost Impian</span> Anda dengan Mudah
                    </h1>
                    <p class="text-lg text-gray-600 mb-8 leading-relaxed">
                        Platform terpercaya untuk mencari dan menyewakan kost. Tanpa perantara, proses cepat, pembayaran aman. 
                        Ribuan pilihan kost menunggu Anda!
                    </p>
                    <div class="flex flex-col sm:flex-row justify-center lg:justify-start gap-4 mb-8">
                        <a href="#rooms" class="bg-primary text-white px-8 py-4 rounded-xl font-semibold hover:bg-green-700 transition-all transform hover:scale-105 shadow-lg">
                            🔍 Cari Kost Sekarang
                        </a>
                        <a href="#" class="bg-white text-primary border-2 border-primary px-8 py-4 rounded-xl font-semibold hover:bg-green-50 transition-all">
                            💼 Daftarkan Kost Anda
                        </a>
                    </div>
                    {{-- Stats --}}
                    <div class="grid grid-cols-3 gap-6 pt-8 border-t border-gray-200">
                        <div>
                            <h3 class="text-3xl font-bold text-primary">1000+</h3>
                            <p class="text-sm text-gray-600">Kost Tersedia</p>
                        </div>
                        <div>
                            <h3 class="text-3xl font-bold text-primary">5000+</h3>
                            <p class="text-sm text-gray-600">Pengguna Aktif</p>
                        </div>
                        <div>
                            <h3 class="text-3xl font-bold text-primary">4.8★</h3>
                            <p class="text-sm text-gray-600">Rating Rata-rata</p>
                        </div>
                    </div>
                </div>

                {{-- Right: Image --}}
                <div class="w-full lg:w-1/2 flex justify-center">
                    <img src="{{ asset('img/bg-1.png') }}" alt="Aplikasi Kost" class="max-w-full h-auto lg:max-w-lg drop-shadow-2xl">
                </div>
            </div>
        </div>
    </section>

    {{-- Features Section --}}
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl lg:text-4xl font-extrabold text-gray-900 mb-4">
                    Kenapa Harus Pilih Kami?
                </h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Platform terlengkap yang memudahkan pencari kost dan pemilik kost dalam satu tempat
                </p>
            </div>
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                {{-- Feature 1 --}}
                <div class="text-center p-6 rounded-xl hover:shadow-xl transition-all bg-gradient-to-br from-blue-50 to-white">
                    <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-3xl">🔒</span>
                    </div>
                    <h3 class="font-bold text-xl mb-3 text-gray-900">Pembayaran Aman</h3>
                    <p class="text-gray-600 text-sm">Sistem pembayaran terintegrasi dan terpercaya untuk keamanan transaksi Anda</p>
                </div>
                {{-- Feature 2 --}}
                <div class="text-center p-6 rounded-xl hover:shadow-xl transition-all bg-gradient-to-br from-green-50 to-white">
                    <div class="bg-green-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-3xl">⚡</span>
                    </div>
                    <h3 class="font-bold text-xl mb-3 text-gray-900">Proses Cepat</h3>
                    <p class="text-gray-600 text-sm">Booking dan pembayaran instan tanpa ribet, langsung deal!</p>
                </div>
                {{-- Feature 3 --}}
                <div class="text-center p-6 rounded-xl hover:shadow-xl transition-all bg-gradient-to-br from-purple-50 to-white">
                    <div class="bg-purple-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-3xl">✅</span>
                    </div>
                    <h3 class="font-bold text-xl mb-3 text-gray-900">Terverifikasi</h3>
                    <p class="text-gray-600 text-sm">Semua kost telah melalui proses verifikasi untuk kenyamanan Anda</p>
                </div>
                {{-- Feature 4 --}}
                <div class="text-center p-6 rounded-xl hover:shadow-xl transition-all bg-gradient-to-br from-yellow-50 to-white">
                    <div class="bg-yellow-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-3xl">💰</span>
                    </div>
                    <h3 class="font-bold text-xl mb-3 text-gray-900">Tanpa Biaya Tambahan</h3>
                    <p class="text-gray-600 text-sm">Tidak ada komisi tersembunyi, harga transparan dan jelas</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Rooms Section --}}
    <section id="rooms" class="py-16 px-4 bg-gradient-to-br from-gray-50 to-white">
        <div class="max-w-7xl mx-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl lg:text-4xl font-extrabold text-gray-900 mb-4">
                    Kost Populer di Sekitar Anda
                </h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Temukan kamar kost terbaik sesuai lokasi, harga, dan fasilitas favorit Anda
                </p>
            </div>
            <div class="grid lg:grid-cols-4 md:grid-cols-2 grid-cols-1 gap-6">
                @forelse ($room as $data)
                    <a href="{{ route('user.rooms.show', $data->room_id) }}" class="group">
                        <div class="bg-white rounded-2xl overflow-hidden shadow-md hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                            {{-- Image Container --}}
                            <div class="relative overflow-hidden h-48">
                                @if ($data->galleries->isNotEmpty())
                                    <img src="{{ asset('storage/' . $data->galleries->first()->image_url) }}"
                                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300"
                                        alt="Foto Kamar">
                                @else
                                    <img src="{{ asset('img/gambarkos.png') }}"
                                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300"
                                        alt="Foto Kamar">
                                @endif
                                {{-- Badge Overlay --}}
                                <div class="absolute top-3 left-3">
                                    @php
                                        $bgColor = match($data->type) {
                                            'putri' => 'bg-pink-500',
                                            'putra' => 'bg-blue-500',
                                            'campur' => 'bg-purple-500',
                                            default => 'bg-gray-500'
                                        };
                                    @endphp
                                    <span class="{{ $bgColor }} text-white px-3 py-1 rounded-full text-xs font-bold capitalize shadow-lg">
                                        {{ $data->type }}
                                    </span>
                                </div>
                                @if ($data->occupied_rooms <= 3)
                                    <div class="absolute top-3 right-3">
                                        <span class="bg-red-500 text-white px-3 py-1 rounded-full text-xs font-bold animate-pulse">
                                            🔥 Hampir Penuh
                                        </span>
                                    </div>
                                @endif
                            </div>

                            {{-- Content --}}
                            <div class="p-4">
                                <h3 class="font-bold text-lg text-gray-900 mb-2 line-clamp-1">
                                    {{ $data->name }}
                                </h3>
                                <p class="text-sm text-gray-600 mb-3 flex items-start gap-1">
                                    <span class="text-red-500 mt-0.5">📍</span>
                                    <span class="line-clamp-1">{{ $data->address }}</span>
                                </p>

                                {{-- Facilities --}}
                                @if (!empty($data->room_facility))
                                    <div class="flex flex-wrap gap-1 mb-3">
                                        @foreach (array_slice($data->room_facility, 0, 3) as $facility)
                                            <span class="bg-gray-100 text-gray-700 text-xs px-2 py-1 rounded">
                                                {{ $facility }}
                                            </span>
                                        @endforeach
                                        @if (count($data->room_facility) > 3)
                                            <span class="bg-gray-100 text-gray-700 text-xs px-2 py-1 rounded">
                                                +{{ count($data->room_facility) - 3 }}
                                            </span>
                                        @endif
                                    </div>
                                @endif

                                {{-- Footer --}}
                                <div class="flex items-center justify-between pt-3 border-t border-gray-100">
                                    <div>
                                        <p class="text-xs text-gray-500 mb-1">Mulai dari</p>
                                        <p class="text-primary font-bold text-xl">
                                            Rp {{ number_format($data->price, 0, ',', '.') }}
                                        </p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-xs text-gray-500">Tersisa</p>
                                        <p class="font-bold text-gray-900">
                                            {{ $data->occupied_rooms ?? $data->total_rooms }} kamar
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="col-span-full text-center py-12">
                        <div class="text-6xl mb-4">🏘️</div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Belum Ada Kost Tersedia</h3>
                        <p class="text-gray-600">Kost akan segera ditambahkan. Check kembali nanti!</p>
                    </div>
                @endforelse
            </div>

            {{-- View All Button --}}
            @if($room->isNotEmpty())
                <div class="text-center mt-12">
                    <a href="#" class="inline-block bg-white text-primary border-2 border-primary px-8 py-3 rounded-xl font-semibold hover:bg-primary hover:text-white transition-all">
                        Lihat Semua Kost →
                    </a>
                </div>
            @endif
        </div>
    </section>

    {{-- For Owners Section --}}
    <section class="py-16 bg-gradient-to-br from-primary to-green-600 text-white">
        <div class="max-w-7xl mx-8 px-4">
            <div class="flex flex-col lg:flex-row items-center gap-12">
                <div class="w-full lg:w-1/2">
                    <h2 class="text-3xl lg:text-4xl font-extrabold mb-6">
                        Punya Kost? Kelola dengan Mudah!
                    </h2>
                    <p class="text-lg mb-8 text-green-50">
                        Bergabunglah dengan ribuan pemilik kost yang sudah mempercayai platform kami. 
                        Sistem manajemen lengkap, otomatis, dan menguntungkan.
                    </p>
                    <ul class="space-y-4 mb-8">
                        <li class="flex items-start gap-3">
                            <span class="bg-white text-primary rounded-full w-6 h-6 flex items-center justify-center font-bold flex-shrink-0 mt-1">✓</span>
                            <span class="text-green-50">Dashboard lengkap untuk kelola semua kost Anda</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="bg-white text-primary rounded-full w-6 h-6 flex items-center justify-center font-bold flex-shrink-0 mt-1">✓</span>
                            <span class="text-green-50">Sistem pembayaran otomatis dan laporan real-time</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="bg-white text-primary rounded-full w-6 h-6 flex items-center justify-center font-bold flex-shrink-0 mt-1">✓</span>
                            <span class="text-green-50">Promosi gratis ke ribuan pencari kost</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="bg-white text-primary rounded-full w-6 h-6 flex items-center justify-center font-bold flex-shrink-0 mt-1">✓</span>
                            <span class="text-green-50">Dukungan pelanggan 24/7</span>
                        </li>
                    </ul>
                    <a href="#" class="inline-block bg-white text-primary px-8 py-4 rounded-xl font-bold hover:bg-gray-100 transition-all shadow-xl">
                        Daftar Sebagai Pemilik Kost
                    </a>
                </div>
                <div class="w-full lg:w-1/2">
                    <div class="bg-white rounded-2xl p-8 shadow-2xl">
                        <div class="text-center mb-6">
                            <div class="text-5xl mb-4">📊</div>
                            <h3 class="text-2xl font-bold text-gray-900">Keuntungan Bergabung</h3>
                        </div>
                        <div class="space-y-4">
                            <div class="flex items-center justify-between p-4 bg-green-50 rounded-xl">
                                <span class="text-gray-700 font-medium">Biaya Pendaftaran</span>
                                <span class="text-primary font-bold text-xl">GRATIS</span>
                            </div>
                            <div class="flex items-center justify-between p-4 bg-green-50 rounded-xl">
                                <span class="text-gray-700 font-medium">Biaya Bulanan</span>
                                <span class="text-primary font-bold text-xl">GRATIS</span>
                            </div>
                            <div class="flex items-center justify-between p-4 bg-green-50 rounded-xl">
                                <span class="text-gray-700 font-medium">Komisi per Transaksi</span>
                                <span class="text-primary font-bold text-xl">5%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Testimonials Section --}}
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl lg:text-4xl font-extrabold text-gray-900 mb-4">
                    Apa Kata Pengguna Kami?
                </h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Ribuan pengguna telah menemukan kost impian mereka
                </p>
            </div>
            <div class="grid md:grid-cols-3 gap-8">
                {{-- Testimonial 1 --}}
                <div class="bg-gradient-to-br from-green-50 to-white p-6 rounded-2xl shadow-md hover:shadow-xl transition-all">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-primary rounded-full flex items-center justify-center text-white font-bold text-xl">
                            A
                        </div>
                        <div class="ml-3">
                            <h4 class="font-bold text-gray-900">Andi Pratama</h4>
                            <p class="text-sm text-gray-600">Mahasiswa</p>
                        </div>
                    </div>
                    <div class="text-yellow-400 mb-3">★★★★★</div>
                    <p class="text-gray-700 italic">
                        "Sangat membantu! Dalam 1 hari langsung dapat kost yang cocok. Prosesnya cepat dan aman."
                    </p>
                </div>
                {{-- Testimonial 2 --}}
                <div class="bg-gradient-to-br from-blue-50 to-white p-6 rounded-2xl shadow-md hover:shadow-xl transition-all">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-blue-500 rounded-full flex items-center justify-center text-white font-bold text-xl">
                            S
                        </div>
                        <div class="ml-3">
                            <h4 class="font-bold text-gray-900">Siti Nurhaliza</h4>
                            <p class="text-sm text-gray-600">Pemilik Kost</p>
                        </div>
                    </div>
                    <div class="text-yellow-400 mb-3">★★★★★</div>
                    <p class="text-gray-700 italic">
                        "Sebagai pemilik kost, platform ini sangat memudahkan saya mengelola pembayaran dan penyewa."
                    </p>
                </div>
                {{-- Testimonial 3 --}}
                <div class="bg-gradient-to-br from-purple-50 to-white p-6 rounded-2xl shadow-md hover:shadow-xl transition-all">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-purple-500 rounded-full flex items-center justify-center text-white font-bold text-xl">
                            B
                        </div>
                        <div class="ml-3">
                            <h4 class="font-bold text-gray-900">Budi Santoso</h4>
                            <p class="text-sm text-gray-600">Karyawan</p>
                        </div>
                    </div>
                    <div class="text-yellow-400 mb-3">★★★★★</div>
                    <p class="text-gray-700 italic">
                        "Pilihan kostnya banyak dan terverifikasi. Tidak perlu khawatir dengan penipuan lagi!"
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- CTA Section --}}
    <section class="py-16 bg-gradient-to-r from-primary to-green-600">
        <div class="max-w-4xl mx-auto px-4 text-center text-white">
            <h2 class="text-3xl lg:text-4xl font-extrabold mb-6">
                Siap Menemukan Kost Impian Anda?
            </h2>
            <p class="text-lg text-green-50 mb-8 max-w-2xl mx-auto">
                Bergabunglah dengan ribuan pengguna yang sudah menemukan tempat tinggal ideal mereka. 
                Daftar sekarang, gratis!
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="#" class="bg-white text-primary px-8 py-4 rounded-xl font-bold hover:bg-gray-100 transition-all shadow-xl">
                    Mulai Cari Kost
                </a>
                <a href="#" class="bg-transparent border-2 border-white text-white px-8 py-4 rounded-xl font-bold hover:bg-white hover:text-primary transition-all">
                    Daftarkan Kost Anda
                </a>
            </div>
        </div>
    </section>
@endsection