@extends('layout.Penghuni')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-xl font-semibold text-primary">Riwayat Keluhan</h1>
        <a href="{{ route('user.complaints.create') }}" class="bg-primary text-quinary px-4 py-1 rounded-md hover:bg-primary/80 transition-all duration-300">
            + Ajukan Keluhan
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if($complaints->isEmpty())
        <p class="text-gray-500">Belum ada keluhan yang diajukan.</p>
    @else
        <div class="overflow-x-auto bg-quinary rounded-md shadow-md">
            <table class="min-w-full text-left">
                <thead class="bg-primary text-quinary">
                    <tr>
                        <th class="px-4 py-3">Tanggal</th>
                        <th class="px-4 py-3">Kamar</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-sm text-gray-700">
                    @foreach($complaints as $complaint)
                        <tr class="border-b border-gray-200">
                            <td class="px-4 py-3">{{ $complaint->created_at->format('d M Y') }}</td>
                            <td class="px-4 py-3">{{ $complaint->room->name }}</td>
                            <td class="px-4 py-3">
                                <span class="px-2 py-1 rounded-md text-quinary text-sm
                                    @if($complaint->status == 'sent_in') bg-yellow-500
                                    @elseif($complaint->status == 'in_process') bg-blue-500
                                    @else bg-green-600 @endif">
                                    {{ ucfirst(str_replace('_', ' ', $complaint->status)) }}
                                </span>
                            </td>
                            <td class="px-4 py-3">
                                <button onclick="toggleDetail('detail-{{ $complaint->complaint_id }}')" class="text-primary hover:underline">
                                    Detail
                                </button>
                            </td>
                        </tr>
                        <tr id="detail-{{ $complaint->complaint_id }}" class="hidden bg-base">
                            <td colspan="5" class="px-6 py-4 text-sm text-gray-800">
                                <strong>Keluhan:</strong> {{ $complaint->description }}
                                @if($complaint->complaint_feedback)
                                    <br><strong>Catatan Penanganan:</strong> {{ $complaint->complaint_feedback }}
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>

<script>
    function toggleDetail(id) {
        const row = document.getElementById(id);
        if (row.classList.contains('hidden')) {
            row.classList.remove('hidden');
        } else {
            row.classList.add('hidden');
        }
    }
</script>
@endsection
