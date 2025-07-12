@extends('layout.pemilik')

@section('content')
    <div class="flex justify-between">
        <h1 class="text-primary font-extrabold text-xl mb-2">Kamar Kosan</h1>
        <div class="flex justify-end">
            <a href="/owner/room/create"
                class="bg-primary lg:px-9 px-2 font-bold rounded-lg py-2 text-white text-sm hover:bg-primary/90 transition">Tambah
                Kamar
                <i class="fa-light fa-house-window ml-3"></i></a>
        </div>
    </div>

    @forelse ($Room as $data)
        <div class="bg-white shadow-sm rounded-xl p-3 mt-2">
            <div class="flex justify-between w-full">
                <div class="flex space-x-3">
                    @if ($data->galleries->isNotEmpty())
                        <img src="{{ asset('storage/' . $data->galleries->first()->image_url) }}"
                            class="w-20 object-cover rounded" alt="Foto Kamar">
                    @else
                        <p class="text-sm text-gray-400 italic">Belum ada foto kamar</p>
                    @endif
                    <div class="">
                        <h1 class="font-bold">{{ $data->name }}</h1>
                        <h1 class="capitalize text-xs font-semibold"><i class="fa-light fa-users mr-1"></i>
                            {{ $data->type }}</h1>

                    </div>
                </div>
                <div class="mt-4">
                    <a href="/owner/room/{{ $data->room_id }}/show"
                        class="bg-black px-3 font-bold rounded-lg py-2 text-white text-sm">
                        Manage
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
                            <h1 class="font-bold text-xs">Rp. {{ number_format($data->price, 0, ',', '.') }}</h1>
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
                            <h1 class="font-bold text-xs">{{ $data->quantity }}</h1>
                            <h1 class="text-[11px] font-semibold text-black">Kamar Tersedia</h1>
                        </div>
                    </div>
                </div>
                <div class="flex">
                    <div class="flex">
                        <div>
                            <i
                                class="fa-light fa-wallet mr-2 bg-orange-50 text-orange-900 lg:px-3 lg:py-2 px-3 py-2 rounded-lg lg:text-sm text-xs"></i>
                        </div>
                        <div>
                            <h1 class="font-bold text-xs">Rp. {{ number_format($data->deposit_amount, 0, ',', '.') }}</h1>
                            <h1 class="text-[11px] font-semibold text-black">Deposito</h1>
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
