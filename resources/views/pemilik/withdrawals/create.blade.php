@extends('layout.Pemilik')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-3xl font-semibold text-primary mb-6">Permintaan Penarikan</h1>

        @if (session('success'))
            <div class="bg-green-500 text-white p-4 mb-4 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if ($pendingWithdrawal)
            <div class="bg-yellow-100 border-t-4 border-yellow-500 text-yellow-700 p-4 mb-4 rounded-md">
                <strong>Perhatian!</strong> Anda masih memiliki permintaan penarikan yang <strong>pending</strong>.
                Harap menunggu hingga permintaan sebelumnya selesai diproses sebelum mengajukan permintaan baru.
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-500 text-white p-4 mb-4 rounded">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-quinary p-6 rounded-lg shadow-lg">
            <h2 class="text-xl font-semibold text-primary mb-4">Form Permintaan Penarikan</h2>

            <!-- Form Permintaan Penarikan -->
            <form action="{{ route('owner.withdrawals.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="amount" class="block text-primary font-medium">Jumlah Penarikan (Rp)</label>
                    <input type="number" name="amount" id="amount"
                        class="w-full p-3 mt-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
                        required min="1" value="{{ old('amount') }}">
                </div>

                <div class="mb-4">
                    <p><strong class="text-primary">Saldo Anda:</strong> Rp {{ number_format($user->balance, 0, ',', '.') }}
                    </p>
                </div>

                <div>
                    <button type="submit"
                        class="bg-primary text-quinary px-6 py-2 rounded-md hover:bg-primary/80 transition-all duration-300 
                   @if ($pendingWithdrawal) opacity-50 cursor-not-allowed @endif"
                        @if ($pendingWithdrawal) disabled @endif>
                        Ajukan Penarikan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
