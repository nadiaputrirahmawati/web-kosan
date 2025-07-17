@extends('layout.Penghuni')

@section('content')
    {{-- Tampilkan error jika ada --}}
    @if ($errors->any())
        <div class="mb-4">
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Oops!</strong>
                <span class="block sm:inline">Ada beberapa kesalahan:</span>
                <ul class="mt-2 list-disc list-inside text-sm text-red-600">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <h1 class="text-primary font-extrabold text-xl mb-4">Kost Saya</h1>

    @forelse ($room as $data)
        @php
            $paymentCompleted = $data->payment?->status === 'completed';
            $sisaHari = now()->diffInDays(\Carbon\Carbon::parse($data->end_date), false);
            $statusValid = in_array($data->verification_contract, ['completed', 'rejected']);
        @endphp

        @if ($statusValid)
            <div class="bg-white shadow rounded-xl p-3 mt-4">
                {{-- Header --}}
                <div class="flex justify-between mb-3">
                    <h1 class="text-sm font-semibold">
                        <i class="fa-light fa-calendar mr-2"></i>
                        {{ \Carbon\Carbon::parse($data->created_at)->translatedFormat('d F Y H:i') }}
                    </h1>
                    <a href="{{ route('user.room.show', $data->contract_id) }}"
                        class="text-sm font-semibold text-primary bg-base py-2 px-3 border border-primary rounded-lg">
                        Detail Kost
                    </a>
                </div>

                <hr class="mb-3">

                {{-- Konten --}}
                <div class="flex justify-between">
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
                            <h1 class="text-sm mt-2">
                                <i class="fa-regular fa-calendar-day mr-1"></i>
                                Tanggal Mulai: <strong>{{ $data->start_date }}</strong>
                            </h1>
                            <h1 class="text-sm mt-2">
                                <i class="fa-regular fa-calendar-check mr-1"></i>
                                Tanggal Berakhir: <strong>{{ $data->end_date }}</strong>
                            </h1>

                            @if ($data->status === 'in_renewal')
                                <h1 class="text-sm mt-2 text-blue-500">
                                    <i class="fa-regular fa-check-circle mr-1"></i>
                                    <strong>Sudah Diperpanjang</strong>
                                </h1>
                            @elseif ($data->status === 'active')
                                <h1 class="text-sm mt-2 text-green-500">
                                    <i class="fa-regular fa-check-circle mr-1"></i>
                                    <strong>Kontrak Aktif</strong>
                                </h1>
                            @elseif ($data->status === 'pending_payment' && $data->verification_contract != 'pending' && $data->signature != null)
                                <h1 class="text-sm mt-2 text-red-500">
                                    <i class="fa-regular fa-info-circle mr-1"></i>
                                    <strong>Menunggu Pembayaran</strong>
                                </h1>
                            @endif
                        </div>
                    </div>

                    {{-- QR Code untuk check-in jika payment selesai dan kontrak initial --}}
                    @if ($paymentCompleted && $data->contract_type === 'initial')
                        <div class="text-center">
                            {!! QrCode::size(100)->generate(route('contract.checkin', $data->contract_id)) !!}
                            <p class="text-xs text-gray-500 mt-2">Scan QR untuk <br> check-in ke kamar kost.</p>
                        </div>
                    @endif
                </div>

                {{-- Tombol Aksi --}}
                @if ($data->status === 'pending_payment' && $data->verification_contract === 'completed')
                    @if ($data->signature)
                        <div class="flex justify-end mt-8 text-end">
                            <div>
                                <h1>Jumlah Yang Harus Dibayar:
                                    <strong>Rp{{ number_format($data->room->price, 0, ',', '.') }}</strong>
                                </h1>
                                <form action="{{ route('user.contract.payment') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="contract_id" value="{{ $data->contract_id }}">
                                    <button type="submit" class="bg-primary text-white font-bold px-4 py-2 mt-4 rounded-md">
                                        Bayar Kost
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <p class="text-red-500 mt-4 font-semibold">Anda harus menandatangani kontrak sebelum membayar.
                            <a href="{{ route('user.contract') }}" class="text-primary">Klik Disini</a>
                        </p>
                    @endif
                @elseif ($data->status === 'pending_payment')
                    <h1 class="text-end text-red-500 mt-4">Menunggu Verifikasi Kontrak oleh Pemilik Kost</h1>
                @endif

                {{-- Tampilkan tombol perpanjang jika status aktif dan sisa hari <= 7 --}}
                @if ($data->status === 'active' && $sisaHari <= 7)
                    <div class="flex mt-6 space-x-3 w-full">
                        <div class="w-8/12 bg-red-50 border border-red-400 px-3 py-2 rounded-lg">
                            <p class="text-sm text-gray-500">
                                Kontrak Anda akan berakhir pada
                                <strong>{{ \Carbon\Carbon::parse($data->end_date)->translatedFormat('d F Y') }}</strong>.
                            </p>
                        </div>
                        <div class="w-4/12">
                            <form action="{{ route('user.contract.newcontract', $data->contract_id) }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="bg-primary hover:font-bold text-white px-4 py-2 rounded-md w-full">
                                    Perpanjang Kontrak
                                </button>
                            </form>
                        </div>
                    </div>
                @endif
            </div>
        @else
        <h1 class="font-bold text-center text-red-500">Belum ada Kamar</h1>
        @endif
    @empty
        <div class="flex justify-center mt-10">
            <h1 class="font-bold">Tidak ada data Kamar</h1>
        </div>
    @endforelse
@endsection
