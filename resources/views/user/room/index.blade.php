@extends('layout.Penghuni')

@section('content')
    <h1 class="text-primary font-extrabold text-xl mb-4">Kost Saya</h1>
    @forelse ($room as $data)
        @if ($data->status == 'completed' && optional($data->payment)->status == 'completed')
            <div class="bg-white shadow rounded-xl p-3 mt-2">
                {{-- Header --}}
                <div class="flex justify-between mt-2 mb-4">
                    <div>
                        <h1 class="text-sm font-semibold">
                            <i class="fa-light fa-calendar mr-2"></i>
                            {{ \Carbon\Carbon::parse($data->created_at)->translatedFormat('d F Y H:i') }}
                        </h1>
                    </div>
                    <div>
                        <a href="{{ route('user.room.show', $data->contract_id) }}"
                            class="text-sm font-semibold text-primary bg-base py-2 px-3 border border-primary rounded-lg">
                            Detail Kost</a>
                    </div>
                </div>

                <hr class="mb-3">

                {{-- Isi --}}
                <div class="flex justify-between w-full">
                    <div class="flex space-x-3">
                        <div>
                            @if ($data->room->galleries->isNotEmpty())
                                <img src="{{ asset('storage/' . $data->room->galleries->first()->image_url) }}"
                                    alt="foto kamar" class="w-full h-24 object-cover rounded">
                            @else
                                <span class="text-xs text-gray-400">Belum ada foto</span>
                            @endif
                        </div>

                        <div class="mt-2">
                            <h1 class="font-bold">{{ $data->room->name }}</h1>
                            <h1 class="capitalize text-sm mt-2">
                                <i class="fa-regular fa-calendar-day mr-1"></i>
                                Tanggal Mulai : <strong>{{ $data->start_date }}</strong>
                            </h1>
                            <h1 class="capitalize text-sm mt-2">
                                <i class="fa-regular fa-calendar-check mr-1"></i>
                                Tanggal Berakhir : <strong>{{ $data->end_date }}</strong>
                            </h1>
                        </div>
                    </div>

                    <div>
                        <div class="text-center">
                            <div class="flex justify-center">
                                {!! QrCode::size(100)->generate(route('user.contract.checkin', $data->contract_id)) !!}
                            </div>
                            <p class="text-xs text-gray-500 mt-2">
                                Scan QR ini untuk melakukan <br> check-in ke kamar kost.
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Tombol Aksi --}}
                @php
                    $sisaHari = now()->diffInDays(\Carbon\Carbon::parse($data->end_date), false);
                    $hasExtended = \App\Models\Contract::where('user_id', $data->user_id)
                        ->where('room_id', $data->room_id)
                        ->where('start_date', '>', $data->end_date)
                        ->where('status', 'active')
                        ->exists();
                @endphp

                @if ($sisaHari <= 7 && !$hasExtended)
                    <div class="flex mt-6 text-center space-x-3 w-full">
                        <div class="w-8/12 bg-red-50 border border-red-400 px-3 py-2 rounded-lg">
                            <p class="text-sm text-gray-500">
                                Kontrak Anda akan berakhir pada
                                <strong>{{ \Carbon\Carbon::parse($data->end_date)->translatedFormat('d F Y') }}</strong>.
                            </p>
                        </div>
                        <div class="w-4/12">
                            <form action="{{ route('user.contract.newcontract', $data->contract_id) }}" method="POST">
                                @csrf
                                <button type="submit" class="bg-primary hover:font-bold text-white px-4 py-2 rounded-md">
                                    Perpanjang Kontrak
                                </button>
                            </form>
                        </div>
                    </div>
                @endif
            </div>
        @endif
    @empty
        <div class="flex justify-center mt-10">
            <h1 class="font-bold">Tidak ada data Kamar</h1>
        </div>
    @endforelse
@endsection
