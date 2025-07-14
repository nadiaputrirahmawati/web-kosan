<?php

use App\Http\Controllers\Pemilik\ContractController;
use App\Http\Controllers\Pemilik\GalleryController;
use App\Http\Controllers\Pemilik\PemilikController;
use App\Http\Controllers\Pemilik\RoomController;
use Illuminate\Support\Facades\Route;

// Owner routes - khusus untuk owner
Route::prefix('owner')->middleware(['auth', 'role:owner'])->group(function () {
    Route::get('/kost', function () {
        return view('owner.kost');
    })->name('owner.properties');
     Route::get('/dashboard', [PemilikController::class, 'index'])->name('owner.dashboard');

     Route::get('room', [RoomController::class, 'index'])->name('rooms.index');
     Route::get('room/create', [RoomController::class, 'create'])->name('rooms.create');
     Route::post('room', [RoomController::class, 'store'])->name('rooms.store');
     Route::get('room/{id}/show', [RoomController::class, 'show'])->name('rooms.show');
     Route::get('room/{id}/gallery', [GalleryController::class, 'index'])->name('rooms.gallery');
     Route::post('room/{id}/gallery', [GalleryController::class, 'store'])->name('rooms.gallery.store');

     Route::get('room/contract', [ContractController::class, 'index'])->name('rooms.contract');
     Route::get('room/contract/{id}/show', [ContractController::class, 'show'])->name('rooms.contract.show');
     Route::post('room/contract/{id}/verifikasi', [ContractController::class, 'verifikasi'])->name('rooms.contract.verifikasi');
     Route::put('room/contract/{id}/tolak', [ContractController::class, 'tolak'])->name('rooms.contract.reject');
});

?>