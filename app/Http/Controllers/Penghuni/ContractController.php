<?php

namespace App\Http\Controllers\Penghuni;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ContractController extends Controller
{
    public function store(Request $request)
    {

        $validated = $request->validate([
            'start_date' => 'required|date',
            'deposit_amount' => 'required',
            'room_id'    => 'required|exists:rooms,room_id',
            'owner_id'    => 'required|exists:rooms,owner_id',
        ]);

        // Hitung tanggal berakhir: 1 bulan setelah start_date
        $endDate = Carbon::parse($validated['start_date'])->addMonth(); // 17‑12‑2025 ➔ 17‑01‑2026

        Contract::create([
            'contract_id'          => Str::uuid(),
            'user_id'              => Auth::user()->user_id,      
            'verification_contract' => 'pending',
            'deposit_status'       => 'pending',
            'deposit_amount'       => $validated['deposit_amount'],
            'start_date'           => $validated['start_date'],
            'end_date'             => $endDate,         
            'owner_id'             => $validated['owner_id'],
            'room_id'              => $validated['room_id'],
        ]);

        notyf()->success('Ajukan Sewa Berhasil, Silahkan Tunggu Verifikasi Pemilik Kos');
        return redirect()->route('user.penghuni.profile');
    }
}
