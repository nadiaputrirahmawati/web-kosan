<?php

namespace App\Http\Controllers\Penghuni;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PenghuniController extends Controller
{
    public function index()
    {
        return view('penghuni.dashboard');
    }
}
