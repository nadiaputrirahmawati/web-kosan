@extends('layout.pemilik')

@section('content')
    <h1 class="text-sm font-medium"><a href="/owner/room">Room /</a> <span class="font-bold"> Tambah Kamar</span></h1>
    <h1 class="text-primary font-extrabold text-xl mb-4">Tambah Kamar Kosan</h1>

    <div class="bg-white shadow-sm rounded-xl p-6">
        <form action="{{ route('rooms.store') }}" method="POST">
            @csrf

            {{-- Nama Kamar --}}
            <div class="mb-4">
                <label for="name" class="block text-sm font-semibold text-gray-700">Nama Kamar *</label>
                <div
                    class="flex items-center border border-gray-300 rounded-lg px-3 py-2 bg-white mt-2 
                        focus-within:border-gray-800 focus-within:ring-1 focus-within:ring-gray-800 transition-colors duration-200">
                    <i class="fa-light fa-house mr-2"></i>
                    <input type="text" name="name" id="name" placeholder="Contoh: Kamar A1" required
                        class="w-full outline-none text-sm" />
                </div>
            </div>

            {{-- Harga & Jumlah --}}
            <div class="flex gap-4 mb-4">
                <div class="w-1/2">
                    <label for="price" class="block text-sm font-semibold text-gray-700">Harga *</label>
                    <div
                        class="flex items-center border border-gray-300 rounded-lg px-3 py-2 bg-white mt-2 
                            focus-within:border-gray-800 focus-within:ring-1 focus-within:ring-gray-800 transition-colors duration-200">
                        <i class="fa-light fa-money-bill-wave mr-2"></i>
                        <input type="number" name="price" id="price" placeholder="300000" required
                            class="w-full outline-none text-sm" />
                    </div>
                </div>
                <div class="w-1/2">
                    <label for="quantity" class="block text-sm font-semibold text-gray-700">Jumlah Kamar *</label>
                    <div
                        class="flex items-center border border-gray-300 rounded-lg px-3 py-2 bg-white mt-2 
                            focus-within:border-gray-800 focus-within:ring-1 focus-within:ring-gray-800 transition-colors duration-200">
                        <i class="fa-light fa-door-open mr-2"></i>
                        <input type="number" name="quantity" id="quantity" required placeholder="1"
                            class="w-full outline-none text-sm" />
                    </div>
                </div>
            </div>

            {{-- Status, Type, Deposit --}}
            <div class="flex lg:flex-row flex-col gap-4 mb-4">
                <div class="lg:w-4/12 w-full">
                    <label class="block text-sm font-semibold text-gray-700">Status *</label>
                    <div class="mt-2">
                        <select name="status" required
                            class="block w-full rounded-lg border border-gray-300 px-3 py-2 bg-white text-sm 
                               focus:border-gray-800 focus:ring-1 focus:ring-gray-800">
                            <option value="">-- Pilih Status --</option>
                            <option value="kosong">Kosong</option>
                            <option value="terisi">Terisi</option>
                            <option value="booking">Booking</option>
                        </select>
                    </div>
                </div>
                <div class="lg:w-4/12 w-full">
                    <label class="block text-sm font-semibold text-gray-700">Tipe Kamar *</label>
                    <div class="mt-2">
                        <select name="type" required
                            class="block w-full rounded-lg border border-gray-300 px-3 py-2 bg-white text-sm 
                               focus:border-gray-800 focus:ring-1 focus:ring-gray-800">
                            <option value="">-- Pilih Tipe --</option>
                            <option value="campur">Campur</option>
                            <option value="putri">Putri</option>
                            <option value="putra">Putra</option>
                        </select>
                    </div>
                </div>
                <div class="lg:w-4/12 w-full">
                    <label for="deposit_amount" class="block text-sm font-semibold text-gray-700">Jaminan (Rp)</label>
                    <div
                        class="flex items-center border border-gray-300 rounded-lg px-3 py-2 bg-white mt-2 
                            focus-within:border-gray-800 focus-within:ring-1 focus-within:ring-gray-800 transition-colors duration-200">
                        <i class="fa-light fa-wallet mr-2"></i>
                        <input type="number" name="deposit_amount" id="deposit_amount" placeholder="500000"
                            class="w-full outline-none text-sm" />
                    </div>
                </div>
            </div>

            {{-- Fasilitas Kamar --}}
            <div class="mb-4 flex lg:flex-row flex-col lg:space-x-3 space-x-0 w-full">
                <div class="lg:w-9/12 w-full">
                    <label class="block text-sm font-semibold text-gray-700">Fasilitas Kamar</label>
                    <div id="room-facility-fields" class="mt-2">
                        <div
                            class="flex items-center border border-gray-300 rounded-lg px-3 py-2 bg-white 
                        focus-within:border-gray-800 focus-within:ring-1 focus-within:ring-gray-800 transition-colors duration-200 mb-2">
                            <i class="fa-light fa-bed mr-2"></i>
                            <input type="text" name="room_facility[]" placeholder="Contoh: AC"
                                class="w-full outline-none text-sm" />
                        </div>
                    </div>
                </div>
                <div class="lg:w-3/12 w-full lg:mt-7 mt-1">
                    <button type="button" onclick="addRoomFacility()"
                        class="bg-primary px-9 rounded-lg py-2 text-white text-sm hover:bg-primary/90 transition">
                        + Tambah Fasilitas
                    </button>
                </div>
            </div>

            {{-- Fasilitas Umum --}}
            <div class="mb-4 flex lg:flex-row flex-col lg:space-x-3 space-x-0 w-full">
                <div class="lg:w-9/12 w-full">
                    <label class="block text-sm font-semibold text-gray-700">Fasilitas Umum</label>
                    <div id="public-facility-fields" class="mt-2">
                        <div
                            class="flex items-center border border-gray-300 rounded-lg px-3 py-2 bg-white 
                        focus-within:border-gray-800 focus-within:ring-1 focus-within:ring-gray-800 transition-colors duration-200 mb-2">
                            <i class="fa-light fa-building mr-2"></i>
                            <input type="text" name="public_facility[]" placeholder="Contoh: Parkiran Motor"
                                class="w-full outline-none text-sm" />
                        </div>
                    </div>
                </div>
                <div class="lg:w-3/12 w-full lg:mt-7 mt-1">
                    <button type="button" onclick="addPublicFacility()"
                        class="bg-primary px-10 rounded-lg py-2 text-white text-sm hover:bg-primary/90 transition">
                        + Tambah Umum
                    </button>
                </div>
            </div>

            {{-- Aturan Kos --}}
            <div class="mb-4 flex lg:flex-row flex-col lg:space-x-3  space-x-0 w-full">
                <div class="lg:w-9/12 w-full">
                    <label class="block text-sm font-semibold text-gray-700">Aturan Kos</label>
                    <div id="regulation-fields" class="mt-2">
                        <div
                            class="flex items-center border border-gray-300 rounded-lg px-3 py-2 
                        focus-within:border-gray-800 focus-within:ring-1 focus-within:ring-gray-800 transition-colors duration-200 mb-2">
                            <i class="fa-light fa-ban-smoking mr-2"></i>
                            <input type="text" name="regulation[]" placeholder="Contoh: Tidak boleh merokok"
                                class="w-full outline-none text-sm bg-none" />
                        </div>
                    </div>
                </div>
                <div class="lg:w-3/12 lg:mt-7 mt-0 w-full">
                    <button type="button" onclick="addRegulation()"
                        class="bg-primary px-10 rounded-lg py-2 text-white text-sm hover:bg-primary/90 transition">
                        + Tambah Aturan
                    </button>
                </div>
            </div>


            {{-- Deskripsi --}}
            <div class="mb-3">
                <label class="block text-sm font-semibold text-gray-700">Deskripsi</label>
                <textarea name="description" rows="3"
                    class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:border-gray-800 focus:ring-1 focus:ring-gray-800"></textarea>
            </div>

            {{-- Alamat --}}
            <div class="mb-3">
                <label class="block text-sm font-semibold text-gray-700">Alamat *</label>
                <textarea name="address" required rows="2"
                    class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:border-gray-800 focus:ring-1 focus:ring-gray-800"></textarea>
            </div>

            {{-- Tombol Simpan --}}
            <div class="mt-3">
                <button type="submit"
                    class="px-4 py-2 bg-primary text-white text-sm font-bold rounded-md hover:bg-primary">
                   Lanjut
                </button>
            </div>
        </form>
    </div>

    {{-- Script Input Dinamis --}}
    <script>
        function addRegulation() {
            const container = document.getElementById('regulation-fields');
            const input = document.createElement('input');
            input.type = 'text';
            input.name = 'regulation[]';
            input.placeholder = 'Tulis aturan baru';
            input.className =
                'w-full rounded-md border border-gray-300 px-3 py-2 mb-2 text-sm focus:border-gray-800 focus:ring-1 focus:ring-gray-800';
            container.appendChild(input);
        }

        function addRoomFacility() {
            const container = document.getElementById('room-facility-fields');
            const input = document.createElement('input');
            input.type = 'text';
            input.name = 'room_facility[]';
            input.placeholder = 'Contoh: Lemari';
            input.className =
                'w-full rounded-md border border-gray-300 px-3 py-2 mb-2 text-sm focus:border-gray-800 focus:ring-1 focus:ring-gray-800';
            container.appendChild(input);
        }

        function addPublicFacility() {
            const container = document.getElementById('public-facility-fields');
            const input = document.createElement('input');
            input.type = 'text';
            input.name = 'public_facility[]';
            input.placeholder = 'Contoh: Parkiran Motor';
            input.className =
                'w-full rounded-md border border-gray-300 px-3 py-2 mb-2 text-sm focus:border-gray-800 focus:ring-1 focus:ring-gray-800';
            container.appendChild(input);
        }
    </script>
@endsection
