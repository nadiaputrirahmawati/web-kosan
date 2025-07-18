@extends('layout.Pemilik')
@section('content')
    <div class="bg-white rounded-lg shadow-md p-6">
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

        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            {{-- Foto Profil --}}
            {{-- Foto Profil --}}
            <div class="flex w-full justify-between items-center mb-6">
                <div class="w-4/12">
                    <label for="profile_picture" class="text-sm font-semibold text-gray-700 block mb-2">Foto Profil</label>
                </div>

                <div class="w-20 h-20 rounded-full overflow-hidden bg-gray-200 shadow-md relative">
                    {{-- Gambar Preview --}}
                    <img id="preview-profile"
                        src="{{ Auth::user()->profile_picture ? asset('storage/' . Auth::user()->profile_picture) : '' }}"
                        alt="Preview"
                        class="w-full h-full object-cover {{ Auth::user()->profile_picture ? '' : 'hidden' }}">

                    {{-- Icon Default --}}
                    <div id="icon-profile"
                        class="absolute inset-0 flex items-center justify-center text-gray-400 text-4xl {{ Auth::user()->profile_picture ? 'hidden' : '' }}">
                        <i class="fa-solid fa-user"></i>
                    </div>
                </div>


                <div class="w-4/12 flex pl-6">
                    <input type="file" name="profile_picture" id="upload-profile" accept="image/*"
                        onchange="previewImage(event, 'preview-profile', 'icon-profile')" class="hidden">

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
                    <label for="name" class="text-sm font-semibold text-gray-700">Nama Pemilik Kos</label>
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
                        class="w-full outline-none text-sm" value="{{ Auth::user()->no_ktp }}" />
                </div>
            </div>

            {{-- {No Npwp} --}}
            <div class="flex w-full mb-4">
                <div class="w-4/12 mt-2">
                    <label for="npwp" class="text-sm font-semibold text-gray-700">No. NPWP</label>
                </div>
                <div
                    class="flex items-center border border-gray-300 rounded-lg px-3 py-2 w-8/12 bg-white mt-2 
        focus-within:border-gray-800 focus-within:ring-1 focus-within:ring-gray-800 transition-colors duration-200">
                    <i class="fa-light fa-file-invoice-dollar mr-2"></i>
                    <input type="text" name="npwp" id="npwp" placeholder="1245xxxxxxxxxxxx" min="16"
                        class="w-full outline-none text-sm" value="{{ Auth::user()->npwp }}" />
                </div>
            </div>

            <div class="flex w-full mb-4">
                <div class="w-4/12 mt-2">
                    <label for="bank" class="text-sm font-semibold text-gray-700">Bank</label>
                </div>
                <div
                    class="flex items-center border border-gray-300 rounded-lg px-3 py-2 w-8/12 bg-white mt-2 
        focus-within:border-gray-800 focus-within:ring-1 focus-within:ring-gray-800 transition-colors duration-200">
                    <i class="fa-light fa-building-columns mr-2"></i>
                    <input type="text" name="bank" id="bank" placeholder="BCA"
                        class="w-full outline-none text-sm" value="{{ Auth::user()->bank }}" />
                </div>
            </div>

            <div class="flex w-full mb-4">
                <div class="w-4/12 mt-2">
                    <label for="no_rekening" class="text-sm font-semibold text-gray-700">No. Rekening</label>
                </div>
                <div
                    class="flex items-center border border-gray-300 rounded-lg px-3 py-2 w-8/12 bg-white mt-2 
        focus-within:border-gray-800 focus-within:ring-1 focus-within:ring-gray-800 transition-colors duration-200">
                    <i class="fa-light fa-credit-card mr-2"></i>
                    <input type="text" name="no_rekening" id="no_rekening" placeholder="789xxxxxx" min="16"
                        class="w-full outline-none text-sm" value="{{ Auth::user()->no_rekening }}" />
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
                        <option value="L" {{ Auth::user()->gender == 'L' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="P" {{ Auth::user()->gender == 'P' ? 'selected' : '' }}>Perempuan</option>

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
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:border-gray-800 focus:ring-1 focus:ring-gray-800 outline-none"
                        value="{{ Auth::user()->tgl_lahir }}" />
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
                        class="w-full outline-none text-sm" value="{{ Auth::user()->phone_number }}" />
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

            <h1 class="font-bold text-lg mb-4">Verifikasi Identitas</h1>
            <div class="flex space-x-6 w-full">
                <div class="w-4/12">
                    <h1> Upload Foto Identitas</h1>
                </div>
                {{-- Kartu Identitas --}}
                <div
                    class="flex flex-col items-center justify-center w-60 h-40 border-2 border-dashed border-gray-300 rounded-md relative hover:shadow cursor-pointer">
                    <input type="file" name="ktp_picture" id="ktp_picture" accept="image/*" class="hidden"
                        onchange="previewImage(event, 'preview-ktp', 'icon-ktp')">
                    <label for="ktp_picture" class="flex flex-col items-center justify-center h-full w-full">
                        <img id="preview-ktp"
                            src="{{ Auth::user()->ktp_picture ? asset('storage/' . Auth::user()->ktp_picture) : '' }}"
                            class="w-36 h-28  object-cover mb-2 {{ Auth::user()->ktp_picture ? '' : 'hidden' }}">
                        @if (!Auth::user()->ktp_picture)
                            <i id="icon-ktp" class="fa-solid fa-id-card text-green-500 text-3xl mb-2"></i>
                        @endif
                        <span class="text-sm text-green-700 font-semibold">Kartu Identitas</span>
                    </label>
                    @error('ktp_picture')
                        <p class="absolute bottom-[-24px] text-xs text-red-600 mt-1"><i
                                class="fa-solid fa-circle-info mr-1"></i>{{ $message }}</p>
                    @enderror
                </div>

                {{-- Selfie dengan KTP --}}
                <div
                    class="flex flex-col items-center justify-center w-60 h-40 border-2 border-dashed border-gray-300 rounded-md relative hover:shadow cursor-pointer">
                    <input type="file" name="ktp_picture_person" id="ktp_picture_person" accept="image/*"
                        class="hidden" onchange="previewImage(event, 'preview-ktp-person', 'icon-ktp-person')">
                    <label for="ktp_picture_person" class="flex flex-col items-center justify-center h-full w-full">
                        <img id="preview-ktp-person"
                            src="{{ Auth::user()->ktp_picture_person ? asset('storage/' . Auth::user()->ktp_picture_person) : '' }}"
                            class="w-40 h-28 object-cover mb-2 {{ Auth::user()->ktp_picture_person ? '' : 'hidden' }}">
                        @if (!Auth::user()->ktp_picture_person)
                            <i id="icon-ktp-person" class="fa-solid fa-camera text-green-500 text-3xl mb-2"></i>
                        @endif
                        <span class="text-sm text-green-700 font-semibold text-center">Selfie dengan Kartu Identitas</span>
                    </label>
                    @error('ktp_picture_person')
                        <p class="absolute bottom-[-24px] text-xs text-red-600 mt-1"><i
                                class="fa-solid fa-circle-info mr-1"></i>{{ $message }}</p>
                    @enderror
                </div>
            </div>


            {{-- Submit --}}
            <div class="mt-4">
                <button type="submit"
                    class="px-4 py-2 bg-primary text-white text-sm font-bold rounded-md hover:bg-primary">
                    Update Profile
                </button>
            </div>
        </form>
    </div>


    <script>
        function previewImage(event, previewId, iconId) {
            const file = event.target.files[0];
            if (!file || !file.type.startsWith('image/')) return;

            const reader = new FileReader();
            reader.onload = function(e) {
                const output = document.getElementById(previewId);
                const icon = document.getElementById(iconId);
                if (output) {
                    output.src = e.target.result;
                    output.classList.remove('hidden');
                }
                if (icon) {
                    icon.classList.add('hidden');
                }
            };
            reader.readAsDataURL(file);
        }
    </script>






@endsection
