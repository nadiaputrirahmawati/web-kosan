@extends('layout.LandingPage')

@section('content')
<section class="bg-white py-16">
    <div class="max-w-5xl mx-auto px-4">
        <h1 class="text-4xl font-bold text-center text-primary mb-8">Tentang SimKost</h1>
        
        <p class="text-gray-700 text-lg mb-10 text-center leading-relaxed">
            <strong>SimKost</strong> adalah sistem manajemen kost digital yang memudahkan pemilik kost dan penghuni dalam mengelola aktivitas sewa-menyewa kamar. Dengan platform ini, semua proses dilakukan secara online — mulai dari pencarian kamar, pengisian data, verifikasi, hingga check-in dan kontrak digital.
        </p>

        <!-- Peran dalam SimKost -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-center">
            <!-- Pemilik Kost -->
            <div class="bg-indigo-50 p-6 rounded-xl shadow-md hover:shadow-lg transition">
                <div class="text-indigo-600 text-5xl mb-3">🏠</div>
                <h3 class="text-xl font-semibold text-indigo-800 mb-2">Pemilik Kost</h3>
                <p class="text-gray-600">Dapat menambahkan data kost, mengelola kamar, memantau penyewa, dan melihat status pembayaran secara real-time.</p>
            </div>

            <!-- Penghuni Kost -->
            <div class="bg-indigo-50 p-6 rounded-xl shadow-md hover:shadow-lg transition">
                <div class="text-indigo-600 text-5xl mb-3">🧑‍💼</div>
                <h3 class="text-xl font-semibold text-indigo-800 mb-2">Penghuni Kost</h3>
                <p class="text-gray-600">Bisa mencari kamar, mengajukan sewa, menandatangani kontrak digital, dan memantau tagihan atau jadwal check-in secara online.</p>
            </div>

            <!-- Admin -->
            <div class="bg-indigo-50 p-6 rounded-xl shadow-md hover:shadow-lg transition">
                <div class="text-indigo-600 text-5xl mb-3">🛡️</div>
                <h3 class="text-xl font-semibold text-indigo-800 mb-2">Admin Sistem</h3>
                <p class="text-gray-600">Bertugas memverifikasi data kost, menjaga keamanan sistem, dan membantu menyelesaikan permasalahan teknis antara pemilik dan penghuni.</p>
            </div>
        </div>
    </div>
</section>
@endsection
