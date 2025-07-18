@extends('layout.Admin')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-sm font-medium"><a href="{{ route('admin.user-management.index') }}">User Management /</a> <span
                class="font-bold"> User Detail</span></h1>
        <h1 class="text-2xl font-semibold text-primary mb-6">Detail User: {{ $user->name }}</h1>

        <!-- Informasi User -->
        <div class="bg-quinary p-6 rounded-lg shadow-lg">
            <div class="flex lg:flex-row flex-col lg:space-x-5 space-x-0 w-full">
                <!-- Foto Profil User -->
                <div class="flex justify-center lg:w-4/12 w-full">
                    <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Profile Picture"
                        class="w-32 h-32 object-cover rounded-full shadow-lg">
                </div>

                <!-- Info Verifikasi & Status -->
                <div class="lg:w-8/12 w-full">
                    <h2 class="text-lg font-semibold text-secondary mb-2">Verifikasi & Status</h2>
                    <div class="overflow-x-auto w-full">
                        <table class="table-auto w-full text-left text-md ">
                            <tbody>
                                <tr>
                                    <td class="font-medium text-primary pr-4"><strong
                                            class="font-medium text-primary">Status
                                            Verifikasi</strong></td>
                                    <td>
                                        @if ($user->status_verification == 'pending')
                                            <span class="text-yellow-500">: Menunggu Verifikasi</span>
                                        @elseif($user->status_verification == 'verified')
                                            <span class="text-green-500">: Terverifikasi</span>
                                        @else
                                            <span class="text-red-500">: Ditolak</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="font-medium text-primary pr-4"><strong
                                            class="font-medium text-primary">Status
                                            Verifikasi</strong></td>
                                    <td>
                                        @if ($user->rejection_feedback)
                                            :{{ $user->rejection_feedback }}
                                        @else
                                            <span class="text-gray-500">: Tidak ada feedback</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="font-medium text-primary pr-4"><strong
                                            class="font-medium text-primary">Role</strong></td>
                                    <td>
                                        : {{ ucfirst($user->role) }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="font-medium text-primary pr-4"><strong class="font-medium text-primary">No
                                            Handphone</strong></td>
                                    <td>
                                        : {{ $user->phone_number }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
        <div class="flex lg:flex-row flex-col lg:space-x-3 space-x-0 w-full">
            <div class="bg-quinary p-6 rounded-lg shadow-lg mt-6 lg:w-6/12 w-full">
                <h2 class="text-xl font-semibold text-secondary mb-4">Informasi Pribadi</h2>
                <div class="overflow-x-auto w-full">
                    <table class="table-auto w-full text-left">
                        <tbody>
                            <tr>
                                <td class="font-medium text-primary pr-4">Nama</td>
                                <td>: {{ $user->name }}</td>
                            </tr>
                            <tr>
                                <td class="font-medium text-primary pr-4">Email</td>
                                <td>: {{ $user->email }}</td>
                            </tr>
                            <tr>
                                <td class="font-medium text-primary pr-4">No. KTP</td>
                                <td>: {{ $user->no_ktp }}</td>
                            </tr>
                            <tr>
                                <td class="font-medium text-primary pr-4">Tanggal Lahir</td>
                                <td>: {{ \Carbon\Carbon::parse($user->tgl_lahir)->format('d M Y') }}</td>
                            </tr>
                            <tr>
                                <td class="font-medium text-primary pr-4">Alamat</td>
                                <td>: {{ $user->address }}</td>
                            </tr>
                            <tr>
                                <td class="font-medium text-primary pr-4">Status</td>
                                <td>: {{ ucfirst($user->status) }}</td>
                            </tr>
                            <tr>
                                <td class="font-medium text-primary pr-4">Pendapatan</td>
                                <td>: Rp {{ number_format($user->pendapatan, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <td class="font-medium text-primary pr-4">No. Rekening</td>
                                <td>: {{ $user->no_rekening }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Foto KTP dan Bukti Lainnya -->
            <div class="bg-quinary p-6 rounded-lg shadow-lg mt-6 lg:w-6/12 w-full">
                <h2 class="text-xl font-semibold text-secondary mb-4">Foto-Foto Terkait</h2>

                <!-- Foto KTP -->
                <div class="mb-6">
                    <h3 class="font-medium text-primary">Foto KTP</h3>
                    @if ($user->ktp_picture)
                        <img src="{{ asset('storage/' . $user->ktp_picture) }}" alt="KTP Picture"
                            class="w-full h-auto object-cover rounded-lg shadow-md mt-2">
                    @else
                        <p class="text-gray-500 mt-2">Tidak ada foto KTP</p>
                    @endif
                </div>

                <!-- Foto KTP dengan Pemilik -->
                <div>
                    <h3 class="font-medium text-primary">Foto KTP dengan Pemilik</h3>
                    @if ($user->ktp_picture_person)
                        <img src="{{ asset('storage/' . $user->ktp_picture_person) }}" alt="KTP with Person"
                            class="w-full h-auto object-cover rounded-lg shadow-md mt-2">
                    @else
                        <p class="text-gray-500 mt-2">Tidak ada foto KTP dengan pemilik</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
