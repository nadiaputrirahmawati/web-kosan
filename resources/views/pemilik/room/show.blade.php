@extends('layout.pemilik')

@section('content')

    <div class="flex lg:flex-row flex-col justify-between">
        <div>
            <h1 class="text-sm font-medium"><a href="/owner/room">Kamar /</a> <span class="font-bold"> Detail Kamar</span></h1>
            <h1 class="text-primary font-extrabold text-xl mb-4">Detail Kamar Kos</h1>
        </div>
        <div class="flex lg:space-x-3 space-x-2 mt-3">
            <div class="mt-2">
                <a href="{{ route('rooms.update', $room->room_id) }}"
                    class="bg-primary lg:px-5 px-3 font-bold rounded-lg py-2 text-white text-sm hover:bg-primary/90 transition inline-flex items-center space-x-2">
                    <i class="fas fa-edit"></i>
                    <span class="hidden lg:inline">Edit Kamar</span>
                </a>
            </div>

            <div class="mt-2">
                <a href="{{ route('rooms.gallery', $room->room_id) }}"
                    class="bg-base lg:px-5 px-3 font-bold rounded-lg py-2 text-primary border border-primary text-sm hover:bg-primary/90 hover:text-white transition inline-flex items-center space-x-2">
                    <i class="fas fa-image"></i>
                    <span class="hidden lg:inline">Edit Gambar</span>
                </a>
            </div>

            <div class="mt-2">
                <form action="{{ route('rooms.destroy', $room->room_id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="bg-red-500 lg:px-5 px-3 font-bold rounded-lg py-2 text-white text-sm hover:bg-red-600 transition inline-flex items-center space-x-2">
                        <i class="fas fa-trash-alt"></i>
                        <span class="hidden lg:inline">Hapus Kamar</span>
                    </button>
                </form>
            </div>
        </div>

    </div>
    <div class="flex lg:flex-row flex-col mt-4 lg:space-x-3 space-x-0 w-full">
        <div class="bg-white shadow-sm rounded-xl p-6 lg:w-7/12 w-full">
            <h1 class="text-sm font-semibold text-gray-800 mt-2"> Nama Kamar</h1>
            <h1 class="text-2xl font-bold mt-1">{{ $room->name }}</h1>
            <h1 class="text-sm"><i class="fa-light fa-location-dot mr-1 ml-2 mt-1"></i> {{ $room->address }} </h1>
            <div class="mt-3">
                @if ($room->galleries->isNotEmpty())
                    <div class="flex space-x-4">
                        <div class="grid grid-cols-3 gap-2">
                            @forelse ($room->galleries as $gallery)
                                <img src="{{ asset('storage/' . $gallery->image_url) }}" class="w-36 object-cover rounded"
                                    alt="Foto Kamar">
                            @empty
                                <a href="/owner/room/{{ $room->room_id }}/gallery"
                                    class="bg-primary lg:px-5 px-2 font-bold rounded-lg py-2 text-white text-sm hover:bg-primary/90 transition">Tambah
                                    Foto Kamar <i class="fa-light fa-camera-retro ml-2"></i></a>
                            @endforelse
                        </div>

                    </div>
                @else
                    <a href="/owner/room/{{ $room->room_id }}/gallery"
                        class="bg-primary lg:px-5 px-2 font-bold rounded-lg py-2 text-white text-sm hover:bg-primary/90 transition">Tambah
                        Foto Kamar <i class="fa-light fa-camera-retro ml-2"></i></a>
                @endif
            </div>
            <h1 class="text-lg font-bold text-gray-800 mt-4">
                - Aturan Kos</h1>
            @if (!empty($room->regulation))
                <div class="mb-4 mt-2">
                    <ul class="list-disc list-inside text-gray-700">
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($room->regulation as $item)
                            <h1 class="text-sm font-medium text-black"><i
                                    class="fa-light fa-circle-{{ $i++ }} clear-start mr-2"></i>{{ $item }}
                            </h1>
                        @endforeach
                    </ul>
                </div>
            @endif
            <h1 class="text-lg font-bold text-gray-800 mt-4">
                - Fasilitas Umum</h1>
            @if (!empty($room->public_facility))
                <div class="mb-4 mt-2">
                    <ul class="list-disc list-inside text-gray-700">
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($room->public_facility as $item)
                            <h1 class="text-sm font-medium text-black"><i
                                    class="fa-light fa-circle-{{ $i++ }} clear-start mr-2"></i>{{ $item }}
                            </h1>
                        @endforeach
                    </ul>
                </div>
            @endif
            <h1 class="text-lg font-bold text-gray-800 mt-4">
                - Fasilitas Kamar</h1>
            @if (!empty($room->room_facility))
                <div class="mb-4 mt-2">
                    <ul class="list-disc list-inside text-gray-700">
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($room->room_facility as $item)
                            <h1 class="text-sm font-medium text-black"><i
                                    class="fa-light fa-circle-{{ $i++ }} clear-start mr-2"></i>{{ $item }}
                            </h1>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        <div class="bg-white shadow-sm rounded-xl p-5 lg:w-5/12 w-full lg:mt-0 mt-3">
            <h1
                class="text-sm font-semibold text-gray-800 mt-2 bg-orange-50 border-orange-400 border px-3 py-1 text-center rounded-lg">
                Informasi Kamar </h1>

            <div class="flex flex-col justify-between mt-3">
                <div class="flex mt-2">
                    <div>
                        <i
                            class="fa-light fa-users mr-2 bg-base text-primary lg:px-3 lg:py-2 px-3 py-2 rounded-lg lg:text-sm text-xs"></i>
                    </div>
                    <div>
                        <h1 class="font-bold text-xs capitalize">{{ $room->type }}</h1>
                        <h1 class="text-[11px]">Type Kamar</h1>
                    </div>
                </div>
                <div class="flex mt-2">
                    <div>
                        <i
                            class="fa-light fa-money-bill-wave mr-2 bg-base text-primary lg:px-3 lg:py-2 px-3 py-2 rounded-lg lg:text-sm text-xs"></i>
                    </div>
                    <div>
                        <h1 class="font-bold text-xs">Rp. {{ number_format($room->price, 0, ',', '.') }}</h1>
                        <h1 class="text-[11px]">Harga Kamar</h1>
                    </div>
                </div>
                <div class="flex mt-2">
                    <div>
                        <i
                            class="fa-light fa-door-open mr-2 bg-blue-100 text-blue-900 lg:px-3 lg:py-2 px-3 py-2 rounded-lg lg:text-sm text-xs"></i>
                    </div>
                    <div>
                        <h1 class="font-bold text-xs">{{ $room->quantity }}</h1>
                        <h1 class="text-[11px] font-semibold text-black">Kamar Tersedia</h1>
                    </div>
                </div>
                <div class="flex mt-2">
                    <div>
                        <i
                            class="fa-light fa-wallet mr-2 bg-orange-50 text-orange-900 lg:px-3 lg:py-2 px-3 py-2 rounded-lg lg:text-sm text-xs"></i>
                    </div>
                    <div>
                        <h1 class="font-bold text-xs">Rp. {{ number_format($room->deposit_amount, 0, ',', '.') }}</h1>
                        <h1 class="text-[11px] font-semibold text-black">Deposito</h1>
                    </div>
                </div>
            </div>
            <h1 class="mt-2 font-bold text-lg"> Deksripsi Kamar</h1>
            <p> {{ $room->description }}</p>
        </div>
    </div>

@endsection
