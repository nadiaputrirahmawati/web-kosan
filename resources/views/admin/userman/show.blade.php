@extends('layout.Admin')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-3xl font-semibold text-primary mb-6">Detail User: {{ $user->name }}</h1>

    <!-- Informasi User -->
    <div class="bg-quinary p-6 rounded-lg shadow-lg">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            
            <!-- Foto Profil User -->
            <div class="flex justify-center">
                <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Profile Picture" class="w-32 h-32 object-cover rounded-full shadow-lg">
            </div>

            <!-- Info User -->
            <div>
                <h2 class="text-xl font-semibold text-secondary mb-2">Informasi Pribadi</h2>
                <p><strong class="font-medium text-primary">Nama:</strong> {{ $user->name }}</p>
                <p><strong class="font-medium text-primary">Email:</strong> {{ $user->email }}</p>
                <p><strong class="font-medium text-primary">No. KTP:</strong> {{ $user->no_ktp }}</p>
                <p><strong class="font-medium text-primary">Tanggal Lahir:</strong> {{ \Carbon\Carbon::parse($user->tgl_lahir)->format('d M Y') }}</p>
                <p><strong class="font-medium text-primary">Alamat:</strong> {{ $user->address }}</p>
                <p><strong class="font-medium text-primary">Status:</strong> {{ ucfirst($user->status) }}</p>
                <p><strong class="font-medium text-primary">Pendapatan:</strong> Rp {{ number_format($user->pendapatan, 0, ',', '.') }}</p>
                <p><strong class="font-medium text-primary">No. Rekening:</strong> {{ $user->no_rekening }}</p>
            </div>

            <!-- Info Verifikasi & Status -->
            <div>
                <h2 class="text-xl font-semibold text-secondary mb-2">Verifikasi & Status</h2>
                <p><strong class="font-medium text-primary">Status Verifikasi:</strong> 
                    @if($user->status_verification == 'pending')
                        <span class="text-yellow-500">Menunggu Verifikasi</span>
                    @elseif($user->status_verification == 'verified')
                        <span class="text-green-500">Terverifikasi</span>
                    @else
                        <span class="text-red-500">Ditolak</span>
                    @endif
                </p>
                <p><strong class="font-medium text-primary">Feedback Penolakan:</strong> 
                    @if($user->rejection_feedback)
                        {{ $user->rejection_feedback }}
                    @else
                        <span class="text-gray-500">Tidak ada feedback</span>
                    @endif
                </p>
                <p><strong class="font-medium text-primary">Role:</strong> {{ ucfirst($user->role) }}</p>
                <p><strong class="font-medium text-primary">Nomor HP:</strong> {{ $user->phone_number }}</p>
                <p><strong class="font-medium text-primary">Email Terverifikasi:</strong> 
                    @if($user->email_verified_at)
                        <span class="text-green-500">Terverifikasi</span>
                    @else
                        <span class="text-red-500">Belum Terverifikasi</span>
                    @endif
                </p>
            </div>
        </div>
    </div>

    <!-- Foto KTP dan Bukti Lainnya -->
    <div class="bg-quinary p-6 rounded-lg shadow-lg mt-6">
        <h2 class="text-xl font-semibold text-secondary mb-4">Foto-Foto Terkait</h2>

        <!-- Foto KTP -->
        <div class="mb-6">
            <h3 class="font-medium text-primary">Foto KTP</h3>
            @if($user->ktp_picture)
                <img src="{{ asset('storage/' . $user->ktp_picture) }}" alt="KTP Picture" class="w-full h-auto object-cover rounded-lg shadow-md mt-2">
            @else
                <p class="text-gray-500 mt-2">Tidak ada foto KTP</p>
            @endif
        </div>

        <!-- Foto KTP dengan Pemilik -->
        <div>
            <h3 class="font-medium text-primary">Foto KTP dengan Pemilik</h3>
            @if($user->ktp_picture_person)
                <img src="{{ asset('storage/' . $user->ktp_picture_person) }}" alt="KTP with Person" class="w-full h-auto object-cover rounded-lg shadow-md mt-2">
            @else
                <p class="text-gray-500 mt-2">Tidak ada foto KTP dengan pemilik</p>
            @endif
        </div>
    </div>

    <!-- Tombol Kembali -->
    <div class="mt-6">
        <a href="{{ route('admin.user-management.index') }}" class="bg-primary text-quinary px-6 py-2 rounded-md hover:bg-primary/80 transition-all duration-300">Kembali ke Daftar User</a>
    </div>
</div>
@endsection
