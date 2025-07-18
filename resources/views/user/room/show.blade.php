@extends('layout.Penghuni')
@section('content')
    <div class="flex justify-between">
        <div>
            <h1 class="text-sm font-medium text-primary"><a href="/owner/room">Kamar /</a> <span class="font-bold">Detail Kamar</span></h1>
            <h1 class="text-primary font-extrabold text-xl mb-4">Detail Kamar Kos</h1>
        </div>
        <div class="flex space-x-3 mt-3 mb-4">
            @if ($room->payment->status === 'completed')
                <a href="{{ route('user.contract.download', $room->contract_id) }}"
                    class="bg-red-400 lg:px-3 px-2 font-bold rounded-full py-2  text-white text-sm">
                    Download Surat Kontrak Sewa
                </a>
            @else
                <h1></h1>
            @endif

        </div>
    </div>

    <div class="w-full bg-white shadow-sm rounded-xl p-5">
        {{-- Info Kamar & Galeri --}}
        <h1 class="text-sm font-semibold text-gray-800 mt-2">Informasi Kamar Saya</h1>
        <div class="flex mt-2 justify-between w-full">
            <div class="w-8/12">
                <div class="grid grid-cols-4 gap-2">
                    @forelse ($room->room->galleries as $gallery)
                        <img src="{{ asset('storage/' . $gallery->image_url) }}" class="w-40 h-32 object-cover rounded"
                            alt="Foto Kamar">
                    @empty
                        <a href="/owner/room/{{ $room->room_id }}/gallery"
                            class="bg-primary lg:px-5 px-2 font-bold rounded-lg py-2 text-white text-sm hover:bg-primary/90 transition">
                            Tambah Foto Kamar <i class="fa-regular fa-camera-retro ml-2"></i>
                        </a>
                    @endforelse
                </div>
            </div>

            {{-- QR Code --}}
            @if ($room->payment->status === 'completed')
                <div class="text-center w-4/12">
                    <div class="flex justify-center">
                        {!! $qrCode !!}
                    </div>
                    <p class="text-xs text-gray-500 mt-2">
                        Scan QR ini untuk melakukan<br>check‑in ke kamar kost.
                    </p>
                </div>
            @else
                <div class="text-center w-4/12">
                    <p class="text-xs text-gray-500 mt-24">
                        Silahkan melakukan pembayaran untuk<br>melakukan check-in ke kamar kost.
                    </p>
                </div>
            @endif
        </div>
        <div class="flex flex-col justify-between mt-3 space-y-4">
            {{-- Status --}}
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-2">
                    <i class="fa-regular fa-layer-group bg-pink-200 text-pink-500 p-3 rounded-lg text-sm"></i>
                    <div>
                        <h1 class="font-bold text-xs">Status Kamar</h1>
                    </div>
                </div>
                <div>
                    <span class="text-xs font-bold mt-1 py-2 px-4 bg-pink-400 text-white rounded-full capitalize">
                        {{ $room->status }}
                    </span>
                </div>
            </div>

            {{-- Tanggal --}}
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-2">
                    <i class="fa-regular fa-calendar-day bg-base text-primary p-3 rounded-lg text-sm"></i>
                    <div>
                        <h1 class="font-bold text-xs">{{ $room->start_date }}</h1>
                        <h1 class="text-[11px] text-gray-600">Tanggal Dimulai Kost</h1>
                    </div>
                </div>
                <div class="flex items-center space-x-2">
                    <div class="text-right">
                        <h1 class="font-bold text-xs">{{ $room->end_date }}</h1>
                        <h1 class="text-[11px] text-gray-600">Tanggal Berakhir Kost</h1>
                    </div>
                    <i class="fa-regular fa-calendar-check bg-base text-primary p-3 rounded-lg text-sm"></i>
                </div>
            </div>

            {{-- Harga & Deposit --}}
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-2">
                    <i class="fa-regular fa-money-bill-trend-up bg-base text-primary p-3 rounded-lg text-sm"></i>
                    <div>
                        <h1 class="font-bold text-xs">Rp. {{ number_format($room->room->price, 0, ',', '.') }}</h1>
                        <h1 class="text-[11px] text-gray-600">Harga Kamar</h1>
                    </div>
                </div>
                <div class="flex items-center space-x-2">
                    <div class="text-right">
                        <h1 class="font-bold text-xs">Rp. {{ number_format($room->deposit_amount, 0, ',', '.') }}</h1>
                        <h1 class="text-[11px] text-gray-600">Deposito</h1>
                    </div>
                    <i class="fa-regular fa-wallet bg-orange-50 text-orange-900 p-3 rounded-lg text-sm"></i>
                </div>
            </div>
        </div>
        {{-- Deskripsi --}}
        <div class="mt-6">
            <h1 class="font-bold text-lg">Deskripsi Kamar</h1>
            <p>{{ $room->room->description }}</p>
        </div>

        {{-- Regulasi --}}
        @if (!empty($room->room->regulation))
            <div class="mt-6">
                <h2 class="font-bold text-lg mb-2">Aturan Kos</h2>
                <ul class="list-disc list-inside text-gray-700 space-y-1">
                    @php
                        $i = 1;
                    @endphp
                    @foreach ($room->room->regulation as $item)
                        <h1 class="text-sm"><i class="fa-solid fa-{{ $i++ }} mr-2"></i> {{ $item }}</h1>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Fasilitas --}}
        @if (!empty($room->room->room_facility))
            <div class="mt-6">
                <h2 class="font-bold text-lg mb-2">Fasilitas Kamar</h2>
                <ul class="list-disc list-inside text-gray-700 space-y-1">
                    @php
                        $a = 1;
                    @endphp
                    @foreach ($room->room->room_facility as $item)
                        <h1 class="text-sm"><i class="fa-solid fa-{{ $a++ }} mr-2"></i> {{ $item }}</h1>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (!empty($room->room->public_facility))
            <div class="mt-6">
                <h2 class="font-bold text-lg mb-2">Fasilitas Umum</h2>
                <ul class="list-disc list-inside text-gray-700 space-y-1">
                    @php
                        $b = 1;
                    @endphp
                    @foreach ($room->room->public_facility as $item)
                        <h1 class="text-sm"><i class="fa-solid fa-{{ $b++ }} mr-2"></i> {{ $item }}</h1>
                    @endforeach
                </ul>
            </div>
        @endif

    </div>
@endsection
