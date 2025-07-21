@extends('layout.LandingPage')

@section('content')
<section class="bg-gray-50 py-16">
    <div class="max-w-4xl mx-auto px-4 text-center">
        <div class="mb-10">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-green-100 rounded-full mx-auto">
                <svg class="w-10 h-10 text-green-600" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12.01 2C6.49 2 2 6.49 2 12c0 2.14.67 4.13 1.81 5.78L2 22l4.34-1.77A9.93 9.93 0 0012.01 22c5.52 0 9.99-4.48 9.99-10S17.53 2 12.01 2zm.05 17.13c-1.97 0-3.85-.58-5.42-1.66l-.39-.26-3.22.98.98-3.13-.26-.4a8.065 8.065 0 01-1.65-5.12c0-4.47 3.63-8.1 8.09-8.1s8.1 3.63 8.1 8.1-3.63 8.1-8.1 8.1zm4.19-6.3c-.23-.12-1.36-.67-1.57-.75s-.36-.11-.51.11c-.15.23-.58.75-.71.9s-.26.17-.49.06a6.62 6.62 0 01-1.95-1.21 7.33 7.33 0 01-1.36-1.7c-.14-.23-.01-.36.1-.47.1-.1.23-.26.35-.4.11-.14.15-.23.23-.39.07-.16.04-.29-.02-.41-.06-.12-.51-1.22-.7-1.67-.18-.44-.37-.38-.51-.38h-.44c-.15 0-.4.06-.6.29-.2.23-.78.76-.78 1.85s.8 2.15.91 2.3c.11.15 1.57 2.41 3.81 3.38.53.23.94.37 1.27.47.53.17 1.02.14 1.4.08.43-.06 1.36-.56 1.55-1.1.2-.54.2-1 .14-1.1-.05-.1-.2-.16-.43-.27z"/>
                </svg>
            </div>
            <h2 class="text-3xl font-bold text-gray-800 mt-4">Pusat Bantuan SimKost</h2>
            <p class="text-gray-600 mt-2 text-lg">Ada kendala atau pertanyaan? Kami siap membantu kamu!</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 text-left">
            <div class="bg-white p-6 rounded-xl shadow-md">
                <h3 class="text-xl font-semibold text-indigo-800 mb-2">Pertanyaan Umum</h3>
                <ul class="text-gray-700 space-y-2">
                    <li>• Bagaimana cara mendaftar sebagai pemilik kost?</li>
                    <li>• Bagaimana memesan kamar kost?</li>
                    <li>• Bagaimana proses verifikasi berjalan?</li>
                    <li>• Apa itu kontrak digital di SimKost?</li>
                </ul>
            </div>
            
            <div class="bg-white p-6 rounded-xl shadow-md">
                <h3 class="text-xl font-semibold text-indigo-800 mb-2">Butuh Bantuan Langsung?</h3>
                <p class="text-gray-700 mb-4">Kamu bisa langsung menghubungi admin kami melalui WhatsApp untuk bantuan lebih lanjut.</p>
                <a href="https://wa.me/6281234567890" target="_blank" class="inline-flex items-center px-5 py-3 bg-green-500 text-white font-semibold rounded-lg hover:bg-green-600 transition">
                    <svg class="w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12.01 2C6.49 2 2 6.49 2 12c0 2.14.67 4.13 1.81 5.78L2 22l4.34-1.77A9.93 9.93 0 0012.01 22c5.52 0 9.99-4.48 9.99-10S17.53 2 12.01 2zM7.15 8.46c.11-.25.61-.38.84-.4h.45c.19.01.39.04.49.24.1.19.57 1.33.62 1.45.05.11.08.26.01.41-.06.15-.1.24-.17.35s-.18.21-.27.3c-.09.1-.18.21-.07.42.11.21.5.83 1.22 1.44.72.61 1.34.82 1.55.93.21.11.34.09.45-.03.11-.12.52-.61.66-.82.14-.21.28-.17.45-.1.17.06 1.07.5 1.26.59.19.09.31.14.36.21.05.07.05.41-.1.8-.14.39-.81.75-1.1.8-.29.05-1.6.16-2.97-1.12-1.37-1.28-1.6-2.86-1.62-3.04-.02-.18.04-.41.15-.66z"/>
                    </svg>
                    Hubungi via WhatsApp
                </a>
            </div>
        </div>

        <div class="mt-12 text-center text-sm text-gray-500">
            © 2025 SimKost. Selalu siap membantu kebutuhan kost Anda.
        </div>
    </div>
</section>
@endsection
