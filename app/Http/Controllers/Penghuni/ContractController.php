<?php

namespace App\Http\Controllers\Penghuni;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ContractController extends Controller
{

    public function index()
    {
        $contracts = Contract::with(['room.owner', 'payment']) // eager load room dan owner dari room
            ->where('user_id', Auth::user()->user_id)
            ->latest()
            ->get();
        // dd($contracts);
        return view('user.contract.index', compact('contracts'));
    }
    public function store(Request $request)
    {

        $validated = $request->validate([
            'start_date' => 'required|date',
            'deposit_amount' => 'required',
            'room_id'    => 'required|exists:rooms,room_id',
            'owner_id'    => 'required|exists:rooms,owner_id',
        ]);

        // Hitung tanggal berakhir: 1 bulan setelah start_date
        $endDate = Carbon::parse($validated['start_date'])->addMonth(); // 17‑12‑2025 ➔ 17‑01‑2026

        Contract::create([
            'contract_id'          => Str::uuid(),
            'user_id'              => Auth::user()->user_id,
            'status'                => 'pending_payment',
            'verification_contract' => 'pending',
            'contract_type'         => 'initial',
            'deposit_amount'       => $validated['deposit_amount'],
            'start_date'           => $validated['start_date'],
            'end_date'             => $endDate,
            'owner_id'             => $validated['owner_id'],
            'room_id'              => $validated['room_id'],
        ]);

        notyf()->success('Ajukan Sewa Berhasil, Silahkan Tunggu Verifikasi Pemilik Kos');
        return redirect()->route('user.contract');
    }

    public function ttdKontrak($id)
    {
        $contract = Contract::with(['room.owner']) // eager load room dan owner dari room
            ->where('contract_id', $id)
            ->firstOrFail();
        // dd($contracts);
        return view('user.contract.ttdkontrak', compact('contract'));
    }

    public function createsignature(Request $request, $id)
    {
        // Validasi: field signature wajib ada
        $request->validate([
            'signature' => 'required|string',
        ]);

        $contract = Contract::where('contract_id', $id)->firstOrFail();

        $signatureData = $request->input('signature');

        // Deteksi apakah format data base64 valid
        if (preg_match('/^data:image\/(\w+);base64,/', $signatureData, $type)) {
            $signatureData = substr($signatureData, strpos($signatureData, ',') + 1); // hilangkan header base64
            $extension = strtolower($type[1]); // Ambil ekstensi file (png/jpg)

            // Amankan nama file
            $fileName = 'signature_' . Str::uuid() . '.' . $extension;

            // Simpan ke storage/app/public/signatures
            Storage::disk('public')->put("signatures/{$fileName}", base64_decode($signatureData));

            // Simpan path saja ke database (supaya tidak terlalu panjang)
            $contract->signature = "signatures/{$fileName}";
            $contract->save();

            notyf()->success('Tanda tangan berhasil disimpan!');
            return back();
        } else {
            return back()->withErrors(['signature' => 'Format tanda tangan tidak valid.']);
        }
    }

    public function reject($id)
    {
        $contract = Contract::where('contract_id', $id)->firstOrFail();
        $contract->status = 'cancelled';
        $contract->save();
        notyf()->success('Penarikan Deposit Berhasil Ditolak');
        return redirect()->back();
    }

    public function perpanjangSewa(Request $request, $id)
    {
        $userId = Auth::id();

        // Ambil kontrak lama
        $oldContract = Contract::where('contract_id', $id)
            ->where('user_id', $userId)
            ->firstOrFail();

        // 1. Validasi status kontrak lama
        if ($oldContract->status !== 'active') {
            return back()->withErrors(['Kontrak lama tidak aktif. Tidak dapat diperpanjang.']);
        }

        // 2. Hitung sisa hari dari kontrak lama
        $remainingDays = now()->diffInDays($oldContract->end_date, false);
        if ($remainingDays > 7) {
            return back()->withErrors(['Perpanjangan hanya dapat dilakukan jika sisa kontrak kurang dari 7 hari.']);
        }


        // 3. Buat kontrak baru (tipe renewal)
        $newContract = Contract::create([
            'contract_id'           => Str::uuid(),
            'owner_id'              => $oldContract->owner_id,
            'user_id'               => $oldContract->user_id,
            'room_id'               => $oldContract->room_id,
            'start_date'            => now(),
            'end_date'              => now()->addMonth(),
            'verification_contract' => 'completed',
            'signature'             => $oldContract->signature,
            'status'                => 'pending_payment', // atau 'completed' jika ingin diaktifkan setelah dibayar
            'deposit_amount'        => 0,
            'contract_type'         => 'renewal',
        ]);

        // 4. Update status kontrak lama ke 'in_renewal'
        $oldContract->update(['status' => 'in_renewal']);

        notyf()->success('Perpanjangan kontrak berhasil dibuat.');

        return redirect()->back();
    }
}
