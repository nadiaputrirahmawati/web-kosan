<?php

namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;
use App\Models\Rooms;
use Illuminate\Http\Request;
use App\Models\Gallery;
use Illuminate\Support\Str;

class GalleryController extends Controller
{
    public function index($id)
    {
        $room = Rooms::with('user')
            ->where('room_id', $id)
            ->firstOrFail();
        return view('pemilik.room.gallery', compact('room'));
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            'images'   => 'required|array|max:5',
            'images.*' => 'image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $room = Rooms::findOrFail($id);

        foreach ($request->file('images') as $image) {
            $path = $image->store('rooms', 'public');

            Gallery::create([
                'gallery_id' => Str::uuid(),
                'room_id'    => $room->room_id,
                'image_url'  => $path,     
            ]);
        }

        return redirect()
            ->route('rooms.show', $id)
            ->with('success', 'Gambar berhasil ditambahkan.');
    }
}
