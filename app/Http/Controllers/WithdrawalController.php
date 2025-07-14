<?php

namespace App\Http\Controllers;

use App\Models\Withdrawal;
use App\Models\withdrawals;
use Illuminate\Http\Request;

class WithdrawalController extends Controller
{
    // Menampilkan daftar request penarikan
    public function index()
    {
        $withdrawals = Withdrawal::with('owner')->get();
        return view('admin.withdrawals.index', compact('withdrawals'));
    }

    // Menampilkan detail request penarikan
    public function show($id)
    {
        $withdrawal = Withdrawal::findOrFail($id);
        return view('admin.withdrawals.show', compact('withdrawal'));
    }

    // Memperbarui status penarikan (disetujui atau ditolak)
    public function update(Request $request, $id)
    {
        $withdrawal = Withdrawal::findOrFail($id);

        $validatedData = $request->validate([
            'action' => 'required|in:completed,rejected',
        ]);

        if ($request->action == 'completed') {
            $withdrawal->status = 'completed';
        } 

        $withdrawal->save();

        return redirect()->route('admin.withdrawals.index')->with('success', 'Status penarikan telah diperbarui.');
    }
}
