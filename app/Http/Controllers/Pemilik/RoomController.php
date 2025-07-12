<?php

namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;
use App\Models\Rooms;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index()
    {
        $Room = Rooms::with('galleries')->get();
        // dd($Room);
        return view('pemilik.room.index', compact('Room'));
    }


    public function create()
    {
        return view('pemilik.room.create');
    }

    public function store(Request $request)
    {
        // 1) VALIDASI
        $validated = $request->validate([
            'name'           => 'required|string|max:255',
            'price'          => 'required|numeric|min:0',
            'quantity'       => 'required|integer|min:1',
            'status'         => 'required|in:kosong,terisi,booking',
            'type'           => 'required|in:campur,putri,putra',
            'deposit_amount' => 'nullable|numeric|min:0',
            'room_facility' => 'nullable|array',
            'room_facility.*' => 'string|max:255',
            'public_facility' => 'nullable|array',
            'public_facility.*' => 'string|max:255',
            'address'        => 'required|string|max:255',
            'description'    => 'nullable|string',
            'regulation'     => 'nullable|array',
            'regulation.*'   => 'string|max:255',
            'is_featured'    => 'nullable|boolean',
        ]);

        // 2) BUAT RECORD (dengan owner user_id)
        Rooms::create([
            'user_id'        => Auth::user()->user_id,
            'name'           => $validated['name'],
            'price'          => $validated['price'],
            'quantity'       => $validated['quantity'],
            'status'         => $validated['status'],
            'type'           => $validated['type'],
            'deposit_amount' => $validated['deposit_amount'] ?? 0,
            'room_facility'  => $validated['room_facility'] ?? null,
            'public_facility' => $validated['public_facility'] ?? null,
            'address'        => $validated['address'],
            'description'    => $validated['description'] ?? null,
            'regulation'     => $validated['regulation'] ?? [], // array → JSON
            'is_featured'    => $request->boolean('is_featured'),
        ]);

        return redirect()
            ->route('rooms.gallery', ['id' => Rooms::latest()->first()->room_id])
            ->with('success', 'Kamar berhasil ditambahkan.');
    }

    public function show($id)
    {
        $room = Rooms::with('user', 'galleries') // relasi pemilik
            ->where('room_id', $id)
            ->firstOrFail();

        return view('pemilik.room.show', compact('room'));
    }
}
