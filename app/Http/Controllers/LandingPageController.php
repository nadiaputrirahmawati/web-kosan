<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Gallery;
use App\Models\Rooms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LandingPageController extends Controller
{
    public function index()
    {
        $room = Rooms::with('user', 'galleries')->get();
        // dd($room);
        return view('index', compact('room'));
    }

    public function show($id)
    {
        $room = Rooms::with('user', 'galleries')->find($id);
        $favorite = Favorite::where('room_id', $room->room_id)->where('user_id', Auth::id())->first();
        $isFavorited = Favorite::where('user_id', Auth::id())
            ->where('room_id', $room->room_id)
            ->exists();

        // dd($room);
        return view('detailroom', compact('room', 'isFavorited', 'favorite'));
    }

    public function gallery($id)
    {
        $room = Gallery::where('room_id', $id)->get();
        // dd($room);
        return view('gallery', compact('room'));
    }
}
