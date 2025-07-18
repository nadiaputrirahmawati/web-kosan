@extends('layout.Penghuni')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-lg font-semibold text-primary mb-6">Ajukan Keluhan</h1>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-4 mb-4 rounded-md">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-quinary p-6 rounded-md shadow-md">
        <form action="{{ route('user.complaints.store') }}" method="POST">
            @csrf

            <input type="hidden" name="room_id" value="{{ $rooms->room_id }}">
            <div class="mb-4">
                <label for="room_id" class="block text-secondary font-semibold mb-2">Kamar</label>
                <h1>{{ $rooms->name }}</h1>
            </div>

            <div class="mb-4">
                <label for="description" class="block text-secondary font-semibold mb-2">Deskripsi Keluhan</label>
                <textarea name="description" id="description" rows="4" class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-primary" required></textarea>
            </div>

            <button type="submit" class="bg-primary text-quinary px-6 py-2 rounded-md hover:bg-primary/80 transition-all duration-300">
                Kirim Keluhan
            </button>
        </form>
    </div>
</div>
@endsection
