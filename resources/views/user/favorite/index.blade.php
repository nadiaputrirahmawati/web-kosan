@extends('layout.Penghuni')

@section('content')
    <div>
        <h1 class="text-primary font-extrabold text-xl mb-4">Kamar Kos Tersimpan</h1>
        @forelse ($favorite as $data)
            @if ($data->room)
                <a href="{{ route('user.rooms.show', $data->room->room_id) }}">
                    <div class="bg-white shadow-sm rounded-xl p-3 mt-2">
                        <div class="flex justify-between w-full">
                            <div class="flex space-x-3">
                                @if ($data->room->galleries->isNotEmpty())
                                    <img src="{{ asset('storage/' . $data->room->galleries->first()->image_url) }}"
                                        class="w-20 object-cover rounded" alt="Foto Kamar">
                                @else
                                    <p class="text-sm text-gray-400 italic">Belum ada foto kamar</p>
                                @endif
                                <div class="">
                                    <h1 class="font-bold">{{ $data->room->name }}</h1>
                                    <h1 class="capitalize text-xs font-semibold"><i class="fa-light fa-users mr-1"></i>
                                        Kos {{ $data->room->type }}</h1>

                                </div>
                            </div>
                            <div class="mt-4">
                                <form action="{{ route('favorite.delete', $data->favorite_id) }}" method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus dari favorit?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-500 hover:bg-red-600 px-3 font-bold rounded-lg py-2 text-white text-sm">
                                        Hapus
                                    </button>
                                </form>
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
                                        <h1 class="font-bold text-xs">Rp.
                                            {{ number_format($data->room->price, 0, ',', '.') }}
                                        </h1>
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
                                        <h1 class="font-bold text-xs">
                                            {{ $data->room->occupied_rooms ?? $data->room->total_rooms }} </h1>
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
                                        <h1 class="font-bold text-xs">Rp.
                                            {{ number_format($data->room->deposit_amount, 0, ',', '.') }}</h1>
                                        <h1 class="text-[11px] font-semibold text-black">Deposito</h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            @else
                <p class="text-red-500">Kost sudah tidak tersedia.</p>
            @endif
        @empty
            <p class="text-center font-bold">Tidak ada kost favorite</p>
        @endforelse
    </div>
@endsection
