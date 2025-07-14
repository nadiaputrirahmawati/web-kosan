@extends('layout.Admin')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-3xl font-semibold text-primary mb-6">Verifikasi Akun - {{ $user->name }}</h1>

        <!-- Form Verifikasi Akun -->
        <div class="bg-quinary rounded-lg shadow-md p-6">
            <form action="{{ route('admin.user-management.update', $user->user_id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Kolom Kiri: Foto Profil & Status Verifikasi -->
                    <div class="mb-6">
                        <h2 class="text-xl font-semibold text-primary mb-4">Informasi Profil</h2>

                        <!-- Foto Profil -->
                        <div class="mb-4">
                            <label for="profile_picture" class="block text-secondary text-sm font-medium">Foto
                                Profil</label>
                            <div class="mb-2">
                                @if ($user->profile_picture)
                                    <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Foto Profil"
                                        class="w-full md:w-48 h-48 object-cover rounded-md border">
                                @else
                                    <p>Belum ada foto profil</p>
                                @endif
                            </div>
                        </div>

                        <!-- Status Verifikasi -->
                        <div class="mb-4">
                            <label for="status_verification" class="block text-secondary text-sm font-medium">Status
                                Verifikasi</label>
                            <input type="text" id="status_verification" name="status_verification"
                                value="{{ ucfirst($user->status_verification) }}" disabled
                                class="mt-1 block w-full bg-quinary border border-quaternary rounded-md px-4 py-2 focus:outline-none">
                        </div>
                    </div>

                    <!-- Kolom Kanan: Data Pengguna -->
                    <div class="mb-6">
                        <h2 class="text-xl font-semibold text-primary mb-4">Informasi Pengguna</h2>

                        <!-- Nama -->
                        <div class="mb-4">
                            <label for="name" class="block text-secondary text-sm font-medium">Nama Lengkap</label>
                            <input type="text" id="name" name="name" value="{{ $user->name }}" disabled
                                class="mt-1 block w-full bg-quinary border border-quaternary rounded-md px-4 py-2 focus:outline-none">
                        </div>

                        <!-- Email -->
                        <div class="mb-4">
                            <label for="email" class="block text-secondary text-sm font-medium">Email</label>
                            <input type="email" id="email" name="email" value="{{ $user->email }}" disabled
                                class="mt-1 block w-full bg-quinary border border-quaternary rounded-md px-4 py-2 focus:outline-none">
                        </div>

                        <!-- No KTP -->
                        <div class="mb-4">
                            <label for="no_ktp" class="block text-secondary text-sm font-medium">No KTP</label>
                            <input type="text" id="no_ktp" name="no_ktp" value="{{ $user->no_ktp }}" disabled
                                class="mt-1 block w-full bg-quinary border border-quaternary rounded-md px-4 py-2 focus:outline-none">
                        </div>

                        <!-- Tanggal Lahir -->
                        <div class="mb-4">
                            <label for="tgl_lahir" class="block text-secondary text-sm font-medium">Tanggal Lahir</label>
                            <input type="text" id="no_ktp" name="no_ktp"
                                value="{{ \Carbon\Carbon::parse($user->tgl_lahir)->format('d-m-Y') }}" disabled
                                class="mt-1 block w-full bg-quinary border border-quaternary rounded-md px-4 py-2 focus:outline-none">
                        </div>

                        <!-- Role -->
                        <div class="mb-4">
                            <label for="role" class="block text-secondary text-sm font-medium">Role Pengguna</label>
                            <input type="text" id="role" name="role" value="{{ ucfirst($user->role) }}" disabled
                                class="mt-1 block w-full bg-quinary border border-quaternary rounded-md px-4 py-2 focus:outline-none">
                        </div>
                    </div>
                </div>

                <!-- Gambar KTP dan Foto KTP dengan Pemilik -->
                <div class="mt-6 border-t pt-6">
                    <h2 class="text-xl font-semibold text-primary mb-4">Dokumen Terkait</h2>

                    <!-- Foto KTP -->
                    <div class="mb-4">
                        <label for="ktp_picture" class="block text-secondary text-sm font-medium">Foto KTP</label>
                        <div class="mb-2">
                            @if ($user->ktp_picture)
                                <img src="{{ asset('storage/' . $user->ktp_picture) }}" alt="Foto KTP"
                                    class="w-full md:w-48 h-48 object-cover rounded-md border">
                            @else
                                <p>Belum ada foto KTP</p>
                            @endif
                        </div>
                    </div>

                    <!-- Foto KTP dengan Pemilik -->
                    <div class="mb-4">
                        <label for="ktp_picture_person" class="block text-secondary text-sm font-medium">Foto KTP dengan
                            Pemilik</label>
                        <div class="mb-2">
                            @if ($user->ktp_picture_person)
                                <img src="{{ asset('storage/' . $user->ktp_picture_person) }}"
                                    alt="Foto KTP dengan Pemilik"
                                    class="w-full md:w-48 h-48 object-cover rounded-md border">
                            @else
                                <p>Belum ada foto KTP dengan Pemilik</p>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Tombol Verifikasi atau Tolak -->
                <div class="mt-6 flex justify-end space-x-4">
                    @if ($user->status_verification === 'pending' || empty($user->status_verification))
                        <!-- Tombol Verifikasi -->
                        <button type="submit" name="action" value="verified"
                            class="bg-primary text-white px-4 py-2 rounded-md hover:bg-secondary focus:outline-none focus:ring-2 focus:ring-primary">Verifikasi</button>

                        <!-- Tombol Tolak -->
                        <button type="submit" name="action" value="reject"
                            class="bg-red-500 text-quinary px-6 py-2 rounded-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-primary">Tolak</button>
                    @elseif($user->status_verification === 'verified')
                        <!-- Jika status verifikasi sudah verified, tidak perlu tombol -->
                        <p class="text-green-500">Akun sudah diverifikasi</p>
                    @elseif($user->status_verification === 'reject')
                        <!-- Jika status verifikasi sudah reject, tidak perlu tombol -->
                        <p class="text-red-500">Akun ditolak</p>
                    @endif
                </div>
            </form>
        </div>
    </div>
@endsection
