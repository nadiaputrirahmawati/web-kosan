@extends('layout.pemilik')

@section('content')
    <h1 class="text-sm font-medium">
        <a href="{{ route('rooms.index') }}">Room /</a>
        <span class="font-bold">Edit Kamar</span>
    </h1>
    <h1 class="text-primary font-extrabold text-xl mb-4">Edit Kamar Kosan</h1>

    <div class="bg-white shadow-sm rounded-xl p-6">
        @if ($errors->any())
            <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                <strong>Oops!</strong> Ada error pada form:
                <ul class="mt-2 list-disc list-inside text-sm text-red-600">
                    @foreach ($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('rooms.update', $room->room_id) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')

            {{-- Nama Kamar --}}
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700">Nama Kamar *</label>
                <div
                    class="flex items-center border border-gray-300 rounded-lg px-3 py-2 bg-white mt-2 focus-within:border-gray-800 focus-within:ring-1 focus-within:ring-gray-800">
                    <i class="fa-light fa-house mr-2"></i>
                    <input name="name" placeholder="Contoh: Kamar A1" value="{{ old('name', $room->name) }}" required
                        class="w-full outline-none text-sm" />
                </div>
            </div>

            {{-- Harga & Jumlah --}}
            <div class="flex gap-4 mb-4">
                <div class="w-1/2">
                    <label class="block text-sm font-semibold text-gray-700">Harga *</label>
                    <div
                        class="flex items-center border border-gray-300 rounded-lg px-3 py-2 bg-white mt-2 focus-within:border-gray-800 focus-within:ring-1 focus-within:ring-gray-800">
                        <i class="fa-light fa-money-bill-wave mr-2"></i>
                        <input type="number" name="price" value="{{ old('price', $room->price) }}" placeholder="300000"
                            required class="w-full outline-none text-sm" />
                    </div>
                </div>
                <div class="w-1/2">
                    <label class="block text-sm font-semibold text-gray-700">Jumlah Kamar *</label>
                    <div
                        class="flex items-center border border-gray-300 rounded-lg px-3 py-2 bg-white mt-2 focus-within:border-gray-800 focus-within:ring-1 focus-within:ring-gray-800">
                        <i class="fa-light fa-door-open mr-2"></i>
                        <input type="number" name="total_rooms" value="{{ old('total_rooms', $room->total_rooms) }}"
                            required placeholder="1" class="w-full outline-none text-sm" />
                    </div>
                </div>
            </div>

            {{-- Tipe & Deposit --}}
            <div class="flex lg:flex-row flex-col gap-4 mb-4">
                <div class="lg:w-6/12 w-full">
                    <label class="block text-sm font-semibold text-gray-700">Tipe Kamar *</label>
                    <select name="type" required
                        class="block w-full rounded-lg border border-gray-300 px-3 py-2 bg-white text-sm focus:border-gray-800 focus:ring-1 focus:ring-gray-800 mt-2">
                        <option value="">-- Pilih Tipe --</option>
                        @foreach (['campur', 'putri', 'putra'] as $type)
                            <option value="{{ $type }}" {{ old('type', $room->type) == $type ? 'selected' : '' }}>
                                {{ ucfirst($type) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="lg:w-6/12 w-full">
                    <label class="block text-sm font-semibold text-gray-700">Jaminan (Rp)</label>
                    <div
                        class="flex items-center border border-gray-300 rounded-lg px-3 py-2 bg-white mt-2 focus-within:border-gray-800 focus-within:ring-1 focus-within:ring-gray-800">
                        <i class="fa-light fa-wallet mr-2"></i>
                        <input type="number" name="deposit_amount"
                            value="{{ old('deposit_amount', $room->deposit_amount) }}" placeholder="500000"
                            class="w-full outline-none text-sm" />
                    </div>
                </div>
            </div>

            {{-- Fasilitas Kamar --}}
            {{-- Fasilitas Kamar --}}
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700">Fasilitas Kamar</label>
                <div id="room-facility-fields">
                    @foreach (old('room_facility', $room->room_facility ?? ['']) as $fac)
                        <div class="facility-row flex items-center border rounded-lg px-3 py-2 bg-white mt-2">
                            <i class="fa-light fa-bed mr-2"></i>
                            <input type="text" name="room_facility[]" value="{{ $fac }}"
                                placeholder="Contoh: AC" class="w-full outline-none text-sm" />
                            <button type="button" class="remove-facility ml-2 text-red-500 hover:text-red-700"><i class="fa-regular fa-xmark"></i></button>
                        </div>
                    @endforeach
                </div>
                <button type="button" onclick="addRoomFacility()"
                    class="mt-2 bg-primary px-4 py-2 text-white rounded-lg text-sm">
                    + Tambah Fasilitas
                </button>
            </div>

            {{-- Fasilitas Umum --}}
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700">Fasilitas Umum</label>
                <div id="public-facility-fields">
                    @foreach (old('public_facility', $room->public_facility ?? ['']) as $fac)
                        <div class="public-row flex items-center border rounded-lg px-3 py-2 bg-white mt-2">
                            <i class="fa-light fa-building mr-2"></i>
                            <input type="text" name="public_facility[]" value="{{ $fac }}"
                                placeholder="Contoh: Parkiran" class="w-full outline-none text-sm" />
                            <button type="button" class="remove-public ml-2 text-red-500 hover:text-red-700"><i class="fa-regular fa-xmark"></i></button>
                        </div>
                    @endforeach
                </div>
                <button type="button" onclick="addPublicFacility()"
                    class="mt-2 bg-primary px-4 py-2 text-white rounded-lg text-sm">
                    + Tambah Fasilitas Umum
                </button>
            </div>

            {{-- Aturan Kos --}}
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700">Aturan Kos</label>
                <div id="regulation-fields">
                    @foreach (old('regulation', $room->regulation ?? ['']) as $reg)
                        <div class="regulation-row flex items-center border rounded-lg px-3 py-2 bg-white mt-2">
                            <i class="fa-light fa-ban-smoking mr-2"></i>
                            <input type="text" name="regulation[]" value="{{ $reg }}"
                                placeholder="Contoh: Tidak merokok" class="w-full outline-none text-sm" />
                            <button type="button"
                                class="remove-regulation ml-2 text-red-500 hover:text-red-700"><i class="fa-regular fa-xmark"></i></button>
                        </div>
                    @endforeach
                </div>
                <button type="button" onclick="addRegulation()"
                    class="mt-2 bg-primary px-4 py-2 text-white rounded-lg text-sm">
                    + Tambah Aturan
                </button>
            </div>

            {{-- Deskripsi --}}
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700">Deskripsi</label>
                <textarea name="description" rows="3"
                    class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:border-gray-800 focus:ring-1 focus:ring-gray-800">{{ old('description', $room->description) }}</textarea>
            </div>

            {{-- Alamat --}}
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700">Alamat *</label>
                <textarea name="address" required rows="2"
                    class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:border-gray-800 focus:ring-1 focus:ring-gray-800">{{ old('address', $room->address) }}</textarea>
            </div>
            {{-- Submit --}}
            <div class="mt-4">
                <button type="submit"
                    class="bg-primary text-white px-4 py-2 rounded-md font-bold hover:bg-primary/90">Simpan
                    Perubahan</button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('click', function(e) {
            if (e.target.matches('.remove-facility')) {
                e.target.closest('.facility-row').remove();
            }
            if (e.target.matches('.remove-public')) {
                e.target.closest('.public-row').remove();
            }
            if (e.target.matches('.remove-regulation')) {
                e.target.closest('.regulation-row').remove();
            }
        });

        function addRoomFacility() {
            const c = document.getElementById('room-facility-fields');
            const div = document.createElement('div');
            div.className = 'facility-row flex items-center border rounded-lg px-3 py-2 bg-white mt-2';
            div.innerHTML = `
    <i class="fa-light fa-bed mr-2"></i>
    <input type="text" name="room_facility[]" placeholder="Contoh: Lemari" class="w-full outline-none text-sm" />
    <button type="button" class="remove-facility ml-2 text-red-500 hover:text-red-700">✖️</button>
  `;
            c.appendChild(div);
        }

        function addPublicFacility() {
            const c = document.getElementById('public-facility-fields');
            const div = document.createElement('div');
            div.className = 'public-row flex items-center border rounded-lg px-3 py-2 bg-white mt-2';
            div.innerHTML = `
    <i class="fa-light fa-building mr-2"></i>
    <input type="text" name="public_facility[]" placeholder="Contoh: Parkiran" class="w-full outline-none text-sm" />
    <button type="button" class="remove-public ml-2 text-red-500 hover:text-red-700">✖️</button>
  `;
            c.appendChild(div);
        }

        function addRegulation() {
            const c = document.getElementById('regulation-fields');
            const div = document.createElement('div');
            div.className = 'regulation-row flex items-center border rounded-lg px-3 py-2 bg-white mt-2';
            div.innerHTML = `
    <i class="fa-light fa-ban-smoking mr-2"></i>
    <input type="text" name="regulation[]" placeholder="Contoh: Tidak merokok" class="w-full outline-none text-sm" />
    <button type="button" class="remove-regulation ml-2 text-red-500 hover:text-red-700">✖️</button>
  `;
            c.appendChild(div);
        }
    </script>
@endsection
