@extends('layout.Penghuni')

@section('content')
    <h1 class="text-primary font-extrabold text-xl mb-4">Kost Saya</h1>
    {{-- @forelse ($room as $data) --}}
    <div class="bg-white shadow rounded-xl p-3 mt-2">
        <div class="flex justify-between mt-2 mb-4">
            <div>
                <h1 class="text-sm font-semibold"><span><i
                            class="fa-light fa-calendar mr-2"></i></span>{{ \Carbon\Carbon::parse($data->payment->created_at)->translatedFormat('d F Y H:i') }}
                </h1>
            </div>
            <div>
                <a href=""
                    class="text-sm font-semibold text-primary bg-base py-2 px-3 border border-primary rounded-lg"> Detail
                    Kost</a>
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

                <div class="mt-2">
                    <h1 class="font-bold">{{ $data->room->name }}</h1>
                    <h1 class="capitalize text-sm  mt-2"><i class="fa-regular fa-calendar-day mr-1"></i>
                       Tanggal Mulai    : <strong> {{ $data->start_date }}</strong></h1>
                    <h1 class="capitalize text-sm  mt-2"><i class="fa-regular fa-calendar-check mr-1"></i>
                       Tanggal Berakhir :  <strong> {{ $data->end_date }}</strong></h1>
                </div>
            </div>
            <div>
                <div class="text-center">
                    {{-- <p class="font-semibold mb-2">QR Code untuk Check-in:</p> --}}
                    <div class="flex justify-center">
                        {!! $qrCode !!}
                    </div>
                    <p class="text-xs text-gray-500 mt-2">Scan QR ini untuk melakukan <br> check-in ke kamar kost.</p>
                </div>
            </div>
        </div>
    </div>
    {{-- @empty
        <div class="flex justify-center mt-10">
            <h1 class="font-bold">Tidak ada data Kamar</h1>
        </div>
    @endforelse --}}
@endsection
