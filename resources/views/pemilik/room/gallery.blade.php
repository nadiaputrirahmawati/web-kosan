@extends('layout.pemilik')
@section('content')
    <h1 class="text-sm font-medium"><a href="/owner/room/{{ $room->room_id }}/show">Kamar /</a> <span class="font-bold"> Tambah
            Kamar</span></h1>
    <h1 class="text-primary font-extrabold text-xl mb-4">Tambah Foto Kamar</h1>
    <div class="flex space-x-3">
        <div class="bg-white shadow-sm rounded-xl p-3 w-98">
            <h1 class="font-bold text-gray-500">Informasi Kamar</h1>
            <h1 class="text-sm font-semibold">{{ $room->name }}</h1>
            <div class="flex flex-col  justify-between">
                <div class="flex mt-3">
                    <div>
                        <i
                            class="fa-light fa-users mr-2 bg-base text-primary lg:px-3 lg:py-2 px-3 py-2 rounded-lg lg:text-sm text-xs"></i>
                    </div>
                    <div>
                        <h1 class="font-bold text-xs capitalize">{{ $room->type }}</h1>
                        <h1 class="text-[11px]">Type Kamar</h1>
                    </div>
                </div>
                <div class="flex mt-3">
                    <div>
                        <i
                            class="fa-light fa-money-bill-wave mr-2 bg-base text-primary lg:px-3 lg:py-2 px-3 py-2 rounded-lg lg:text-sm text-xs"></i>
                    </div>
                    <div>
                        <h1 class="font-bold text-xs">Rp. {{ number_format($room->price, 0, ',', '.') }}</h1>
                        <h1 class="text-[11px]">Harga Kamar</h1>
                    </div>
                </div>
                <div class="flex mt-3">
                    <div>
                        <i
                            class="fa-light fa-door-open mr-2 bg-blue-100 text-blue-900 lg:px-3 lg:py-2 px-3 py-2 rounded-lg lg:text-sm text-xs"></i>
                    </div>
                    <div>
                        <h1 class="font-bold text-xs">{{ $room->quantity }}</h1>
                        <h1 class="text-[11px] font-semibold text-black">Kamar Tersedia</h1>
                    </div>
                </div>
                <div class="flex mt-3">
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
        </div>
        <div class="bg-white shadow-sm rounded-xl p-6 w-6/12">
            <h1 class="text-primary font-extrabold text-xl mb-4">Kirim Gambar</h1>
            <form action="{{ route('rooms.gallery.store', $room->room_id) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700">Upload Gambar Kamar</label>
                    <input type="file" name="images[]" multiple accept="image/*" onchange="previewImages(event)"
                        class="mt-2 block w-full text-sm text-gray-700 border border-gray-300 rounded-lg shadow-sm 
               file:mr-4 file:py-2 file:px-4 file:border-0 
               file:text-sm file:font-semibold file:bg-primary file:text-white hover:file:bg-primary/90"
                        required>
                    <p class="text-xs text-gray-500 mt-1">Maksimal 4 gambar, format JPG/PNG/JPEG</p>

                    <!-- Preview akan muncul di sini -->
                    <div id="preview-container" class="mt-4 grid grid-cols-2 gap-3"></div>
                </div>


                <div class="mt-6">
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
            container.innerHTML = ''; // Clear existing preview

            const files = event.target.files;

            if (files.length > 4) {
                alert('Maksimal hanya 4 gambar yang diperbolehkan.');
                event.target.value = ""; // reset input
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
