@extends('layout.pemilik')

@section('content')

    <h1 class="text-sm font-medium"><a href="/owner/room">Kamar /</a> <span class="font-bold"> Detail Kamar</span></h1>
    <h1 class="text-primary font-extrabold text-xl mb-4">Detail Kamar Kos</h1>
    <div class="bg-white shadow-sm rounded-xl p-5">
        <h1 class="text-sm font-semibold text-gray-800 mt-2 bg-orange-50 border-orange-400 border px-3 py-1 text-center rounded-lg w-3/12">Informasi Kamar </h1>
        <table class="table-auto w-full text-neutral text-sm mt-3">
            <tbody>
                <tr>
                    <td>Nama Kos</td>
                    <td>:</td>
                    <td>{{ $room->name }}</td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>:</td>
                    <td>{{ $room->address }}</td>
                </tr>
                <tr>
                    <td>Deskripsi</td>
                    <td>:</td>
                    <td>{{ $room->address }}</td>
                </tr>
            </tbody>
        </table>

        <div class="flex space-x-3 justify-between mt-3">
            <div class="flex">
                <div>
                    <i
                        class="fa-light fa-users mr-2 bg-base text-primary lg:px-3 lg:py-2 px-3 py-2 rounded-lg lg:text-sm text-xs"></i>
                </div>
                <div>
                    <h1 class="font-bold text-xs capitalize">{{ $room->type }}</h1>
                    <h1 class="text-[11px]">Type Kamar</h1>
                </div>
            </div>
            <div class="flex">
                <div>
                    <i
                        class="fa-light fa-money-bill-wave mr-2 bg-base text-primary lg:px-3 lg:py-2 px-3 py-2 rounded-lg lg:text-sm text-xs"></i>
                </div>
                <div>
                    <h1 class="font-bold text-xs">Rp. {{ number_format($room->price, 0, ',', '.') }}</h1>
                    <h1 class="text-[11px]">Harga Kamar</h1>
                </div>
            </div>
            <div class="flex">
                <div>
                    <i
                        class="fa-light fa-door-open mr-2 bg-blue-100 text-blue-900 lg:px-3 lg:py-2 px-3 py-2 rounded-lg lg:text-sm text-xs"></i>
                </div>
                <div>
                    <h1 class="font-bold text-xs">{{ $room->quantity }}</h1>
                    <h1 class="text-[11px] font-semibold text-black">Kamar Tersedia</h1>
                </div>
            </div>
            <div class="flex">
                <div>
                    <i
                        class="fa-light fa-wallet mr-2 bg-orange-50 text-orange-900 lg:px-3 lg:py-2 px-3 py-2 rounded-lg lg:text-sm text-xs"></i>
                </div>
                <div>
                    <h1 class="font-bold text-xs">Rp. {{ number_format($room->deposit_amount, 0, ',', '.') }}</h1>
                    <h1 class="text-[11px] font-semibold text-black">Deposito</h1>
                </div>
            </div>
        </div>

        <h1 class="text-sm font-semibold text-gray-800 mt-4 bg-red-50 px-3 py-1 border-red-400 border text-center rounded-lg w-3/12">Aturan Kos</h1>
        @if (!empty($room->regulation))
            <div class="mb-4 mt-2">
                <ul class="list-disc list-inside text-gray-700">
                    @php
                        $i = 1;
                    @endphp
                    @foreach ($room->regulation as $item)
                        <h1 class="text-sm font-medium text-black"><i
                                class="fa-light fa-circle-{{ $i++ }} clear-start mr-2"></i>{{ $item }}</h1>
                    @endforeach
                </ul>
            </div>
        @endif
        <h1 class="text-sm font-semibold text-gray-800 mt-2 bg-orange-50 border-orange-400 border px-3 py-1 text-center rounded-lg w-3/12">Fasilitas Umum</h1>
        @if (!empty($room->public_facility))
            <div class="mb-4 mt-2">
                <ul class="list-disc list-inside text-gray-700">
                    @php
                        $i = 1;
                    @endphp
                    @foreach ($room->public_facility as $item)
                        <h1 class="text-sm font-medium text-black"><i
                                class="fa-light fa-circle-{{ $i++ }} clear-start mr-2"></i>{{ $item }}
                        </h1>
                    @endforeach
                </ul>
            </div>
        @endif
        <h1 class="text-sm font-semibold text-gray-800 mt-2 bg-yellow-50 border-yellow-400 border px-3 py-1 text-center rounded-lg w-3/12">Fasilitas Kamar</h1>
        @if (!empty($room->room_facility))
            <div class="mb-4 mt-2">
                <ul class="list-disc list-inside text-gray-700">
                    @php
                        $i = 1;
                    @endphp
                    @foreach ($room->room_facility as $item)
                        <h1 class="text-sm font-medium text-black"><i
                                class="fa-light fa-circle-{{ $i++ }} clear-start mr-2"></i>{{ $item }}
                        </h1>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
@endsection
