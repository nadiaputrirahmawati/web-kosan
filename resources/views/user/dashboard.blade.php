@extends('layout.Penghuni')
@section('content')
    <div>
        <h1 class="text-primary font-extrabold text-xl mb-4">Dashboard Kos</h1>
        <div class="flex lg:flex-row flex-col w-full lg:space-x-3 space-x-0">
            <div class="lg:w-6/12 w-full p-4 bg-gradient-to-r shadow rounded-lg from-quaternary to-tertiary">
                <div class="w-12 rounded-full bg-orange-400 py-3 text-center">
                    <h1><i class="fa-solid fa-door-open text-white"></i></h1>
                </div>
                <div class="mt-3">
                    <h1 class="text-primary text-xl font-bold">Selamat Datang, {{ Auth::user()->name }}! 👋</h1>
                    <p class="text-primary text-sm font-semibold mt-1">Selamat tinggal di SIMKOST! Semoga hari-harimu di kos
                        selalu nyaman dan menyenangkan 🫶 </p>
                </div>
                <div class="mt-3 w-full bg-white p-3 rounded-lg flex justify-between">
                    <div>
                        <h1 class="text-primary font-bold text-sm">Yuk, Beri Review Kosmu</h1>
                    </div>
                    <div>
                        <a href="" class="text-primary font-xs"><i class="fa-light fa-square-plus"></i></a>
                    </div>
                </div>
            </div>

            <div class="lg:w-6/12 w-full mt-5 lg:mt-0 bg-white p-4 shadow rounded-lg">
                <div class="flex justify-between">
                    <h1 class="text-primary font-extrabold text-lg">- Kos Saya</h1>
                    <h1 class="text-primary bg-base py-2 px-3 rounded-full"><i class="fa-thin fa-users"></i></h1>
                </div>
                <div class="mt-2">
                    @if ($activeContract)
                        <h1 class="font-semibold">{{ $activeContract->room->name }}</h1>
                        <h1 class="mt-2"> Kontrak Berakhir
                            <strong>{{ \Carbon\Carbon::parse($activeContract->end_date)->format('d M Y') }}</strong>
                        </h1>
                        <div class="mt-3 bg-primary text-white py-2 px-3 rounded-lg text-center w-full font-bold">
                            <a href="{{ route('user.room.show', $activeContract->contract_id) }}" class="">Detail Kost
                                Saya</a>
                        </div>
                    @else
                        Tidak ada kontrak aktif
                    @endif
                </div>
            </div>
        </div>
        <div class="flex lg:flex-col flex-row w-full space-x-3 mt-3">
            <div class="lg:w-7/12 w-full p-4 bg-white shadow rounded-lg">
                <div class="flex justify-between">
                    <h1 class="text-primary font-extrabold text-lg">- Komplain Saya</h1>
                    <h1 class="text-primary bg-base py-2 px-3 rounded-full"><i class="fa-light fa-notes"></i></h1>
                </div>
                <div class="mt-2">
                    <h1 class="font-semibold">Total: {{ $totalKomplain }} | Aktif: {{ $pendingKomplain }}</h1>
                    <div>
                        @foreach ($complaints as $complaint)
                            @php
                                // Tentukan label dan warna berdasarkan status
                                switch ($complaint->status) {
                                    case 'in_proses':
                                        $label = 'Sedang Diproses';
                                        $bg = 'bg-yellow-100';
                                        $text = 'text-yellow-800';
                                        break;
                                    case 'completed':
                                        $label = 'Selesai';
                                        $bg = 'bg-green-100';
                                        $text = 'text-green-800';
                                        break;
                                    default:
                                        // asumsikan null atau 'pending'
                                        $label = 'Sedang Diajukan';
                                        $bg = 'bg-gray-100';
                                        $text = 'text-gray-800';
                                        break;
                                }
                            @endphp

                            <h1 class="mt-2 bg-white py-2 px-3 rounded shadow-sm">{{ $complaint->description }} -
                                <span
                                    class="{{ $bg }} {{ $text }} px-3 py-1 rounded-full text-xs font-semibold">
                                    {{ $label }}
                                </span>
                            </h1>
                        @endforeach
                    </div>
                    {{-- <div class="mt-3 bg-primary text-white py-2 px-3 rounded-lg text-center w-full font-bold">
                        <a href="{{ route('user.complaints.index') }}" class="">Lihat Komplain</a>
                    </div> --}}
                </div>
            </div>

            {{-- <div class="w-6/12 bg-white p-4 shadow rounded-lg">
                <div class="flex justify-between">
                    <h1 class="text-primary font-extrabold text-lg">- Riwayat Kontrak Terbaru</h1>
                    <h1 class="text-primary bg-base py-2 px-3 rounded-full"><i class="fa-thin fa-users"></i></h1>
                </div>
                <div class="mt-2">
                    @foreach ($previousContracts as $contract)
                        <li class="mb-1">
                            {{ $contract->room->name }} |
                            {{ \Carbon\Carbon::parse($contract->start_date)->format('d M Y') }} -
                            {{ \Carbon\Carbon::parse($contract->end_date)->format('d M Y') }}
                            ({{ ucfirst($contract->status) }})
                        </li>
                    @endforeach
                </div>
            </div> --}}
        </div>
    </div>
@endsection
