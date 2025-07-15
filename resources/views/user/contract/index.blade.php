@extends('layout.Penghuni')

@section('content')
    <h1 class="text-primary font-extrabold text-xl mb-4">Riwayat Pengajuan Sewa Kost</h1>
    @forelse ($contracts as $data)
        <div class="bg-white shadow-sm rounded-xl p-3 mt-2">
            <div class="flex justify-between mt-2 mb-4">
                <div>
                    <h1 class="text-sm font-semibold"><span><i
                                class="fa-light fa-calendar mr-2"></i></span>{{ \Carbon\Carbon::parse($data->created_at)->translatedFormat('d F Y H:i') }}
                    </h1>
                </div>
                <div>
                    @php
                        $status = $data->verification_contract;
                        $bgColor = 'bg-gray-50';
                        $textColor = 'text-gray-900';

                        if ($status === 'completed') {
                            $bgColor = 'bg-green-50';
                            $textColor = 'text-green-900';
                        } elseif ($status === 'pending') {
                            $bgColor = 'bg-yellow-400';
                            $textColor = 'text-white';
                        } elseif ($status === 'rejected') {
                            $bgColor = 'bg-red-500';
                            $textColor = 'text-white';
                        }
                    @endphp

                    <h1 class="text-sm py-2 px-2 rounded-xl font-semibold {{ $bgColor }} {{ $textColor }}">
                        {{ $status === 'completed' ? 'Sudah Diverifikasi' : ($status === 'pending' ? 'Menunggu Verifikasi' : 'Pengajuan Ditolak') }}
                    </h1>
                </div>
            </div>
            <hr class="mb-3">
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

                    <div class="mt-4">
                        <h1 class="font-bold">{{ $data->room->name }}</h1>
                        <h1 class="capitalize text-sm font-semibold mt-2"><i class="fa-light fa-users mr-1"></i>
                            {{ $data->user->name }}</h1>
                    </div>
                </div>
                <div class="flex space-x-3 mt-5">
                    <div>
                        <h1 class="font-bold text-sm text-black">Rp. {{ number_format($data->room->price, 0, ',', '.') }}
                        </h1>
                        <h1 class="text-[14px] text-gray-500">Harga Kamar</h1>
                    </div>
                    <div>
                        <div>
                            <i
                                class="fa-light fa-door-open mr-2 bg-blue-100 text-blue-900 lg:px-3 lg:py-2 px-3 py-2 rounded-lg lg:text-sm text-xs"></i>
                        </div>
                    </div>
                </div>
            </div>
            @if ($data->verification_contract == 'completed')
                @php
                    $jumlah = $data->deposit_amount + $data->room->price;
                @endphp
                <div class="text-end text-sm space-x-3 mt-4">
                    <h1>Deposit : <strong>Rp.{{ number_format($data->deposit_amount, 0, ',', '.') }}</strong></h1>
                    <h1>Jumlah Yang Harus Dibayar : <strong>Rp.{{ number_format($jumlah, 0, ',', '.') }}</strong></h1>
                </div>
                <div class="flex justify-end space-x-3 mt-5">
                    <div>
                        <a href="/owner/room/contract/{{ $data->user->user_id }}/show"
                            class="bg-red-500 px-3 font-bold rounded-lg py-2 text-white text-sm">
                            Batal Pengajuan
                        </a>
                    </div>
                    <div>
                        <a href="/owner/room/contract/{{ $data->user->user_id }}/show"
                            class="bg-primary px-3 font-bold rounded-lg py-2 text-white text-sm">
                            Bayar Kost
                        </a>
                    </div>
                </div>
            @elseif ($data->verification_contract == 'rejected')
               <div class="bg-red-50 border border-red-700 p-3 rounded-lg mt-3">
                    <h1 class="text-xs font-bold"> Pengajuan Sewa Kamu Di Tolak Karena : </h1>
                    <p>{{ $data->rejection_feedback }}</p>
               </div>
            @endif

        </div>
    @empty
        <div class="flex justify-center mt-10">
            <h1 class="font-bold">Tidak ada data Kamar</h1>
        </div>
    @endforelse
@endsection
