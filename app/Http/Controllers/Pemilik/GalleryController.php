<?php

namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;
use App\Models\Rooms;
use Illuminate\Http\Request;
use App\Models\Gallery;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class GalleryController extends Controller
{

    public function update(Request $request, $id)
    {
        $request->validate([
            'images'   => 'required|array|max:6',
            'images.*' => 'image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $room = Rooms::findOrFail($id);

        // Hapus semua gambar lama
        foreach ($room->galleries as $gallery) {
            // Hapus file dari storage
            Storage::disk('public')->delete($gallery->image_url);

            // Hapus dari DB
            $gallery->delete();
        }

        // Upload gambar baru
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
            ->with('success', 'Gambar berhasil diperbarui.');
    }


    public function edit($id)
    {
        $galery = Gallery::where('room_id', $id)->get();
        $room = Rooms::with('user')
            ->where('room_id', $id)
            ->firstOrFail();
        return view('pemilik.gallery.edit', compact('room', 'galery'));
    }
    public function create($id)
    {
        $room = Rooms::with('user')
            ->where('room_id', $id)
            ->firstOrFail();
        return view('pemilik.gallery.create', compact('room'));
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            'images'   => 'required|array|max:6',
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

    public function destroy($id)
    {
        $gallery = Gallery::findOrFail($id);

        // Hapus file fisik
        if (Storage::disk('public')->exists($gallery->image_url)) {
            Storage::disk('public')->delete($gallery->image_url);
        }

        // Hapus dari database
        $gallery->delete();
        return back()->with('success', 'Gambar berhasil dihapus.');
    }
}
