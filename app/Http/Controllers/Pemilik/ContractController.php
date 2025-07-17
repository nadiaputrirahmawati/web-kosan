<?php

namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContractController extends Controller
{
    public function index()
    {
        $contracts = Contract::with([
            'user',           // penyewa
            'room.galleries'  // kamar + semua foto galerinya
        ])->whereHas('room', function ($query) {
                $query->where('owner_id', Auth::user()->user_id);
            })
            ->latest()
            ->get();

        return view('pemilik.contract.index', compact('contracts'));
    }

    public function show($id)
    {
        $contract = Contract::with([
            'user',
            'room.galleries'
        ])->whereHas('room', function ($query) {
                $query->where('owner_id', Auth::user()->user_id);
            })
            ->where('user_id', $id)
            ->firstOrFail();
        return view('pemilik.contract.show', compact('contract'));
    }

    public function verifikasi($id)
    {
        $contract = Contract::where('user_id', $id)->firstOrFail();
        $contract->update([
            'verification_contract' => 'completed'
        ]);
        notyf()->success('Verifikasi Berhasil');
        return redirect()->route('rooms.contract.index');
    }

    public function tolak(Request $request, $id)
    {
        $contract = Contract::where('user_id', $id)->firstOrFail();
        $contract->update([
            'rejection_feedback' => $request['rejection_feedback'],
            'verification_contract' => 'rejected'
        ]);
        notyf()->success('Verifikasi Berhasil');
        return redirect()->route('rooms.contract.index');
    }

    public function checkin(Request $request)
    {
        $id = $request['contract_id'];
        $contract = Contract::where('contract_id', $id)->firstOrFail();
        $contract->update([
            'status' => 'active'
        ]);
        notyf()->success('Checkin Berhasil');
        return redirect()->route('rooms.contract.index');
    }

    public function getCheckin($id)
    {
        $contract = Contract::with(['room.user', 'room.galleries'])->where('contract_id', $id)->firstOrFail();
        return view('pemilik.contract.checkin', compact('contract'));
    }
}
