@extends('layout.pemilik')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-xl font-semibold text-primary mb-6">Daftar Keluhan Penghuni</h1>

    <div class=" rounded-lg shadow-lg">
        @if(session('success'))
            <div class="bg-green-500 text-quinary p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if($complaints->isEmpty())
            <p class="text-gray-500">Belum ada keluhan masuk.</p>
        @else
            <table class="w-full table-auto border-collapse">
                <thead class="bg-primary text-quinary">
                    <tr>
                        <th class="px-4 py-2 text-left">Tanggal</th>
                        <th class="px-4 py-2 text-left">Penghuni</th>
                        <th class="px-4 py-2 text-left">Kamar</th>
                        <th class="px-4 py-2 text-left">Judul</th>
                        <th class="px-4 py-2 text-left">Status</th>
                        <th class="px-4 py-2 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($complaints as $c)
                    <tr class="border-t border-gray-200">
                        <td class="px-4 py-2">{{ $c->created_at->format('d M Y') }}</td>
                        <td class="px-4 py-2">{{ $c->user->name }}</td>
                        <td class="px-4 py-2">{{ $c->room->name }}</td>
                        <td class="px-4 py-2">{{ substr($c->description, 0, 50) }}</td>
                        <td class="px-2 py-2 text-sm">
                            <span class="px-2 py-1 rounded-md text-quinary
                                @if($c->status=='sent') bg-yellow-500
                                @elseif($c->status=='in_process') bg-blue-500
                                @else bg-green-500 @endif">
                                {{ ucfirst(str_replace('_', ' ', $c->status)) }}
                            </span>
                        </td>
                        <td class="px-4 py-2">
                            <a href="{{ route('owner.complaints.edit', $c->complaint_id) }}" class="text-primary hover:text-secondary">Lihat</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
@endsection
