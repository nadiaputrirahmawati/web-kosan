@extends('layout.Penghuni')

@section('content')
    @if ($errors->any())
        <div class="mb-4">
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Oops!</strong>
                <span class="block sm:inline">Ada beberapa kesalahan dalam pengisian form:</span>
                <ul class="mt-2 list-disc list-inside text-sm text-red-600">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
    <h1 class="text-sm font-medium"><a href="/user/room/contract">Contract /</a> <span class="font-bold"> Surat Perjanjian</span></h1>
    <h1 class="text-primary font-extrabold text-xl mb-4">Surat Perjanjian Sewa Kost</h1>
    <div class="max-w-4xl mx-auto bg-white lg:p-10 p-3 rounded-lg shadow-md border">
        <h2 class="text-2xl font-bold text-center mb-6">Surat Perjanjian Sewa Kost</h2>

        <p class="mb-4">Pada hari ini, <strong>{{ now()->translatedFormat('l, d F Y') }}</strong>, telah terjadi
            perjanjian
            sewa antara:</p>

        <div class="mb-6">
            <table class="w-full table ">
                <tbody>
                    <tr>
                        <td class="text-sm font-semibold text-gray-800"> Nama Penyewa</td>
                        <td class="text-sm font-semibold text-gray-800">:</td>
                        <td class="text-sm font-semibold text-gray-800"> {{ $contract->user->name }} </td>
                    </tr>
                    <tr>
                        <td class="text-sm font-semibold text-gray-800"> Email </td>
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
        </div>

        <p class="mb-4 font-bold">Dengan pemilik kost atas kamar berikut:</p>

        <div class="mb-6">
            <table class="w-9/12 table ">
                <tbody>
                    <tr>
                        <td class="text-sm font-semibold text-gray-800"> Nama Kamar</td>
                        <td class="text-sm font-semibold text-gray-800">:</td>
                        <td class="text-sm font-semibold text-gray-800"> {{ $contract->room->name }} </td>
                    </tr>
                    <tr>
                        <td class="text-sm font-semibold text-gray-800"> Alamat Kost </td>
                        <td class="text-sm font-semibold text-gray-800">:</td>
                        <td class="text-sm font-semibold text-gray-800"> {{ $contract->room->address }} </td>
                    </tr>
                    <tr>
                        <td class="text-sm font-semibold text-gray-800"> No KTP</td>
                        <td class="text-sm font-semibold text-gray-800">:</td>
                        <td class="text-sm font-semibold text-gray-800"> {{ $contract->user->no_ktp }} </td>
                    </tr>
                    <tr>
                        <td class="text-sm font-semibold text-gray-800"> Harga Sewa per Bulan</td>
                        <td class="text-sm font-semibold text-gray-800">:</td>
                        <td class="text-sm font-semibold text-gray-800">
                            Rp.{{ number_format($contract->room->price, 0, ',', '.') }} </td>
                    </tr>
                    <tr>
                        <td class="text-sm font-semibold text-gray-800"> Jumlah Deposit</td>
                        <td class="text-sm font-semibold text-gray-800">:</td>
                        <td class="text-sm font-semibold text-gray-800 capitalize">
                            Rp.{{ number_format($contract->deposit_amount, 0, ',', '.') }} </td>
                    </tr>
                    <tr>
                        <td class="text-sm font-semibold text-gray-800"> Total Dibayarkan Awal</td>
                        <td class="text-sm font-semibold text-gray-800">:</td>
                        <td class="text-sm font-semibold text-gray-800 capitalize">
                            Rp{{ number_format($contract->room->price + $contract->deposit_amount, 0, ',', '.') }} </td>
                    </tr>
                    <tr>
                        <td class="text-sm font-semibold text-gray-800"> Jenis Kelamin</td>
                        <td class="text-sm font-semibold text-gray-800">:</td>
                        <td class="text-sm font-semibold text-gray-800 capitalize">
                            {{ $contract->user->gender === 'L' ? 'Laki-laki' : 'Perempuan' }} </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <h3 class="font-semibold mb-2">Aturan Kost:</h3>
        <ul class="list-disc list-inside mb-6 text-sm">
            @php
                $i = 1;
            @endphp
            @foreach ($contract->room->regulation as $rule)
                <h1><i class="fa-solid fa-{{ $i++ }} ml-3"></i><strong>.</strong>
                    <span>{{ $rule }}</span>
                </h1>
            @endforeach
        </ul>

        <h3 class="font-semibold mb-2">Ketentuan Deposit:</h3>
        <ul class="list-disc list-inside mb-6 text-sm">
            <li>Deposit digunakan sebagai jaminan apabila terjadi kerusakan fasilitas kost oleh penyewa.</li>
            <li>Deposit akan dikembalikan saat masa sewa berakhir apabila tidak ada pelanggaran atau kerusakan.</li>
            <li>Deposit tidak dapat dianggap sebagai pengganti pembayaran bulanan.</li>
            <li>Pengembalian dilakukan maksimal 7 hari kerja setelah masa sewa berakhir.</li>
        </ul>

        <p class="mb-4 text-justify">Penyewa setuju untuk membayar sewa secara bulanan dan mematuhi seluruh peraturan yang
            telah
            ditetapkan oleh pemilik kost. Apabila terdapat pelanggaran, pemilik berhak memberikan sanksi sesuai kebijakan.
        </p>

        <p class="mb-6">Perjanjian ini berlaku sejak
            <strong>{{ \Carbon\Carbon::parse($contract->start_date)->translatedFormat('d F Y') }}</strong> sampai dengan
            <strong>{{ \Carbon\Carbon::parse($contract->end_date)->translatedFormat('d F Y') }}</strong>.
        </p>

        <div class="flex justify-end">
            <div class="mt-10 text-center">
                <div>
                    <p class="mb-2">Penyewa,</p>
                    @if ($contract->signature)
                        <img src="{{ asset('storage/' . $contract->signature) }}" class="h-20 mx-auto" alt="Tanda Tangan">
                    @else
                        <p class="italic text-sm text-gray-400">Belum ditandatangani</p>
                        {{-- Tanda tangan digital --}}
                        <canvas id="signature-pad" class="border w-full h-40 rounded mb-3"></canvas>

                        <form id="signature-form"
                            action="{{ route('user.contract.signature.save', $contract->contract_id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="signature" id="signature-input">
                            <div class="flex gap-3 justify-center">
                                <button type="button" id="clear"
                                    class="px-4 py-2 bg-gray-500 text-white rounded">Bersihkan</button>
                                <button type="submit" id="save"
                                    class="px-4 py-2 bg-green-600 text-white rounded">Simpan
                                    Tanda Tangan</button>
                            </div>
                        </form>
                    @endif

                    <p class="mt-2 font-semibold underline">{{ Auth::user()->name }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Script Signature --}}
    @if (!$contract->signature)
        <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.1.5/dist/signature_pad.umd.min.js"></script>
        <script>
            const canvas = document.getElementById('signature-pad');
            const signaturePad = new SignaturePad(canvas);

            document.getElementById('clear').addEventListener('click', function() {
                signaturePad.clear();
            });

            document.getElementById('save').addEventListener('click', function(e) {
                e.preventDefault();

                if (signaturePad.isEmpty()) {
                    alert("Silakan tanda tangani terlebih dahulu.");
                    return;
                }

                const dataURL = signaturePad.toDataURL();
                document.getElementById('signature-input').value = dataURL;
                document.getElementById('signature-form').submit();
            });
        </script>
    @endif
@endsection
