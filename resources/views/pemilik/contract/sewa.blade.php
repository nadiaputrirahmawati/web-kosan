@extends('layout.pemilik')
@section('content')
    <div class="flex justify-between">
        <div>
            <h1 class="text-sm font-medium"><a href="/owner/room/contract">Contract /</a> <span class="font-bold"> Contract
                    Pengajuan Kamar</span></h1>
            <h1 class="text-primary font-extrabold text-xl mb-4">Data Pengajuan Sewa</h1>
        </div>
    </div>
    <div class="flex lg:flex-row flex-col lg:space-x-3 space-x-0 w-full">
        <div class="bg-white shadow-sm rounded-xl p-6 lg:w-7/12 w-full overflow-x-auto">
            <h1
                class="text-sm font-semibold text-gray-800 mb-3 w-48 bg-orange-50 border-orange-400 border px-3 py-1 text-center rounded-lg">
                Informasi Data Diri </h1>
            <table class="w-full table ">
                <tbody>
                    <tr>
                        <td class="text-sm font-semibold text-gray-800"> Nama Pemilik</td>
                        <td class="text-sm font-semibold text-gray-800">:</td>
                        <td class="text-sm font-semibold text-gray-800"> {{ $contract->user->name }} </td>
                    </tr>
                    <tr>
                        <td class="text-sm font-semibold text-gray-800"> Email Pemilik</td>
                        <td class="text-sm font-semibold text-gray-800">:</td>
                        <td class="text-sm font-semibold text-gray-800"> {{ $contract->user->email }} </td>
                    </tr>
                    <tr>
                        <td class="text-sm font-semibold text-gray-800"> No KTP</td>
                        <td class="text-sm font-semibold text-gray-800">:</td>
                        <td class="text-sm font-semibold text-gray-800"> {{ $contract->user->no_ktp }} </td>
                    </tr>
                    <tr>
                        <td class="text-sm font-semibold text-gray-800"> Nomor Telepon</td>
                        <td class="text-sm font-semibold text-gray-800">:</td>
                        <td class="text-sm font-semibold text-gray-800"> {{ $contract->user->phone_number }} </td>
                    </tr>
                    <tr>
                        <td class="text-sm font-semibold text-gray-800"> Status</td>
                        <td class="text-sm font-semibold text-gray-800">:</td>
                        <td class="text-sm font-semibold text-gray-800 capitalize"> {{ $contract->user->status }} </td>
                    </tr>
                    <tr>
                        <td class="text-sm font-semibold text-gray-800"> Tanggal Lahir</td>
                        <td class="text-sm font-semibold text-gray-800">:</td>
                        <td class="text-sm font-semibold text-gray-800 capitalize"> {{ $contract->user->tgl_lahir }} </td>
                    </tr>
                    <tr>
                        <td class="text-sm font-semibold text-gray-800"> Umur</td>
                        <td class="text-sm font-semibold text-gray-800">:</td>
                        <td class="text-sm font-semibold text-gray-800 capitalize">
                            {{ \Carbon\Carbon::parse($contract->user->tgl_lahir)->age }} tahun </td>
                    </tr>
                    <tr>
                        <td class="text-sm font-semibold text-gray-800"> Jenis Kelamin</td>
                        <td class="text-sm font-semibold text-gray-800">:</td>
                        <td class="text-sm font-semibold text-gray-800 capitalize">
                            {{ $contract->user->gender === 'L' ? 'Laki-laki' : 'Perempuan' }} </td>
                    </tr>
                </tbody>
            </table>
            <hr class="mt-1 mb-1">
            <div class="flex space-x-4 w-full">
                <div class="w-6/12">
                    <h1 class="font-bold text-sm mb-2">Foto Ktp</h1>
                    <img src="{{ $contract->user->ktp_picture ? asset('storage/' . $contract->user->ktp_picture) : asset('img/gambarkos.png') }}"
                        alt="KTP" class="w-40 object-cover rounded">

                </div>
                <div class="w-6/12">
                    <h1 class="font-bold text-sm mb-2"> Foto Data Diri</h1>
                    <img src="{{ $contract->user->ktp_picture_person ? asset('storage/' . $contract->user->ktp_picture_person) : asset('img/gambarkos.png') }}"
                        alt="KTP" class="w-40 object-cover rounded">
                </div>
            </div>
        </div>
        <div class="bg-white shadow-sm rounded-xl p-5 lg:w-5/12 w-full lg:mt-0 mt-3" x-data="{ showRejectForm: false }">
            <h1 class="text-primary font-extrabold text-xl mb-4">Riwayat Sewa Kos</h1>
            <div class="flex mt-2">
                <div>
                    <i
                        class="fa-light fa-door-open mr-2 bg-base text-primary lg:px-3 lg:py-2 px-3 py-2 rounded-lg lg:text-sm text-xs"></i>
                </div>
                <div>
                    <h1 class="font-bold text-xs capitalize">{{ $contract->room->name }}</h1>
                    <h1 class="text-[11px]">Nama Kamar</h1>
                </div>
            </div>
            <div class="flex space-x-6 justify-between">
                <div class="flex mt-2">
                    <div>
                        <i
                            class="fa-light fa-users mr-2 bg-base text-primary lg:px-3 lg:py-2 px-3 py-2 rounded-lg lg:text-sm text-xs"></i>
                    </div>
                    <div>
                        <h1 class="font-bold text-xs capitalize">{{ $contract->room->type }}</h1>
                        <h1 class="text-[11px]">Type Kamar</h1>
                    </div>
                </div>
                <div class="flex mt-2 space-x-2">
                    <div>
                        <h1 class="font-bold text-xs text-end">
                            {{ $contract->verification_contract === 'completed' ? 'Sudah Diverifikasi' : 'Belum Diverifikasi' }}
                        </h1>
                        <h1 class="text-[11px] font-semibold text-black text-end">Status Verifikasi</h1>
                    </div>
                    <div>
                        <i
                            class="fa-light fa-signal mr-2 bg-orange-50 text-orange-900 lg:px-3 lg:py-2 px-3 py-2 rounded-lg lg:text-sm text-xs"></i>
                    </div>
                </div>
            </div>
            <div class="flex space-x-6 justify-between">
                <div class="flex mt-2">
                    <div>
                        <i
                            class="fa-light fa-money-bill-wave mr-2 bg-base text-primary lg:px-3 lg:py-2 px-3 py-2 rounded-lg lg:text-sm text-xs"></i>
                    </div>
                    <div>
                        <h1 class="font-bold text-xs capitalize">{{ number_format($contract->room->price) }}</h1>
                        <h1 class="text-[11px]">Harga Kamar</h1>
                    </div>
                </div>
                <div class="flex mt-2 space-x-2">
                    <div>
                        <h1 class="font-bold text-xs text-end">
                            {{ number_format($contract->room->deposit_amount) }}
                        </h1>
                        <h1 class="text-[11px] font-semibold text-black text-end">Deposito</h1>
                    </div>
                    <div>
                        <i
                            class="fa-light fa-wallet mr-2 bg-orange-50 text-orange-900 lg:px-3 lg:py-2 px-3 py-2 rounded-lg lg:text-sm text-xs"></i>
                    </div>
                </div>
            </div>
            @php $i = 1; @endphp
            @forelse ($data as $room)
                <div class="bg-white shadow rounded-xl p-4 mt-4">
                    <div class="flex justify-between items-center mb-2">
                        <h2 class="font-bold text-sm">Bulan Ke-{{ $i++ }}</h2>
                        <span
                            class="text-xs font-semibold px-2 py-1 rounded
        @if ($room->status == 'pending_payment') bg-orange-100 text-orange-800
        @elseif ($room->status == 'cancelled') bg-red-100 text-red-800
        @elseif ($room->status == 'in_renewal') bg-yellow-100 text-yellow-800
        @elseif ($room->status == 'active') bg-green-100 text-green-800
        @else text-gray-700 @endif">
                            @if ($room->status == 'in_renewal')
                                Sudah Diperpanjang
                            @elseif ($room->status == 'active')
                                Sedang Aktif
                            @elseif ($room->status == 'cancelled')
                                Tidak Aktif
                            @else
                                {{ ucfirst($room->status) }}
                            @endif
                        </span>

                    </div>

                    <div class="flex justify-between mt-2 text-xs text-gray-700">
                        <div class="flex items-center space-x-2">
                            <i class="fa-solid fa-calendar-check bg-blue-100 text-blue-900 px-3 py-2 rounded-lg"></i>
                            <div>
                                <p class="font-semibold">{{ \Carbon\Carbon::parse($room->start_date)->format('d M Y') }}
                                </p>
                                <p class="text-[11px] text-black">Tanggal Masuk</p>
                            </div>
                        </div>

                        <div class="flex items-center space-x-2">
                            <i class="fa-solid fa-calendar-day bg-indigo-100 text-indigo-900 px-3 py-2 rounded-lg"></i>
                            <div>
                                <p class="font-semibold">{{ \Carbon\Carbon::parse($room->end_date)->format('d M Y') }}</p>
                                <p class="text-[11px] text-black">Tanggal Keluar</p>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center text-sm text-gray-500 mt-4">Belum ada data pemesanan kamar.</div>
            @endforelse


        </div>
    </div>
@endsection
