<?php

namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use App\Models\Contract;
use App\Models\Rooms;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PemilikController extends Controller
{
    public function index()
    {

        $contract = Contract::with(['room.galleries', 'user'])
            ->where('owner_id', Auth::user()->user_id)
            ->where('contract_type', 'initial')
            ->whereDate('created_at', Carbon::today())
            ->latest()
            ->limit(5)
            ->get();

        // dd($contract);
        $complaints = Complaint::with(['user', 'room'])
            ->whereHas('room', function ($query) {
                $query->where('owner_id', Auth::user()->user_id);
            })
            ->latest() // ini otomatis pakai kolom 'created_at'
            ->limit(5)
            ->get();

        $penghuni = Contract::where('owner_id', Auth::user()->user_id)->where('contract_type', 'initial')->count();
        $room = Rooms::where('owner_id', Auth::user()->user_id);
        // dd($complaints);
        $pendapatan = Auth::user()->pendapatan;
        return view('pemilik.dashboard', compact('contract', 'complaints', 'room', 'penghuni'));
    }
}
