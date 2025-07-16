<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\penghuni\RoomController;
use App\Http\Controllers\penghuni\PaymentController;
use App\Http\Controllers\Penghuni\ProfileController;
use App\Http\Controllers\Penghuni\ContractController;
use App\Http\Controllers\Penghuni\FavoriteController;
use App\Http\Controllers\Penghuni\PenghuniController;


// Route::group(['prefix' => 'penghuni'], function () {
//     Route::get('/dashboard', [PenghuniController::class, 'index']);
// });

Route::prefix('user', 'as', 'user.')->middleware(['auth', 'role:user'])->group(function () {
    Route::get('/profile', function () {
        return view('user.profile.index');
    })->name('profile');
    Route::put('/profile', [ProfileController::class, 'update'])->name('user.profile.update');

    
    
    Route::get('/dashboard', function () {return view('user.dashboard');})->name('user.dashboard');
    
    // Kontrak Saya
    Route::post('room/contract', [ContractController::class, 'store'])->name('user.contract.store')->middleware('check-sewa');
    Route::get('room/contract', [ContractController::class, 'index'])->name('user.contract');
    Route::get('room/contract/{id}/ttd', [ContractController::class, 'ttdKontrak'])->name('user.contract.ttd');
    Route::post('room/contract/{id}/ttd', [ContractController::class, 'createsignature'])->name('user.contract.signature.save');
    Route::post('room/contract/{id}/reject', [ContractController::class, 'reject'])->name('user.contract.signature.reject');
    
    // Kos Saya
    Route::get('room', [RoomController::class, 'index'])->name('user.room');
    Route::get('/user/room/{id}/show', [RoomController::class, 'show'])->name('user.room.show');
    Route::get('/user/room/checkin/{id}', [RoomController::class, 'checkin'])->name('user.contract.checkin');
    Route::get('/user/contract/{contract}/download', [RoomController::class, 'downloadPDF'])->name('user.contract.download');
    Route::post('/user/contract/{contract}/new', [ContractController::class, 'perpanjangSewa'])->name('user.contract.newcontract');

    //Complaint Area
    Route::get('complaints', [ComplaintController::class, 'indexUserComplaint'])->name('user.complaints.index');
    Route::get('complaints/create', [ComplaintController::class, 'create'])->name('user.complaints.create');
    Route::post('complaints', [ComplaintController::class, 'store'])->name('user.complaints.store');

    // Favorite
    Route::post('favorite', [FavoriteController::class, 'favorite'])->name('favorite.save');
    Route::get('favorite', [FavoriteController::class, 'index'])->name('user.favorite');
    Route::delete('favorite/{id}', [FavoriteController::class, 'unfavorite'])->name('favorite.delete');

});
Route::post('user/room/contract/payment', [PaymentController::class, 'paymentSewa'])->name('user.contract.payment');
Route::post('user/room/contract/payment/callback', [PaymentController::class, 'handleCallback']);
