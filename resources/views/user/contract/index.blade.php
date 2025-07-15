@extends('layout.Penghuni')

@section('content')
    <h1 class="text-primary font-extrabold text-xl mb-4">Riwayat Pengajuan Sewa Kost</h1>
    @forelse ($contracts as $data)
        <div class="bg-white shadow rounded-xl p-3 mt-2">
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
                        @if ($data->room->galleries->isNotEmpty())
                            <img src="{{ asset('storage/' . $data->room->galleries->first()->image_url) }}" alt="foto kamar"
                                class="w-full h-24 object-cover rounded">
                        @else
                            <span class="col-span-3 text-xs text-gray-400">Belum ada foto</span>
                        @endif
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
                @if ($data->status === 'cancelled')
                    <div class="mt-2 p-3 bg-red-50 border border-red-600 rounded-lg ">
                        <p>
                            Pengajuan Sewa Anda Di batalkan!, <span class="italic font-semibold text-red-800">Silahkan
                                Lakukan Pengajuan Kamar Baru</span>
                        </p>
                    </div>
                @elseif($data->deposit_status === 'completed')
                    <div class="mt-2 p-3 bg-yellow-50 border border-yellow-600 rounded-lg ">
                        <p>
                            Yeay! Selamat datang di kos kami! 🎉 Terima kasih Telah memilih kami. Jangan lupa datang H-1
                            untuk lihat lokasi dan check-in dengan barcode yang tersedia ya! <a href=""
                                class="font-semibold text-red-500 underline italic text-sm">Cek Barcode di sini</a> <span>
                                Selamat bersiap pindah ke
                                kos baru!</span>
                        </p>

                    </div>
                @elseif ($data->signature === null)
                    <div class="flex justify-end space-x-3 mt-5">
                        <div>
                            <form action="{{ route('user.contract.signature.reject', $data->contract_id) }}"
                                method="post">
                                @csrf
                                @method('POST')
                                <input type="text" name="price" value="{{ $data->room->price }}" hidden
                                    id="">
                                <input type="text" name="name" value="{{ $data->room->name }}" hidden id="">
                                <input type="text" name="contract_id" value="{{ $data->contract_id }}" hidden
                                    id="">
                                <button type="submit" class="bg-red-500 px-3 font-bold rounded-lg py-2 text-white text-sm">
                                    Batal Pengajuan
                                </button>
                            </form>

                        </div>
                        <div class="mt-1">
                            <a href="{{ route('user.contract.ttd', $data->contract_id) }}"
                                class="bg-primary px-3 font-bold rounded-lg py-2 text-white text-sm">
                                Tanda Tangan Kontrak Kost
                            </a>
                        </div>
                    </div>
                @else
                    <div class="flex justify-end space-x-3 mt-5">
                        <div>
                            <form action="{{ route('user.contract.signature.reject', $data->contract_id) }}"
                                method="post">
                                @csrf
                                @method('POST')
                                <input type="text" name="price" value="{{ $data->room->price }}" hidden
                                    id="">
                                <input type="text" name="name" value="{{ $data->room->name }}" hidden id="">
                                <input type="text" name="contract_id" value="{{ $data->contract_id }}" hidden
                                    id="">
                                <button type="submit" class="bg-red-500 px-3 font-bold rounded-lg py-2 text-white text-sm">
                                    Batal Pengajuan
                                </button>
                            </form>

                        </div>
                        <div>
                            <form action="{{ route('user.contract.payment') }}" method="post">
                                @csrf
                                @method('POST')
                                <input type="text" name="price" value="{{ $data->room->price }}" hidden
                                    id="">
                                <input type="text" name="name" value="{{ $data->room->name }}" hidden id="">
                                <input type="text" name="contract_id" value="{{ $data->contract_id }}" hidden
                                    id="">
                                <button type="submit" class="bg-primary px-3 font-bold rounded-lg py-2 text-white text-sm">
                                    Bayar Kost
                                </button>
                            </form>
                        </div>
                    </div>
                @endif
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
