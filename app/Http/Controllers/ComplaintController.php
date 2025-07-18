<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Rooms;
use App\Models\Complaint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComplaintController extends Controller
{
    // Daftar keluhan terkait owner
    public function index()
    {
        $ownerId = Auth::id();

        // Ambil keluhan berdasarkan room milik owner
        $complaints = Complaint::whereHas('room', function ($q) use ($ownerId) {
            $q->where('owner_id', $ownerId);
        })->with(['user', 'room'])->get();

        return view('pemilik.complaints.index', compact('complaints'));
    }

    // Halaman update status keluhan
    public function edit($id)
    {
        $complaint = Complaint::with(['user', 'room'])->findOrFail($id);
        return view('pemilik.complaints.edit', compact('complaint'));
    }

    // Update status dan keterangan
    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:sent,in_process,completed',
            'complaint_feedback' => 'nullable|string|max:1000',
        ]);

        $complaint = Complaint::findOrFail($id);
        $complaint->status = $request->status;
        $complaint->complaint_feedback = $request->complaint_feedback;
        $complaint->save();
        notyf()->success('Keluhan berhasil diperbarui');
        return redirect()->route('owner.complaints.index');
    }


    // Area Penghuni

    public function indexUserComplaint()
    {
        $user = Auth::user();

        $complaints = Complaint::where('user_id', $user->user_id)
            ->with('room')
            ->latest()
            ->get();

        return view('user.complaints.index', compact('complaints'));
    }

    public function create()
    {
        $user = Auth::user();

        // Ambil kamar dari kontrak aktif milik user
        $rooms = Rooms::whereIn('room_id', function ($query) use ($user) {
            $query->select('room_id')
                ->from('contracts')
                ->where('user_id', $user->user_id)
                ->where('status', 'active');
        })->first();

        return view('user.complaints.create', compact('rooms'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'room_id' => 'required|exists:rooms,room_id',
            'description' => 'required|string',
        ]);

        // Cek apakah room benar-benar dihuni oleh user
        $isActiveContract = \App\Models\Contract::where('user_id', $user->user_id)
            ->where('room_id', $validated['room_id'])
            ->where('status', 'active')
            ->exists();

        if (!$isActiveContract) {
            return back()->withErrors(['room_id' => 'Kamar tidak valid atau bukan milik kontrak Anda.']);
        }

        Complaint::create([
            'user_id' => $user->user_id,
            'room_id' => $validated['room_id'],
            'description' => $validated['description'],
            'status' => 'sent_in',
        ]);

        notyf()->success('Keluhan berhasil dikirim');
        return redirect()->route('user.complaints.index');  
    }
}
