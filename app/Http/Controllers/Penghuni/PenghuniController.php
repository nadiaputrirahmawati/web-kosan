<?php

namespace App\Http\Controllers\Penghuni;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use App\Models\Contract;
use App\Models\Rooms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenghuniController extends Controller
{
    public function index()
    {
        $room = Rooms::with('user', 'galleries')->get();
        // dd($room);
        return view('user.index', compact('room'));
    }

    public function show($id)
    {
        $room = Rooms::with('user', 'galleries')->find($id);
        // dd($room);
        return view('user.show', compact('room'));
    }

    public function dashboard()
    {
        $userId = Auth::id();

        $activeContract = Contract::where('user_id', $userId)
            ->where('status', 'active')
            ->latest('start_date')
            ->first();

        $complaints = Complaint::where('user_id', $userId)
            ->latest('created_at')  // atau ->orderBy('updated_at', 'desc')
            ->limit(3)
            ->get();

        $totalKomplain = Complaint::where('user_id', $userId)->count();

        $pendingKomplain = Complaint::where('user_id', $userId)
            ->where('status', 'pending')
            ->count();

        $previousContracts = Contract::where('user_id', $userId)
            ->where('status', '!=', 'active')
            ->latest('end_date')
            ->take(5)
            ->get();

        return view('user.dashboard', compact(
            'complaints',
            'activeContract',
            'totalKomplain',
            'pendingKomplain',
            'previousContracts'
        ));
    }
}
