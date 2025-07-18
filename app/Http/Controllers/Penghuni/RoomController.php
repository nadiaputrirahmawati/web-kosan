<?php

namespace App\Http\Controllers\Penghuni;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class RoomController extends Controller
{
    public function index()
    {
        $room = Contract::with(['room.owner', 'payment'])
            ->where('user_id', Auth::id())
            ->orderByDesc('start_date')->latest()
            ->get();
        $kontrak = Contract::where('user_id', Auth::id())
                // ->where('room_id', $room->room_id)
                ->where('contract_type', 'initial')
                // ->where('start_date', '>', $room->end_date)
                // ->whereHas('payment', fn($q) => $q->where('status', 'completed'))
                ->exists();

        return view('user.room.index', compact('room', 'kontrak'));
    }


    public function show($id)
    {
        $room = Contract::with(['room.owner', 'payment'])
            ->where('contract_id', $id)
            ->latest()
            ->first();
        // dd($room);
        if (!$room) {
            return view('user.room.index')->with('message', 'Belum ada kontrak aktif');
        }

        $checkInUrl = route('contract.checkin', $room->contract_id);
        $qrCode     = QrCode::size(100)->generate($checkInUrl);
        return view('user.room.show', compact('room', 'qrCode'));
    }

    public function checkin($id)
    {
        $contract = Contract::where('contract_id', $id)->firstOrFail();

        // Update status checkin (buat kolom checkin_time di tabel contracts ya)
        $contract->status = 'active';
        $contract->save();

        return view('user.room.checkin', compact('contract'));
    }

    public function downloadPDF(Contract $contract)
    {
        $contract->load(['user', 'room']);
        $checkInUrl = route('contract.checkin', $contract->contract_id);

        $svg = QrCode::format('svg')->size(100)->generate($checkInUrl);
        $qrCodeBase64 = 'data:image/svg+xml;base64,' . base64_encode($svg);

        return \Barryvdh\DomPDF\Facade\Pdf::loadView('user.surat_perjanjian_pdf', compact('contract', 'qrCodeBase64'))
            ->stream('surat_perjanjian_kost.pdf');
    }
}
