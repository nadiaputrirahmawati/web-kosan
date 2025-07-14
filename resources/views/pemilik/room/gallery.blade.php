@extends('layout.pemilik')
@section('content')
    <h1 class="text-sm font-medium"><a href="/owner/room/{{ $room->room_id }}/show">Kamar /</a> <span class="font-bold"> Tambah
            Kamar</span></h1>
    <h1 class="text-primary font-extrabold text-xl mb-4">Tambah Foto Kamar</h1>
    <div class="w-full flex space-x-3 ">
        <div class="bg-white shadow-sm rounded-xl p-5 w-5/12">
            <h1
                class="text-sm font-semibold text-gray-800 mt-2 bg-orange-50 border-orange-400 border px-3 py-1 text-center rounded-lg">
                Informasi Kamar </h1>
            <h1 class="text-2xl font-bold mt-1">-{{ $room->name }}</h1>
            <h1 class="text-sm"><i class="fa-light fa-location-dot mr-1 ml-2 mt-1"></i> {{ $room->address }} </h1>

            <div class="flex flex-col justify-between mt-3">
                <div class="flex mt-2">
                    <div>
                        <i
                            class="fa-light fa-users mr-2 bg-base text-primary lg:px-3 lg:py-2 px-3 py-2 rounded-lg lg:text-sm text-xs"></i>
                    </div>
                    <div>
                        <h1 class="font-bold text-xs capitalize">{{ $room->type }}</h1>
                        <h1 class="text-[11px]">Type Kamar</h1>
                    </div>
                </div>
                <div class="flex mt-2">
                    <div>
                        <i
                            class="fa-light fa-money-bill-wave mr-2 bg-base text-primary lg:px-3 lg:py-2 px-3 py-2 rounded-lg lg:text-sm text-xs"></i>
                    </div>
                    <div>
                        <h1 class="font-bold text-xs">Rp. {{ number_format($room->price, 0, ',', '.') }}</h1>
                        <h1 class="text-[11px]">Harga Kamar</h1>
                    </div>
                </div>
                <div class="flex mt-2">
                    <div>
                        <i
                            class="fa-light fa-door-open mr-2 bg-blue-100 text-blue-900 lg:px-3 lg:py-2 px-3 py-2 rounded-lg lg:text-sm text-xs"></i>
                    </div>
                    <div>
                        <h1 class="font-bold text-xs">{{ $room->quantity }}</h1>
                        <h1 class="text-[11px] font-semibold text-black">Kamar Tersedia</h1>
                    </div>
                </div>
                <div class="flex mt-2">
                    <div>
                        <i
                            class="fa-light fa-wallet mr-2 bg-orange-50 text-orange-900 lg:px-3 lg:py-2 px-3 py-2 rounded-lg lg:text-sm text-xs"></i>
                    </div>
                    <div>
                        <h1 class="font-bold text-xs">Rp. {{ number_format($room->deposit_amount, 0, ',', '.') }}</h1>
                        <h1 class="text-[11px] font-semibold text-black">Deposito</h1>
                    </div>
                </div>
            </div>
            <h1 class="mt-2 font-bold text-lg"> Deksripsi Kamar</h1>
            <p> {{ $room->description }}</p>
        </div>
        <div class="bg-white shadow-sm rounded-xl p-6 w-7/12">
            <h1 class="text-primary font-extrabold text-xl mb-4">Upload Gambar Kos</h1>
            <form action="{{ route('rooms.gallery.store', $room->room_id) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-4">
                    <!-- Hidden Input -->
                    <input type="file" name="images[]" id="upload-images" multiple accept="image/*"
                        onchange="previewImages(event)" class="hidden" required>

                    <!-- Custom Upload Button -->
                    <label for="upload-images"
                        class="cursor-pointer inline-flex items-center gap-2 bg-black text-white px-7 py-2 rounded-lg hover:bg-gray-900 transition text-sm font-medium shadow">
                        <!-- Icon (SVG Upload Icon) -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 10l5-5m0 0l5 5m-5-5v12" />
                        </svg>
                        Upload
                    </label>

                    <p class="text-xs text-gray-500 mt-1">Maksimal 6 gambar, format JPG/PNG/JPEG</p>

                    <!-- Preview akan muncul di sini -->
                    <div id="preview-container" class="mt-4 grid grid-cols-2 gap-3"></div>
                </div>


                <div class="mt-1 flex justify-end">
                    <button type="submit"
                        class="px-4 py-2 bg-primary text-white text-sm font-medium rounded-md hover:bg-primary/90">
                        Simpan Gambar
                    </button>
                </div>
            </form>

        </div>
    </div>
    <script>
        function previewImages(event) {
            const container = document.getElementById('preview-container');
            const files = event.target.files;

            // Ambil jumlah preview yang sudah ada
            const existingCount = container.querySelectorAll('img').length;

            if ((existingCount + files.length) > 6) {
                alert('Maksimal hanya 4 gambar yang diperbolehkan.');
                return;
            }

            Array.from(files).forEach(file => {
                if (!file.type.startsWith('image/')) return;

                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.className = "w-full h-32 object-cover rounded-md shadow-sm";
                    container.appendChild(img);
                };
                reader.readAsDataURL(file);
            });
        }
    </script>
@endsection
