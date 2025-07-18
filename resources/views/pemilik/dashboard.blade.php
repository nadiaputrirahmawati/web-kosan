@extends('layout.Pemilik')
@section('content')
    <div>
        <h1 class="text-primary font-extrabold text-xl mb-4">Dashboard Kos</h1>
        <div class="flex lg:flex-row flex-col w-full lg:space-x-3 space-x-0">
            <div class="lg:w-6/12 w-full">
                <div class=" p-4 bg-gradient-to-r shadow rounded-lg from-quaternary to-tertiary">
                    <div class="w-12 rounded-full bg-orange-400 py-3 text-center">
                        <h1><i class="fa-solid fa-door-open text-white"></i></h1>
                    </div>
                    <div class="mt-3">
                        <h1 class="text-primary text-xl font-bold">Selamat Datang, {{ Auth::user()->name }}! 👋</h1>
                        <p class="text-primary text-sm font-semibold mt-1">Hai, selamat datang di SIMKOST! Yuk, cek
                            pendapatanmu
                            di bawah 👇 </p>
                    </div>
                    <div class="mt-3 w-full bg-white p-3 rounded-lg flex justify-between items-center">
                        <div>
                            <p class="text-xs text-gray-500 font-medium">Saldo Anda</p>
                            <h1 class="text-primary font-bold text-lg">Rp
                                {{ number_format(Auth::user()->balance, 0, ',', '.') }}</h1>
                        </div>
                        <div>
                            <a href="{{ route('owner.withdrawals.index') }}"
                                class="text-sm text-white bg-primary hover:bg-green-600 transition px-3 py-1.5 rounded-lg flex items-center gap-2">
                                <i class="fa-solid fa-money-bill-wave"></i>
                                Tarik Uang
                            </a>
                        </div>
                    </div>

                </div>
                <div class="mt-3 p-4 bg-white shadow rounded-lg">
                    <div class="flex justify-between">
                        <h1 class="text-primary font-extrabold text-lg">- Daftar Komplain</h1>
                        <h1 class="text-primary bg-base py-2 px-3 rounded-full"><i class="fa-light fa-notes"></i></h1>
                    </div>
                    <div class="mt-2 overflow-x-auto">
                        <table class="w-full mt-4 text-xs border border-gray-200 rounded-lg ">
                            <thead class="bg-primary text-white text-left">
                                <tr>
                                    <th class="py-3 px-4">Nama Penghuni</th>
                                    <th class="py-3 px-4">Keterangan Komplain</th>
                                    <th class="py-3 px-4">Status</th>
                                    <th class="py-3 px-4">Waktu</th>
                                    <th class="py-3 px-4">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white">
                                @forelse ($complaints as $complaint)
                                    @php
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
                                                $label = 'Sedang Diajukan';
                                                $bg = 'bg-gray-100';
                                                $text = 'text-gray-800';
                                                break;
                                        }
                                    @endphp
                                    <tr class="border-t border-gray-100 hover:bg-gray-50">
                                        <td class="py-2 px-4">{{ $complaint->user->name ?? '-' }}</td>
                                        <td class="py-2 px-4">{{ $complaint->description }}</td>
                                        <td class="py-2 px-4">
                                            <span class="{{ $bg }} {{ $text }} text-xs px-2 rounded-full">
                                                {{ $label }}
                                            </span>
                                        </td>
                                        <td class="py-2 px-4">
                                            {{ \Carbon\Carbon::parse($complaint->created_at)->format('d M Y H:i') }}</td>
                                        <td class="py-2 px-4">
                                            <a
                                                href="{{ route('owner.complaints.edit', $complaint->complaint_id) }}">Detail</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="py-3 px-4 text-center text-gray-500">Belum ada komplain.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


            <div class="lg:w-6/12 w-full mt-5 lg:mt-0 ">
                <div class="flex space-x-3 w-full">
                    <div class="bg-white shadow-sm rounded-xl p-5 w-6/12 text-center">
                        <h1 class="text-primary font-extrabold text-lg">Kos Saya</h1>
                        <h1 class="text-primary rounded-full">{{ $room->count() }}</h1>
                    </div>
                    <div class="bg-white shadow-sm rounded-xl p-5 w-6/12 text-center">
                        <h1 class="text-primary font-extrabold text-lg">Penghuni</h1>
                        <h1 class="text-primary rounded-full">{{ $penghuni }}</h1>
                    </div>
                </div>
                <div class="flex justify-between bg-white p-4 shadow rounded-lg mt-2">
                    <div>
                        <h1 class="text-primary font-extrabold text-lg">- Daftar Kos</h1>
                        <p class="text-xs ml-3">Silahkan Lihat Kos Terbaru</p>
                    </div>
                    <h1 class="text-primary bg-base py-2 px-3 rounded-full"><i class="fa-thin fa-users"></i></h1>
                </div>
                <div class="mt-2">
                    @forelse ($contract as $data)
                        <div class="bg-white shadow-sm rounded-xl p-5 mt-2">
                            <a href="{{ route('rooms.contract.index') }}">
                                <h1 class="font-bold">{{ Str::limit($data->room->name, 40) }}</h1>
                                <h1>Penghuni : {{ $data->user->name }}</h1>
                                @if ($data->verification_contract == 'pending')
                                    <h1 class="text-red-500 text-end text-sm font-bold">Menunggu Verifikasi</h1>
                                @elseif ($data->verification_contract == 'completed')
                                    <h1>Status :
                                        @if ($data->status = 'active')
                                            Aktif
                                        @elseif ($data->status = 'in_renewal')
                                            Diperpanjang
                                        @else
                                            Tidak Aktif
                                        @endif
                                    </h1>
                                @elseif ($data->verification_contract == 'rejected')
                                    <h1 class="text-red-500">Verifikasi Ditolak</h1>
                                @else
                                    <h1>js</h1>
                                @endif
                            </a>
                        </div>
                    @empty
                        <h1 class="text-bold text-center"> Tidak Ada Pengajuan Hari Ini</h1>
                    @endforelse

                </div>
            </div>
        </div>
    </div>
@endsection
