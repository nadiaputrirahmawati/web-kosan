<?php

use App\Http\Controllers\Penghuni\ContractController;
use App\Http\Controllers\penghuni\PaymentController;
use App\Http\Controllers\Penghuni\PenghuniController;
use App\Http\Controllers\Penghuni\ProfileController;
use Illuminate\Support\Facades\Route;


// Route::group(['prefix' => 'penghuni'], function () {
//     Route::get('/dashboard', [PenghuniController::class, 'index']);
// });

Route::prefix('user', 'as', 'user.')->middleware(['auth', 'role:user'])->group(function () {
    Route::get('/profile', function () {
        return view('user.profile.index');
    })->name('profile');
    Route::put('/profile', [ProfileController::class, 'update'])->name('user.profile.update');
    Route::post('room/contract', [ContractController::class, 'store'])->name('user.contract.store')->middleware('check-sewa');
    Route::get('room/contract', [ContractController::class, 'index'])->name('user.contract');
    Route::get('/dashboard', function () {
        return view('user.dashboard');
    })->name('user.dashboard');
});
Route::post('user/room/contract/payment', [PaymentController::class, 'paymentSewa'])->name('user.contract.payment');
Route::post('user/room/contract/payment/callback', [PaymentController::class, 'handleCallback']);
