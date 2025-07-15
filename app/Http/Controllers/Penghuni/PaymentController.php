<?php

namespace App\Http\Controllers\penghuni;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use App\Models\Payment;
use App\Models\Rooms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Midtrans\Config as MidtransConf;
use Midtrans\Snap;

class PaymentController extends Controller
{
    public function __construct()
    {
        MidtransConf::$serverKey = config('midtrans.server_key');
        MidtransConf::$isProduction = config('midtrans.is_production');
        MidtransConf::$isSanitized = config('midtrans.is_sanitized');
        MidtransConf::$is3ds = config('midtrans.is_3ds');
        MidtransConf::$overrideNotifUrl = config('midtrans.callback_url');
    }
    public function paymentSewa(Request $request)
    {
        $validated = $request->validate([
            'contract_id' => 'required',
            'price' => 'required',
            'name' => 'required',
        ]);
        $contract = Contract::where('contract_id', $validated['contract_id'])->firstOrFail();;

        $jumlahSewa = $contract->deposit_amount + $validated['price'];

        $sewa = Payment::create([
            'contract_id' => $validated['contract_id'],
            'user_id' => Auth::user()->user_id,
            'amount' => $jumlahSewa,
            'order_id' => 'ORD-SEWA' . random_int(10000, 99999),
            'status' => 'pending',
            'payment_date' => now()->toDateString(),
        ]);

        $params = [
            'transaction_details' => [
                'order_id' => $sewa->order_id,
                'gross_amount' => $jumlahSewa,
            ],
            "item_details" => [
                [
                    "id" => uniqid(),
                    "name" => $validated['name'],
                    "quantity" => 1,
                    "price" => $validated['price'],
                    "deposition_amount" => $contract->deposit_amount,
                    'jumlah' => $jumlahSewa
                ],
                [
                    "id"       => uniqid(),
                    "name"     => "Deposit",
                    "quantity" => 1,
                    "price"    => $contract->deposit_amount,
                ],
            ],
            'customer_details' => [
                'first_name' => Auth::user()->name,
                'email' => Auth::user()->email ?? null,
                'phone' => Auth::user()->phone_number ?? null,
            ],
            'callbacks' => [
                'finish' => 'http://127.0.0.1:8000/user/room/contract',
                'unfinish' => 'https://large-tetra-basically.ngrok-free.app/order/payment/callback',
                'error' => 'https://large-tetra-basically.ngrok-free.app/order/payment/callback',
            ]
        ];

        $snapToken = [
            'snap_token' => Snap::getSnapUrl($params)
        ];

        $order = Payment::find($sewa->payment_id);
        $order->snap_token = $snapToken['snap_token'];
        $order->save();

        return redirect()->to($snapToken['snap_token']);
    }

    public function handleCallback(Request $request)
    {
        $serverKey = config('midtrans.server_key');
        $hashedKey = hash('sha512', $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        if ($hashedKey !== $request->signature_key) {
            return response()->json(['message' => 'Invalid signature key'], 403);
        }

        $transactionStatus = $request->transaction_status;
        $orderId = $request->order_id;

        // Temukan transaksi berdasarkan `order_id`
        $order = Payment::where('order_id', $orderId)->first();

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        // Perbarui status transaksi dan donasi berdasarkan notifikasi
        if ($transactionStatus === 'capture' || $transactionStatus === 'settlement') {
            $order->status = 'completed';
            $contract = Contract::where('contract_id', $order->contract_id)->first();
            $contract->deposit_status = 'completed';
            $contract->status = 'completed';
            $room = Rooms::where('room_id', $contract->room_id)->first();
            $jumlahSewa = $room->total_rooms - 1;
            $room->occupied_rooms = $jumlahSewa;
            $contract->save();
            $room->save();
        } elseif ($transactionStatus === 'pending') {
            $order->status = 'pending';
        } elseif (in_array($transactionStatus, ['deny', 'cancel', 'expire'])) {
            $order->status = 'failed';
        }
        $order->save();
        return response()->json(['message' => 'Callback handled'], 200);
    }
}
