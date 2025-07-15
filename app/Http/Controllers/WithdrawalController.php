<?php

namespace App\Http\Controllers;

use App\Models\Withdrawal;
use App\Models\withdrawals;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        // Mengambil data owner terkait withdrawal
        $owner = $withdrawal->owner;

        if ($request->action == 'completed') {
            // Jika statusnya completed, proses permintaan penarikan selesai
            $withdrawal->status = 'completed';

            // Mengurangi saldo owner dengan jumlah penarikan yang telah disetujui
            $owner->balance -= $withdrawal->amount;
        }

        if ($request->action == 'rejected') {
            // Jika statusnya rejected, kembalikan saldo owner
            $withdrawal->status = 'rejected';

            // Menambahkan kembali saldo yang ditarik ke saldo owner
            $owner->balance += $withdrawal->amount;
        }

        $withdrawal->save();
        $owner->save();

        return redirect()->route('admin.withdrawals.index')->with('success', 'Status penarikan telah diperbarui.');
    }


    // untuk owner
    public function indexOwner()
    {
        $user = Auth::user();
        $withdrawals = Withdrawal::where('owner_id', $user->user_id)->latest()->get();

        return view('pemilik.withdrawals.index', compact('user', 'withdrawals'));
    }

    public function create()
    {
        $user = Auth::user();

        $pendingWithdrawal = Withdrawal::where('owner_id', $user->user_id)
            ->where('status', 'pending')
            ->exists();

        return view('pemilik.withdrawals.create', compact('user', 'pendingWithdrawal'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $validatedData = $request->validate([
            'amount' => 'required|numeric|min:1',
        ]);

        // Cek jika jumlah penarikan lebih dari saldo yang tersedia
        if ($request->amount > $user->balance) {
            return back()->withErrors(['amount' => 'Jumlah penarikan tidak bisa lebih besar dari saldo yang tersedia.']);
        }

        // Cek jika ada permintaan penarikan yang masih berstatus pending
        $pendingRequest = Withdrawal::where('owner_id', $user->user_id)
            ->where('status', 'pending')
            ->first();

        if ($pendingRequest) {
            return back()->withErrors(['pending' => 'Anda masih memiliki permintaan penarikan yang belum diproses.']);
        }

        Withdrawal::create([
            'owner_id' => $user->user_id,
            'amount' => $request->amount,
            'status' => 'pending',
        ]);

        return redirect()->route('owner.withdrawals.index')->with('success', 'Permintaan penarikan berhasil dibuat.');
    }
}
