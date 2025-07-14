@extends('layout.Penghuni')
@section('content')
    <h1 class="text-primary font-extrabold text-xl mb-4">Informasi Pribadi</h1>
    @if ($errors->any())
        <div class="mb-4">
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Oops!</strong>
                <span class="block sm:inline">Ada beberapa kesalahan dalam pengisian form:</span>
                <ul class="mt-2 list-disc list-inside text-sm text-red-600">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        {{-- Foto Profil --}}
        <div class="flex w-full justify-between items-center mb-6">
            <div class="w-4/12">
                <label for="profile_picture" class="text-sm font-semibold text-gray-700 block mb-2">Profile Penghuni
                    Kamar</label>
            </div>

            <div class="w-2/12 flex">
                <div class="w-20 h-20 rounded-full overflow-hidden bg-gray-200 shadow-md">
                    <img id="preview-profile"
                        src="{{ asset('storage/' . Auth::user()->profile_picture) ??'https://via.placeholder.com/150x100' }}"
                        alt="Preview" class="w-full h-full object-cover">
                </div>
            </div>

            <div class="w-4/12 flex pl-6">
                <input type="file" name="profile_picture" id="upload-profile" accept="image/*"
                    onchange="previewImage(event, 'preview-profile')" class="hidden">

                <label for="upload-profile"
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

        {{-- Nama --}}
        <div class="flex w-full mb-4">
            <div class="w-4/12 mt-2">
                <label for="name" class="text-sm font-semibold text-gray-700">Nama Penghuni Kamar</label>
            </div>
            <div
                class="flex items-center border border-gray-300 rounded-lg px-3 py-2 w-8/12 bg-white mt-2 
                focus-within:border-gray-800 focus-within:ring-1 focus-within:ring-gray-800 transition-colors duration-200">
                <i class="fa-light fa-house mr-2"></i>
                <input type="text" name="name" id="name" placeholder="Contoh: Kamar A1" 
                    class="w-full outline-none text-sm" value="{{ Auth::user()->name }}" />
            </div>
        </div>

        {{-- Email --}}
        <div class="flex w-full mb-4">
            <div class="w-4/12 mt-2">
                <label for="email" class="text-sm font-semibold text-gray-700">Email</label>
            </div>
            <div
                class="flex items-center border border-gray-300 rounded-lg px-3 py-2 w-8/12 bg-white mt-2 
                focus-within:border-gray-800 focus-within:ring-1 focus-within:ring-gray-800 transition-colors duration-200">
                <i class="fa-light fa-envelope mr-2"></i>
                <input type="email" name="email" id="email" placeholder="contoh@email.com" 
                    class="w-full outline-none text-sm" value="{{ Auth::user()->email }}" />
            </div>
        </div>

        {{-- No KTP --}}
        <div class="flex w-full mb-4">
            <div class="w-4/12 mt-2">
                <label for="no_ktp" class="text-sm font-semibold text-gray-700">No. KTP</label>
            </div>
            <div
                class="flex items-center border border-gray-300 rounded-lg px-3 py-2 w-8/12 bg-white mt-2 
                focus-within:border-gray-800 focus-within:ring-1 focus-within:ring-gray-800 transition-colors duration-200">
                <i class="fa-light fa-id-card mr-2"></i>
                <input type="text" name="no_ktp" id="no_ktp" placeholder="327xxxxxxxxxxxx" 
                    class="w-full outline-none text-sm" value="{{ Auth::user()->no_ktp }}"/>
            </div>
        </div>

        {{-- Jenis Kelamin --}}
        <div class="flex w-full mb-4">
            <div class="w-4/12 mt-2">
                <label for="gender" class="text-sm font-semibold text-gray-700">Jenis Kelamin</label>
            </div>
            <div class="w-8/12 mt-2">
                <select name="gender" id="gender" 
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:border-gray-800 focus:ring-1 focus:ring-gray-800 outline-none">
                    <option value="">Pilih Jenis Kelamin</option>
                    <option value="L">Laki-laki</option>
                    <option value="P">Perempuan</option>
                </select>
            </div>
        </div>

        {{-- Tanggal Lahir --}}
        <div class="flex w-full mb-4">
            <div class="w-4/12 mt-2">
                <label for="tgl_lahir" class="text-sm font-semibold text-gray-700">Tanggal Lahir</label>
            </div>
            <div class="w-8/12 mt-2">
                <input type="date" name="tgl_lahir" id="tgl_lahir" 
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:border-gray-800 focus:ring-1 focus:ring-gray-800 outline-none" value="{{ Auth::user()->tgl_lahir }}" />
            </div>
        </div>

        {{-- Alamat --}}
        <div class="flex w-full mb-4">
            <div class="w-4/12 mt-2">
                <label for="address" class="text-sm font-semibold text-gray-700">Alamat</label>
            </div>
            <div class="w-8/12 mt-2">
                <textarea name="address" id="address" rows="3" 
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:border-gray-800 focus:ring-1 focus:ring-gray-800 outline-none"
                    placeholder="Masukkan alamat lengkap"> {{ Auth::user()->address }}</textarea>
            </div>
        </div>

        {{-- Status --}}
        <div class="flex w-full mb-4">
            <div class="w-4/12 mt-2">
                <label for="status" class="text-sm font-semibold text-gray-700">Status</label>
            </div>
            <div class="w-8/12 mt-2">
                <select name="status" id="status" 
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:border-gray-800 focus:ring-1 focus:ring-gray-800 outline-none">
                    <option value="">Pilih Status</option>
                    <option value="Menikah">Menikah</option>
                    <option value="Belum Menikah">Belum Menikah</option>
                </select>
            </div>
        </div>

        {{-- No HP --}}
        <div class="flex w-full mb-4">
            <div class="w-4/12 mt-2">
                <label for="phone" class="text-sm font-semibold text-gray-700">No. HP</label>
            </div>
            <div
                class="flex items-center border border-gray-300 rounded-lg px-3 py-2 w-8/12 bg-white mt-2 
                focus-within:border-gray-800 focus-within:ring-1 focus-within:ring-gray-800 transition-colors duration-200">
                <i class="fa-light fa-phone mr-2"></i>
                <input type="text" name="phone_number" id="phone" placeholder="08xxxxxxxxxx" 
                    class="w-full outline-none text-sm" value="{{ Auth::user()->phone_number }}"/>
            </div>
        </div>

        {{-- Foto KTP --}}
        <div class="flex w-full justify-between items-center mb-6">
            <div class="w-4/12">
                <label for="ktp_picture" class="text-sm font-semibold text-gray-700 block mb-2">Foto KTP</label>
            </div>
            <div class="w-2/12 flex">
                <div class="w-24 h-16 overflow-hidden bg-gray-200 shadow-md rounded-md">
                    <img id="preview-ktp" src="{{ asset('storage/' . Auth::user()->ktp_picture) ?? 'https://via.placeholder.com/150x100' }}" alt="Preview"
                        class="w-full h-full object-cover">
                </div>
            </div>
            <div class="w-4/12 flex pl-6">
                <input type="file" name="ktp_picture" id="upload-ktp" accept="image/*"
                    onchange="previewImage(event, 'preview-ktp')" class="hidden" >
                <label for="upload-ktp"
                    class="cursor-pointer inline-flex items-center gap-2 bg-black text-white px-7 py-2 rounded-lg hover:bg-gray-900 transition text-sm font-medium shadow">
                    Upload
                </label>
            </div>
        </div>

        {{-- Foto KTP + Diri Sendiri --}}
        <div class="flex w-full justify-between items-center mb-6">
            <div class="w-4/12">
                <label for="ktp_person_picture" class="text-sm font-semibold text-gray-700 block mb-2">Foto Diri +
                    KTP</label>
            </div>
            <div class="w-2/12 flex">
                <div class="w-24 h-16 overflow-hidden bg-gray-200 shadow-md rounded-md">
                    <img id="preview-ktp-person" src="{{ asset('storage/' . Auth::user()->ktp_picture_person) ??'https://via.placeholder.com/150x100' }}" alt="Preview"
                        class="w-full h-full object-cover">
                </div>
            </div>
            <div class="w-4/12 flex pl-6">
                <input type="file" name="ktp_picture_person" id="upload-ktp-person" accept="image/*"
                    onchange="previewImage(event, 'preview-ktp-person')" class="hidden" >
                <label for="upload-ktp-person"
                    class="cursor-pointer inline-flex items-center gap-2 bg-black text-white px-7 py-2 rounded-lg hover:bg-gray-900 transition text-sm font-medium shadow">
                    Upload
                </label>
            </div>
        </div>

        {{-- Submit --}}
        <div class="mt-4">
            <button type="submit" class="px-4 py-2 bg-primary text-white text-sm font-bold rounded-md hover:bg-primary">
                Update Profile
            </button>
        </div>
    </form>

    <script>
        function previewImage(event, id = 'preview-image') {
            const file = event.target.files[0];
            if (!file || !file.type.startsWith('image/')) return;

            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById(id).src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    </script>
@endsection
