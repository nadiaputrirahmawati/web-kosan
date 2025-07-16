<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Rooms;
use Illuminate\Http\Request;

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
        // dd($room);
        return view('detailroom', compact('room'));
    }

    public function gallery($id)
    {
        $room = Gallery::where('room_id', $id)->get();
        // dd($room);
        return view('gallery', compact('room'));
    }
}
