@extends('layout.Landingpage')
@section('content')
    <div class="p-6 w-full">
        <h1 class="text-lg font-medium"><a href="/user/room/{{ $room->first()->room_id }}/show">Detail Kost/</a> <span class="font-bold"> Gallery Kost</span></h1>
        <h1 class="text-primary font-extrabold text-2xl mb-4 text-center">Gallery Kost</h1>

        <div class="grid grid-cols-3 gap-4">
            @foreach ($room as $gallery)
                <img src="{{ asset('storage/' . $gallery->image_url) }}" class="w-full object-cover" alt="">
            @endforeach
        </div>
    </div>
@endsection
