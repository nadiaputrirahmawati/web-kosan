@extends('layout.Penghuni')
@section('content')
    <h1 class="text-primary font-extrabold text-xl mb-4">Informasi Pribadi</h1>
    <form action="{{ route('rooms.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="flex w-full items-center mb-6">
            <!-- Label -->
            <div class="w-4/12">
                <label for="image" class="text-sm font-semibold text-gray-700 block mb-2">Profile Penghuni Kamar</label>
            </div>

            <!-- Gambar Preview -->
            <div class="w-2/12 flex justify-center">
                <div class="w-24 h-24 rounded-full overflow-hidden bg-gray-200 shadow-md">
                    <img id="preview-image"
                        src="{{ old('image') ? asset('storage/' . old('image')) : 'https://via.placeholder.com/100' }}"
                        alt="Preview"
                        class="w-full h-full object-cover">
                </div>
            </div>

            <!-- Tombol Upload -->
            <div class="w-6/12 flex items-center pl-6">
                <input type="file" name="image" id="upload-image" accept="image/*"
                    onchange="previewImage(event)" class="hidden" required>

                <label for="upload-image"
                    class="cursor-pointer inline-flex items-center gap-2 bg-black text-white px-7 py-2 rounded-lg hover:bg-gray-900 transition text-sm font-medium shadow">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 10l5-5m0 0l5 5m-5-5v12" />
                    </svg>
                    Upload
                </label>
            </div>
        </div>

        <!-- Input Nama -->
        <div class="flex w-full mb-4">
            <div class="w-4/12 mt-2">
                <label for="name" class="text-sm font-semibold text-gray-700">Nama Penghuni Kamar</label>
            </div>
            <div
                class="flex items-center border border-gray-300 rounded-lg px-3 py-2 w-8/12 bg-white mt-2 
                   focus-within:border-gray-800 focus-within:ring-1 focus-within:ring-gray-800 transition-colors duration-200">
                <i class="fa-light fa-house mr-2"></i>
                <input type="text" name="name" id="name" placeholder="Contoh: Kamar A1" required
                    class="w-full outline-none text-sm" />
            </div>
        </div>

        <!-- Tombol Submit -->
        <div class="mt-3">
            <button type="submit"
                class="px-4 py-2 bg-primary text-white text-sm font-bold rounded-md hover:bg-primary">
                Lanjut
            </button>
        </div>
    </form>

    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            if (!file || !file.type.startsWith('image/')) return;

            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById('preview-image');
                preview.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    </script>
@endsection
