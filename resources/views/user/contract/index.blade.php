@extends('layout.Penghuni')

@section('content')
    @foreach ($contracts as $data)
        <h1 class="text-primary font-extrabold text-xl mb-4">Riwayat Kontrak Kost</h1>
        <h1>{{ $data->room->name }}</h1>
        <h1>{{ $data->room->address }}</h1>
        <h1>{{ $data->start_date }} - {{ $data->end_date }}</h1>
        <h1 class="capitalize">{{ $data->verification_contract }}</h1>
    @endforeach
@endsection
