@extends('layout.LandingPage')
@section('content')
    <section class="bg-white py-4">
        <div class="max-w-7xl mx-auto px-4 flex flex-col-reverse lg:flex-row items-center">
            <!-- Kiri: Teks -->
            <div class="w-full lg:w-1/2 text-center lg:text-left mt-10 lg:mt-0">
                <h1
                    class="text-4xl sm:text-5xl font-extrabold text-gray-800 mb-4 tracking-wider lg:leading-tight leading-10">
                    Find Trusted Boarding Houses Easily
                </h1>
                <h1 class="text-2xl font-extrabold text-secondary mb-4 tracking-wide ">No agents, no hassle — just
                    kost.</h1>
                <p class="text-lg text-gray-600 mb-6">
                    Discover your ideal place to stay — safe, fast, and convenient. One platform to search and rent kost
                    with ease.
                </p>
                <div class="flex justify-center lg:justify-start space-x-4">
                    <a href="#"
                        class="bg-primary text-white px-6 py-3 rounded-xl font-medium hover:bg-green-700 transition">
                        Find a Kost Now
                    </a>
                </div>
            </div>

            <!-- Kanan: Gambar -->
            <div class="w-full lg:w-1/2 flex justify-center">
                <img src="{{ asset('img/bg-1.png') }}" alt="Aplikasi Kost" class="max-w-xs md:max-w-sm lg:max-w-md">
            </div>
        </div>
    </section>


    <section class="py-10 px-4">
        <div class="max-w-7xl mx-auto text-center mb-10">
            <h2 class="text-3xl font-extrabold text-gray-800">Yuk Cari Kost di Sekitarmu!</h2>
            <p class="text-gray-600 mt-2 text-sm">Temukan kamar kost terbaik sesuai lokasi, harga, dan fasilitas favoritmu.
            </p>
        </div>
        <div class="w-full grid lg:grid-cols-4 grid-cols-1 gap-4">
            @forelse ($room as $data)
                <a href="{{ route('user.rooms.show', $data->room_id) }}">
                    <div class="p-2 rounded-xl">
                        @if ($data->galleries->isNotEmpty())
                            <img src="{{ asset('storage/' . $data->galleries->first()->image_url) }}"
                                class="w-full object-cover rounded" alt="Foto Kamar">
                        @else
                            <img src="{{ asset('img/gambarkos.png') }}" class="w-full object-cover rounded" alt="">
                        @endif
                        <div class="flex space-x-3">
                            @php
                                // Tentukan warna background dan teks berdasarkan tipe
                                $bgColor = '';
                                $textColor = '';

                                if ($data->type === 'putri') {
                                    $bgColor = 'bg-pink-100';
                                    $textColor = 'text-pink-600';
                                } elseif ($data->type === 'putra') {
                                    $bgColor = 'bg-blue-100';
                                    $textColor = 'text-blue-600';
                                } elseif ($data->type === 'campur') {
                                    $bgColor = 'bg-yellow-100';
                                    $textColor = 'text-yellow-600';
                                } else {
                                    // fallback default
                                    $bgColor = 'bg-gray-100';
                                    $textColor = 'text-gray-600';
                                }
                            @endphp

                            <h1
                                class="{{ $bgColor }} {{ $textColor }} px-3 font-bold rounded-lg py-1 text-sm mt-2 capitalize">
                                {{ $data->type }}
                            </h1>
                            <h1 class="italic text-xs font-medium mt-2 text-red-500"> Sisa
                                {{ $data->occupied_rooms ?? $data->total_rooms }} Kamar</h1>
                        </div>
                        <div class="mt-2">
                            <h1>{{ Str::limit($data->name, 40) }}</h1>
                            <h1>{{ $data->address }}</h1>
                            @if (!empty($data->room_facility))
                                <div class="mb-2 mt-2">
                                    <p class="text-xs font-medium text-gray-500">
                                        {{ Str::limit(implode(', ', $data->room_facility), 40) }}
                                    </p>
                                </div>
                            @endif

                            <h1 class="font-bold">Rp. {{ number_format($data->price, 0, ',', '.') }}</h1>
                        </div>
                    </div>
                </a>

            @empty
            @endforelse
        </div>
    </section>
@endsection
