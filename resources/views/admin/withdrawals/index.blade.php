@extends('layout.Admin')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-3xl font-semibold text-primary mb-6">Manajemen Penarikan Uang</h1>

    <!-- Tabel Daftar Request Penarikan -->
    <div class="overflow-x-auto bg-quinary rounded-lg shadow-md">
        <table class="w-full table-auto">
            <thead class="bg-primary text-white">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-semibold">#</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold">Nama Owner</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold">Jumlah Diminta</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold">Bukti</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold">Status</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold">Tanggal Permintaan</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($withdrawals as $withdrawal)
                <tr class="hover:bg-quaternary transition-all">
                    <td class="px-4 py-2 text-sm text-primary">{{ $loop->iteration }}</td>
                    <td class="px-4 py-2 text-sm text-primary">{{ $withdrawal->owner->name }}</td>
                    <td class="px-4 py-2 text-sm text-primary">Rp {{ number_format($withdrawal->amount, 0, ',', '.') }}</td>
                    <td class="px-4 py-2 text-sm text-primary">
                        @if($withdrawal->proof)
                            <span class="text-green-500">Bukti Tersedia</span>
                        @else
                            <span class="text-red-500">Bukti Tidak Ada</span>
                        @endif
                    </td>
                    <td class="px-4 py-2 text-sm text-primary">
                        <span class="px-2 py-1 rounded-md 
                            @if($withdrawal->status == 'pending') bg-yellow-500 text-quinary 
                            @elseif($withdrawal->status == 'completed') bg-green-500 text-quinary 
                            @endif">
                            {{ ucfirst($withdrawal->status) }}
                        </span>
                    </td>
                    <td class="px-4 py-2 text-sm text-primary">{{ $withdrawal->created_at->format('d M Y H:i') ?? '-' }}</td>
                    <td class="px-4 py-2 text-sm text-primary">
                        <a href="{{ route('admin.withdrawals.show', $withdrawal->withdrawal_id) }}" class="text-blue-500 hover:underline">Verifikasi</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
