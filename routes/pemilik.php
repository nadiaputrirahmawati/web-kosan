<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\WithdrawalController;
use App\Http\Controllers\Pemilik\RoomController;
use App\Http\Controllers\Pemilik\GalleryController;
use App\Http\Controllers\Pemilik\PemilikController;
use App\Http\Controllers\Pemilik\ContractController;
use App\Http\Controllers\Pemilik\ProfileController;

// Owner routes - khusus untuk owner
Route::prefix('owner')->middleware(['auth', 'role:owner'])->group(function () {
    Route::get('/kost', function () {
        return view('owner.kost');
    })->name('owner.properties');
    Route::get('/dashboard', [PemilikController::class, 'index'])->name('owner.dashboard');

    // Penarikan Uang
    Route::get('withdrawals', [WithdrawalController::class, 'indexOwner'])->name('owner.withdrawals.index');
    Route::get('withdrawals/create', [WithdrawalController::class, 'create'])->name('owner.withdrawals.create');
    Route::post('withdrawals', [WithdrawalController::class, 'store'])->name('owner.withdrawals.store');

    // Tambah Kamar
    Route::get('room', [RoomController::class, 'index'])->name('rooms.index');
    Route::post('room', [RoomController::class, 'store'])->name('rooms.store');
    Route::get('room/create', [RoomController::class, 'create'])->name('rooms.create');
    Route::put('room/update/{id}', [RoomController::class, 'update'])->name('rooms.update');
    Route::get('room/update/{id}', [RoomController::class, 'getUpdate'])->name('rooms.update.show');
    Route::get('room/{id}/show', [RoomController::class, 'show'])->name('rooms.show');
    Route::delete('room/{id}/delete', [RoomController::class, 'delete'])->name('rooms.destroy');

    // Tambah Gambar
    Route::get('room/gallery/{id}', [GalleryController::class, 'create'])->name('rooms.gallery');
    Route::post('room/{id}/gallery', [GalleryController::class, 'store'])->name('rooms.gallery.store');
    // Route::get('room/gallery/{id}/edit', [GalleryController::class, 'edit'])->name('rooms.gallery.edit');
    Route::delete('room/gallery/{id}', [GalleryController::class, 'destroy'])->name('rooms.gallery.delete');
    // Route::put('room/gallery/{id}', [GalleryController::class, 'update'])->name('rooms.gallery.update');

    // Verifikasi Kontrak
    Route::get('room/contract', [ContractController::class, 'index'])->name('rooms.contract.index');
    Route::get('room/contract/{id}/show', [ContractController::class, 'show']);
    Route::post('room/contract/{id}/verifikasi', [ContractController::class, 'verifikasi'])->name('rooms.contract.verifikasi');
    Route::put('room/contract/{id}/tolak', [ContractController::class, 'tolak'])->name('rooms.contract.reject');

    //Complaint area
    Route::get('complaints', [ComplaintController::class,'index'])->name('owner.complaints.index');
    Route::get('complaints/{id}/edit', [ComplaintController::class,'edit'])->name('owner.complaints.edit');
    Route::put('complaints/{id}', [ComplaintController::class,'update'])->name('owner.complaints.update');

    //Checkin
    Route::post('/user/room/checkin', [ContractController::class, 'checkin'])->name('contract.checkin.save');
    Route::get('/user/room/checkin/{id}', [ContractController::class, 'getCheckin'])->name('contract.checkin');

    // Profile
    Route::get('profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');

});
