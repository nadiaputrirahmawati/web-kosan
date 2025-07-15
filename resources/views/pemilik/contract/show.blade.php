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
        <div class="bg-white shadow-sm rounded-xl p-6 lg:w-7/12 w-full">
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
                        alt="KTP" class="w-full object-cover rounded">

                </div>
                <div class="w-6/12">
                    <h1 class="font-bold text-sm mb-2"> Foto Data Diri</h1>
                    <img src="{{ $contract->user->ktp_picture_person ? asset('storage/' . $contract->user->ktp_picture_person) : asset('img/gambarkos.png') }}"
                        alt="KTP" class="w-full object-cover rounded">
                </div>
            </div>
        </div>
        <div class="bg-white shadow-sm rounded-xl p-5 lg:w-5/12 w-full lg:mt-0 mt-3" x-data="{ showRejectForm: false }">
            <h1
                class="text-sm font-semibold text-gray-800 mt-2 bg-orange-50 border-orange-400 border px-3 py-1 text-center rounded-lg">
                Informasi Kamar </h1>

            <div class="flex flex-col justify-between mt-3">
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
                <div class="flex mt-2">
                    <div>
                        <i
                            class="fa-light fa-calendar mr-2 bg-base text-primary lg:px-3 lg:py-2 px-3 py-2 rounded-lg lg:text-sm text-xs"></i>
                    </div>
                    <div>
                        <h1 class="font-bold text-xs capitalize">{{ $contract->start_date }}</h1>
                        <h1 class="text-[11px]">Tanggal Masuk</h1>
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
                <div class="flex justify-between space-x-16 ">
                    <div class="flex mt-2">
                        <div>
                            <i
                                class="fa-light fa-wallet mr-2 bg-orange-50 text-orange-900 lg:px-3 lg:py-2 px-3 py-2 rounded-lg lg:text-sm text-xs"></i>
                        </div>
                        <div>
                            <h1 class="font-bold text-xs">Rp.
                                {{ number_format($contract->room->deposit_amount, 0, ',', '.') }}
                            </h1>
                            <h1 class="text-[11px] font-semibold text-black">Deposito</h1>
                        </div>
                    </div>
                    <div class="flex mt-2 space-x-1">
                        <div>
                            <h1 class="font-bold text-xs text-end">Rp. {{ number_format($contract->room->price, 0, ',', '.') }}</h1>
                            <h1 class="text-[11px] text-end">Harga Kamar</h1>
                        </div>
                        <div>
                            <i
                                class="fa-light fa-money-bill-wave mr-2 bg-base text-primary lg:px-3 lg:py-2 px-3 py-2 rounded-lg lg:text-sm text-xs"></i>
                        </div>
                    </div>
                </div>
                <div class="mt-3">
                    <h1 class="text-md"> Jumlah Yang Harus Dibayar : <span class="font-bold">Rp.
                            {{ number_format($contract->deposit_amount + $contract->room->price, 0, ',', '.') }}</span>
                    </h1>
                </div>
                <div class="flex mt-6">
                    <!-- Tombol Verifikasi -->

                    @if ($contract->verification_contract === 'pending')
                        <div>
                            <form action="{{ route('rooms.contract.verifikasi', $contract->user->user_id) }}"
                                method="post">
                                @csrf
                                <button type="submit" class="mr-2 bg-primary text-white px-3 py-2 rounded-lg text-xs">
                                    Verifikasi Sewa
                                </button>
                            </form>
                        </div>
                        <div>
                            <button type="button" @click="showRejectForm = !showRejectForm"
                                class="bg-red-500 text-white px-3 py-2 rounded-lg text-xs">
                                Tolak Permintaan Sewa
                            </button>
                        </div>
                    @elseif ($contract->verification_contract === 'completed')
                        <div>
                            <h1 class="font-bold text-md"> Data Sudah Diverifikasi Silahkan Melakukan Pembayaran</h1>
                        </div>
                    @elseif ($contract->verification_contract === 'rejected')
                        <div>
                            <h1 class="font-bold text-md"> Data Anda Di Tolak</h1>
                            <p>{{ $contract->rejection_feedback }}</p>
                        </div>
                    @endif
                    <!-- Tombol Tolak -->

                </div>

                <!-- Form Penolakan -->
                <div x-show="showRejectForm" class="mt-4" x-transition>
                    <form action="{{ route('rooms.contract.reject', $contract->user->user_id) }}" method="post">
                        @csrf
                        @method('put')
                        <label for="reason" class="block text-sm font-medium text-gray-700 mb-1">Alasan Penolakan:</label>
                        <textarea name="rejection_feedback" id="rejection_feedback" rows="3"
                            class="w-full border border-gray-300 rounded-lg p-2 text-sm focus:ring focus:ring-primary"
                            placeholder="Masukkan alasan penolakan..." required></textarea>

                        <button type="submit"
                            class="mt-2 bg-red-600 text-white px-4 py-2 rounded-md text-sm hover:bg-red-700 transition">
                            Kirim Penolakan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
