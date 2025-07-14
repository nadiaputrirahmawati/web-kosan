<?php

namespace App\Http\Controllers;

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
}
