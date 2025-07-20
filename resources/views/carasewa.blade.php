@extends('layout.LandingPage')

@section('content')
    <section class=" py-12">
        <div class="max-w-5xl mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold text-primary mb-4">Cara Sewa Kamar Kost</h2>
            <p class="text-gray-600 mb-10">Ikuti langkah mudah berikut untuk menyewa kamar kost</p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Langkah 1 -->
                <div class="bg-white shadow-md rounded-xl p-6">
                    <div class="text-indigo-600 text-4xl mb-2">1️⃣</div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Login Sebagai Pemilik</h3>
                    <p class="text-gray-600">Pemilik kost masuk ke sistem menggunakan akun yang sudah terdaftar.</p>
                </div>

                <!-- Langkah 2 -->
                <div class="bg-white shadow-md rounded-xl p-6">
                    <div class="text-indigo-600 text-4xl mb-2">2️⃣</div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Masukkan Data Kost</h3>
                    <p class="text-gray-600">Isi detail informasi kost dan pilih kamar yang tersedia.</p>
                </div>

                <!-- Langkah 3 -->
                <div class="bg-white shadow-md rounded-xl p-6">
                    <div class="text-indigo-600 text-4xl mb-2">3️⃣</div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Menunggu Verifikasi Admin</h3>
                    <p class="text-gray-600">Admin akan meninjau dan memverifikasi data kost yang diajukan.</p>
                </div>

                <!-- Langkah 4 -->
                <div class="bg-white shadow-md rounded-xl p-6">
                    <div class="text-indigo-600 text-4xl mb-2">4️⃣</div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Tanda Tangan Kontrak</h3>
                    <p class="text-gray-600">Setelah disetujui, pemilik dan penyewa menandatangani kontrak sewa.</p>
                </div>

                <!-- Langkah 5 -->
                <div class="bg-white shadow-md rounded-xl p-6">
                    <div class="text-indigo-600 text-4xl mb-2">5️⃣</div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Check-In</h3>
                    <p class="text-gray-600">Penyewa dapat melakukan proses check-in ke kamar sesuai jadwal.</p>
                </div>

                <!-- Langkah 6 -->
                <div class="bg-white shadow-md rounded-xl p-6">
                    <div class="text-indigo-600 text-4xl mb-2">6️⃣</div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Mulai Tinggal</h3>
                    <p class="text-gray-600">Penyewa resmi tinggal di kamar kost yang telah disewa.</p>
                </div>
            </div>
        </div>
    </section>
@endsection
