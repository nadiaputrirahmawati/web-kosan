<?php

use App\Http\Controllers\Pemilik\PemilikController;
use Illuminate\Support\Facades\Route;

// Owner routes - khusus untuk owner
Route::prefix('owner')->middleware(['auth', 'role:owner'])->group(function () {
    Route::get('/kost', function () {
        return view('owner.kost');
    })->name('owner.properties');
     Route::get('/dashboard', [PemilikController::class, 'index']);
});

?>