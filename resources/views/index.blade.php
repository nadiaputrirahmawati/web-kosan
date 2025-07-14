@extends('layout.landingpage')
@section('title', 'Home')
@section('content')
    <section class="bg-white py-20">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h1 class="text-4xl sm:text-5xl font-extrabold text-gray-800 mb-4">Manage Finance More Easily</h1>
            <p class="text-lg text-gray-600 mb-6">Help you fulfill all aspirations in life. One platform to manage your
                finance easily.</p>
            <div class="flex justify-center space-x-4">
                <a href="#"
                    class="bg-green-600 text-white px-6 py-3 rounded-md font-medium hover:bg-green-700 transition">Download
                    Now</a>
                <a href="#" class="text-green-600 font-medium hover:underline">See how it works</a>
            </div>
        </div>
    </section>

    <section class="py-16 p-3 bg-white">
        <div class="w-full grid grid-cols-3 gap-4">
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
                            <h1
                                class="bg-base border-2 text-primary border-primary px-3 font-bold rounded-lg py-1  text-sm mt-2 capitalize">
                                {{ $data->type }}</h1>
                            <h1 class="italic text-xs font-medium mt-2 text-red-500"> Sisa {{ $data->quantity }} Kamar</h1>
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
