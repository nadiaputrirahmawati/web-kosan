@extends('layout.Pemilik')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-3xl font-semibold text-primary mb-6">Update Keluhan: {{ $complaint->title }}</h1>

    <div class="bg-quinary rounded-lg shadow-lg p-6">
        <div class="mb-4">
            <p><strong class="text-secondary">Penghuni:</strong> {{ $complaint->user->name }}</p>
            <p><strong class="text-secondary">Kamar:</strong> {{ $complaint->room->name }}</p>
            <p><strong class="text-secondary">Tanggal:</strong> {{ $complaint->created_at->format('d M Y H:i') }}</p>
            <p><strong class="text-secondary">Deskripsi:</strong><br>{{ $complaint->description }}</p>
        </div>

        <form action="{{ route('owner.complaints.update', $complaint->complaint_id) }}" method="POST">
            @csrf @method('PUT')
            <div class="mb-4">
                <label class="block text-secondary mb-1">Status</label>
                <select name="status" class="w-full px-4 py-2 border rounded-md bg-quinary focus:ring-2 focus:ring-primary">
                    <option value="in_process" @selected($complaint->status=='in_process')>Diproses</option>
                    <option value="completed" @selected($complaint->status=='completed')>Selesai</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-secondary mb-1">Keterangan (opsional)</label>
                <textarea name="complaint_feedback" rows="3" class="w-full px-4 py-2 border rounded-md bg-quinary focus:ring-2 focus:ring-primary">{{ old('note', $complaint->note) }}</textarea>
            </div>

            <button type="submit" class="bg-primary text-quinary px-6 py-2 rounded-md hover:bg-secondary transition duration-300">
                Simpan Perubahan
            </button>
        </form>
    </div>
</div>
@endsection
