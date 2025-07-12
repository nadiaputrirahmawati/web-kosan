@extends('layout.penghuni')
@section('content')
    <div>
        <div class="mb-4">
            <label for="full_name" class="block text-sm font-medium text-gray-700 mb-1">Enter Full Name</label>
            <div class="flex items-center border border-gray-300 rounded-lg px-3 py-2 bg-white">
                <i class="fas fa-user text-green-500 mr-2"></i>
                <input type="text" name="full_name" id="full_name" value="{{ old('full_name', 'Brian') }}"
                    class="w-full outline-none text-sm" placeholder="Enter Full Name">
            </div>
        </div>

    </div>
@endsection
