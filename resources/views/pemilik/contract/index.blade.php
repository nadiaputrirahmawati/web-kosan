@extends('layout.pemilik')

@section('content')
    <div class="flex justify-between">
        <h1 class="text-primary font-extrabold text-xl mb-2">Pengajuan Sewa Kamar</h1>
    </div>

    

    @forelse ($contracts as $data)
        <div class="bg-white shadow-sm rounded-xl p-3 mt-2">
            <div class="flex justify-between w-full">
                <div class="flex space-x-3">
                    <div>
                    @forelse ($data->room->galleries as $gallery)
                        <img src="{{ asset('storage/' . $gallery->first()->image_url) }}" alt="foto kamar"
                            class="w-full h-24 object-cover rounded">
                    @empty
                        <span class="col-span-3 text-xs text-gray-400">Belum ada foto</span>
                    @endforelse
                    </div>

                    <div class="">
                        <h1 class="font-bold">{{ $data->room->name }}</h1>
                        <h1 class="capitalize text-sm font-semibold mt-2"><i class="fa-light fa-users mr-1"></i>
                            {{ $data->user->name }}</h1>
                        <h1 class="capitalize text-sm font-semibold mt-1"><i class="fa-light fa-location-dot"></i>
                            {{ $data->user->address }}</h1>

                    </div>
                </div>
                <div class="mt-4">
                    <a href="/owner/room/contract/{{ $data->user->user_id }}/show"
                        class="bg-black px-3 font-bold rounded-lg py-2 text-white text-sm">
                        Verifikasi Permintaan Sewa
                    </a>
                </div>
            </div>
            {{-- <hr class="border border-gray-100"> --}}
            <div class="flex space-x-3 justify-between mt-3 ">
                <div class="flex">
                    <div class="flex">
                        <div>
                            <i
                                class="fa-light fa-money-bill-wave mr-2 bg-base text-primary lg:px-3 lg:py-2 px-3 py-2 rounded-lg lg:text-sm text-xs"></i>
                        </div>
                        <div>
                            <h1 class="font-bold text-xs">Rp. {{ number_format($data->room->price, 0, ',', '.') }}</h1>
                            <h1 class="text-[11px]">Harga Kamar</h1>
                        </div>
                    </div>
                </div>
                <div class="flex">
                    <div class="flex">
                        <div>
                            <i
                                class="fa-light fa-door-open mr-2 bg-blue-100 text-blue-900 lg:px-3 lg:py-2 px-3 py-2 rounded-lg lg:text-sm text-xs"></i>
                        </div>
                        <div>
                            <h1 class="font-bold text-xs capitalize">{{ $data->start_date }}</h1>
                            <h1 class="text-[11px] font-semibold text-black">Tanggal Masuk</h1>
                        </div>
                    </div>
                </div>
                <div class="flex">
                    <div class="flex">
                        <div>
                            <i
                                class="fa-light fa-door-open mr-2 bg-blue-100 text-blue-900 lg:px-3 lg:py-2 px-3 py-2 rounded-lg lg:text-sm text-xs"></i>
                        </div>
                        <div>
                            <h1 class="font-bold text-xs capitalize">{{ $data->end_date }}</h1>
                            <h1 class="text-[11px] font-semibold text-black">Tanggal Keluar</h1>
                        </div>
                    </div>
                </div>
                <div class="flex">
                    <div class="flex">
                        <div>
                            <i
                                class="fa-light fa-door-open mr-2 bg-blue-100 text-blue-900 lg:px-3 lg:py-2 px-3 py-2 rounded-lg lg:text-sm text-xs"></i>
                        </div>
                        <div>
                            <h1 class="font-bold text-xs capitalize">{{ $data->verification_contract }}</h1>
                            <h1 class="text-[11px] font-semibold text-black">Status</h1>
                        </div>
                    </div>
                </div>
                <div class="flex">
                    <div class="flex">
                        <div>
                            <i
                                class="fa-light fa-wallet mr-2 bg-orange-50 text-orange-900 lg:px-3 lg:py-2 px-3 py-2 rounded-lg lg:text-sm text-xs"></i>
                        </div>
                        @php
                            $jumlah = $data->deposit_amount + $data->room->price;
                        @endphp
                        <div>
                            <h1 class="font-bold text-xs">Rp. {{ number_format($jumlah, 0, ',', '.') }}</h1>
                            <h1 class="text-[11px] font-semibold text-black">Jumlah Payment</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="flex justify-center mt-10">
            <h1 class="font-bold">Tidak ada data Kamar</h1>
        </div>
    @endforelse
@endsection
