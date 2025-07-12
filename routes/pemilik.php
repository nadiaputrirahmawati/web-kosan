<?php

use App\Http\Controllers\Pemilik\PemilikController;
use App\Http\Controllers\Pemilik\RoomController;
use Illuminate\Support\Facades\Route;

// Owner routes - khusus untuk owner
Route::prefix('owner')->middleware(['auth', 'role:owner'])->group(function () {
    Route::get('/kost', function () {
        return view('owner.kost');
    })->name('owner.properties');
     Route::get('/dashboard', [PemilikController::class, 'index']);

     Route::get('room', [RoomController::class, 'index'])->name('rooms.index');
     Route::get('room/create', [RoomController::class, 'create'])->name('rooms.create');
     Route::post('room', [RoomController::class, 'store'])->name('rooms.store');
     Route::get('room/{id}/show', [RoomController::class, 'show'])->name('rooms.show');

});

?>