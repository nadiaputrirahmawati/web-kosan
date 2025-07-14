@extends('layout.Admin')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-3xl font-semibold text-primary mb-6">Verifikasi Penarikan Uang - {{ $withdrawal->owner->name }}</h1>

        <!-- Form Verifikasi Penarikan -->
        <div class="bg-quinary rounded-lg shadow-md p-6">
            @if (empty($withdrawal->proof))
                    <div
                        class="rounded-xl bg-red-100 border border-red-300 text-red-800 px-4 py-3 mb-4 flex items-start gap-3">
                        <svg class="w-5 h-5 mt-1 text-red-500 shrink-0" fill="none" stroke="currentColor"
                            stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 9v2m0 4h.01M12 5a7 7 0 100 14 7 7 0 000-14z" />
                        </svg>
                        <div class="flex-1 text-sm font-medium">
                            <p>Bukti penarikan belum diunggah oleh pemilik Kost. harap hati hati untuk melakukan verifikasi!</p>
                        </div>
                    </div>
                @endif
            <form action="{{ route('admin.withdrawals.update', $withdrawal->withdrawal_id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Nama Owner -->
                <div class="mb-4">
                    <label for="name" class="block text-secondary text-sm font-medium">Nama Owner</label>
                    <input type="text" id="name" name="name" value="{{ $withdrawal->owner->name }}" disabled
                        class="mt-1 block w-full bg-quinary border border-quaternary rounded-md px-4 py-2 focus:outline-none">
                </div>

                <!-- Jumlah yang Diminta -->
                <div class="mb-4">
                    <label for="amount" class="block text-secondary text-sm font-medium">Jumlah yang Diminta</label>
                    <input type="text" id="amount" name="amount"
                        value="Rp {{ number_format($withdrawal->amount, 0, ',', '.') }}" disabled
                        class="mt-1 block w-full bg-quinary border border-quaternary rounded-md px-4 py-2 focus:outline-none">
                </div>

                <!-- Bukti Penarikan -->
                <div class="mb-4">
                    <label for="proof" class="block text-secondary text-sm font-medium">Bukti Penarikan</label>
                    <div class="mb-2">
                        @if ($withdrawal->proof)
                            <span class="text-green-500">Bukti Tersedia</span>
                            <!-- Jika bukti adalah file, kita bisa menambahkan gambar atau file untuk dilihat admin -->
                            <div>
                                <!-- Misalnya link ke gambar bukti, jika ada -->
                                <a href="{{ asset('storage/' . $withdrawal->proof) }}" class="text-blue-500"
                                    target="_blank">Lihat Bukti</a>
                            </div>
                        @else
                            <span class="text-red-500">Bukti Tidak Ada</span>
                        @endif
                    </div>
                </div>

                <!-- Status Penarikan -->
                <div class="mb-4">
                    <label for="status" class="block text-secondary text-sm font-medium">Status Penarikan</label>
                    <input type="text" id="status" name="status" value="{{ ucfirst($withdrawal->status) }}" disabled
                        class="mt-1 block w-full bg-quinary border border-quaternary rounded-md px-4 py-2 focus:outline-none">
                </div>

                <p class="text-red-500">Hati-Hati dalam mengisi form verifikasi penarikan!, pastikan Anda telah memeriksa
                    bukti penarikan yang di kirimkan.</p>

                <!-- Tombol Verifikasi -->
                <div class="mt-6 flex justify-end space-x-4">
                    @if ($withdrawal->status == 'pending')
                        <button type="submit" name="action" value="completed"
                            class="bg-green-500 text-quinary px-6 py-2 rounded-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-primary">Setujui</button>
                    @endif
                </div>
            </form>
        </div>
    </div>
@endsection
