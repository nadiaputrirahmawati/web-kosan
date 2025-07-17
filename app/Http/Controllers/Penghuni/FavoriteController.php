<?php

namespace App\Http\Controllers\Penghuni;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use App\Models\Rooms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function index()
    {
        $favorite = Favorite::with(['room.galleries'])
            ->where('user_id', Auth::user()->user_id)
            ->get();

        return view('user.favorite.index', compact('favorite'));
    }
    public function favorite(Request $request)
    {
        // Cek apakah user sudah login
        if (!Auth::check()) {
            notyf()->addError('Silakan login terlebih dahulu untuk menyimpan favorit.');
            return redirect()->route('login.user'); // arahkan ke halaman login
        }

        // Validasi input
        $validatedData = $request->validate([
            'room_id' => 'required|exists:rooms,room_id' // asumsi kolomnya 'room_id'
        ]);

        // Ambil data room
        $room = Rooms::where('room_id', $validatedData['room_id'])->first();

        // Tambahkan ke favorit
        Favorite::create([
            'user_id' => Auth::user()->user_id,
            'room_id' => $validatedData['room_id']
        ]);

        notyf()->success('Room Favorit Berhasil Ditambahkan');

        return redirect()->back();
    }

    public function unfavorite($id)
    {
        $favorite = Favorite::findOrFail($id);

        // Pastikan hanya user yang bersangkutan bisa hapus favorit-nya
        if ($favorite->user_id !== Auth::user()->user_id) {
            abort(403, 'Tidak diizinkan.');
        }

        $favorite->delete();

        notyf()->addSuccess('Berhasil menghapus dari favorit.');

        return back();
    }
}
