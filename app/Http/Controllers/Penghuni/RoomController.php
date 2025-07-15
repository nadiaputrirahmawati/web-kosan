<?php

namespace App\Http\Controllers\penghuni;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class RoomController extends Controller
{
    public function index()
    {
        $data = Contract::with(['room.owner', 'payment'])
            ->where('user_id', Auth::id())
            ->whereHas('payment', fn($q) => $q->where('status', 'completed'))
            ->latest()
            ->first();                    // 🔄 jadi single model, bukan collection

        if (!$data) {
            return view('user.room.index')->with('message', 'Belum ada kontrak aktif');
        }

        $checkInUrl = route('user.contract.checkin', $data->contract_id);
        $qrCode     = QrCode::size(100)->generate($checkInUrl);

        return view('user.room.index', compact('data', 'qrCode'));
    }

    public function checkin($id)
    {
        $contract = Contract::where('contract_id', $id)->firstOrFail();

        // Update status checkin (buat kolom checkin_time di tabel contracts ya)
        $contract->status = 'active';
        $contract->save();

        return view('user.room.checkin', compact('contract'));
    }
}
