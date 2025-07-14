<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Withdrawal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
     public function index()
    {
        // Mengambil jumlah permintaan withdrawal
        $totalWithdrawals = Withdrawal::count();

        // Mengambil jumlah total users
        $totalUsers = User::count();

        return view('admin.dashboard', compact('totalWithdrawals', 'totalUsers'));
    }
}
