@extends('layout.Pemilik')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-3xl font-semibold text-primary mb-6">Daftar Permintaan Penarikan</h1>
    <div>
        <a href="{{ route('owner.withdrawals.create') }}" class="bg-primary text-quinary px-6 py-2 rounded-lg shadow-md hover:bg-primary/80 transition-all duration-300">
            Ajukan Permintaan Penarikan
        </a>
    </div>

    <!-- Saldo Owner -->
    <div class="bg-quinary p-6 rounded-lg shadow-lg mb-6">
        <h2 class="text-xl font-semibold text-secondary mb-4">Saldo Anda</h2>
        <p class="text-3xl font-bold text-primary">Rp {{ number_format($user->balance, 0, ',', '.') }}</p>
    </div>

    <!-- Tabel Daftar Permintaan Penarikan -->
    <div class="bg-quinary p-6 rounded-lg shadow-lg">
        <h2 class="text-xl font-semibold text-secondary mb-4">Daftar Permintaan Penarikan</h2>

        @if($withdrawals->isEmpty())
            <p class="text-gray-500">Anda belum membuat permintaan penarikan.</p>
        @else
            <table class="min-w-full table-auto border-collapse">
                <thead>
                    <tr class="bg-primary text-quinary">
                        <th class="px-6 py-3 text-left text-sm font-semibold">Tanggal</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Jumlah Penarikan</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($withdrawals as $withdrawal)
                        <tr class="border-t border-gray-300">
                            <td class="px-4 py-2">{{ \Carbon\Carbon::parse($withdrawal->created_at)->format('d M Y') }}</td>
                            <td class="px-4 py-2">Rp {{ number_format($withdrawal->amount, 0, ',', '.') }}</td>
                            <td class="px-4 py-2">
                                @if($withdrawal->status == 'pending')
                                    <span class="bg-yellow-500 text-quinary px-4 py-2 rounded-md">Menunggu Verifikasi</span>
                                @elseif($withdrawal->status == 'completed')
                                    <button class="bg-green-500 text-quinary px-4 py-2 rounded-md">Selesai</button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
@endsection
