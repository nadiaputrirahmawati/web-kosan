@extends('layout.pemilik')

@section('content')
    @php
        // Convert tanggal ke Carbon
        use Carbon\Carbon;
    @endphp
    <div class="flex justify-between">
        <h1 class="text-primary font-extrabold text-xl mb-2">Pengajuan Sewa Kamar</h1>
    </div>
    @forelse ($contracts as $data)
        @php
            $today = Carbon::today();
            $end = Carbon::parse($data->end_date);
            $daysLeft = $end->diffInDays($today, false); // bisa negatif jika lewat
        @endphp
        <div class="bg-white shadow-sm rounded-xl p-3 mt-2">
            <div class="flex justify-between w-full">
                <div class="flex space-x-3">
                    <div>
                        @if ($data->room->galleries->isNotEmpty())
                            <img src="{{ asset('storage/' . $data->room->galleries->first()->image_url) }}" alt="foto kamar"
                                class="w-full h-24 object-cover rounded">
                        @else
                            <span class="col-span-3 text-xs text-gray-400">Belum ada foto</span>
                        @endif
                    </div>

                    <div class="">
                        <h1 class="font-bold">{{ $data->room->name }}</h1>
                        <h1 class="capitalize text-sm font-semibold mt-2"><i class="fa-light fa-users mr-1"></i>
                            {{ $data->user->name }}</h1>
                        <h1 class="capitalize text-sm font-semibold mt-1"><i class="fa-light fa-location-dot"></i>
                            {{ $data->user->address }}</h1>
                        @if ($data->status === 'in_renewal')
                            <h1 class="text-sm mt-2 text-blue-500">
                                <i class="fa-regular fa-check-circle mr-1"></i>
                                <strong>Sudah Diperpanjang</strong>
                            </h1>
                        @endif
                    </div>
                </div>
                @if ($data->verification_contract === 'pending')
                    <div class="mt-4">
                        <a href="/owner/room/contract/{{ $data->user->user_id }}/show"
                            class="bg-primary px-3 font-bold rounded-lg py-2 text-white text-xs">
                            Verifikasi Permintaan Sewa
                        </a>
                    </div>
                @else
                    <div class="mt-4">
                        <a href="/owner/room/contract/{{ $data->user->user_id }}/sewa"
                            class="bg-primary px-3 font-bold rounded-lg py-2 text-white text-sm">
                            Detail Sewa
                        </a>
                    </div>
                @endif
            </div>
            @if ($daysLeft <= 7 && $data->status === 'active')
                <div class="bg-yellow-100 text-yellow-800 p-2 rounded mb-2 mt-4">
                    ⚠️ Masa sewa hampir habis dalam {{ $daysLeft }} hari ({{ $data->end_date }})
                </div>
            @endif

        </div>
    @empty
        <div class="flex justify-center mt-10">
            <h1 class="font-bold">Tidak ada data Kamar</h1>
        </div>
    @endforelse
@endsection
