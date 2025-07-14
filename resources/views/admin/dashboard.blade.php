@extends('layout.Admin')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-3xl font-semibold text-primary mb-6">Admin Dashboard</h1>

    <!-- Info Dashboard -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        
        <!-- Jumlah Pengguna -->
        <div class="bg-gradient-to-r from-primary to-secondary p-6 rounded-lg shadow-lg">
            <h2 class="text-xl font-semibold text-quinary">Jumlah Pengguna</h2>
            <p class="text-3xl font-bold text-quinary mt-2">{{ $totalUsers }}</p>
        </div>

        <!-- Jumlah Permintaan Withdraw -->
        <div class="bg-gradient-to-r from-primary to-tertiary p-6 rounded-lg shadow-lg">
            <h2 class="text-xl font-semibold text-quinary">Jumlah Permintaan Withdraw</h2>
            <p class="text-3xl font-bold text-quinary mt-2">{{ $totalWithdrawals }}</p>
        </div>

        <!-- Slot tambahan (misalnya grafik atau info lainnya) -->
        <div class="bg-gradient-to-r from-primary to-quaternary p-6 rounded-lg shadow-lg">
            <h2 class="text-xl font-semibold text-quinary">Info Tambahan</h2>
            <p class="text-3xl font-bold text-quinary mt-2">-</p>
        </div>
    </div>
</div>
@endsection
