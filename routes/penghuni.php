<?php

use App\Http\Controllers\Penghuni\PenghuniController;
use App\Http\Controllers\Penghuni\ProfileController;
use Illuminate\Support\Facades\Route;


// Route::group(['prefix' => 'penghuni'], function () {
//     Route::get('/dashboard', [PenghuniController::class, 'index']);
// });

Route::prefix('user','as', 'user.')->middleware(['auth', 'role:user'])->group(function () {
    Route::get('/profile', function () { return view('user.profile.index');})->name('profile');
    Route::put('/profile', [ProfileController::class, 'update'])->name('user.profile.update');
});

Route::get('/user/dashboard', function () {return view('user.dashboard'); })->name('user.dashboard')->middleware(['auth', 'role:user']);


?>