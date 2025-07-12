<?php

use App\Http\Controllers\Penghuni\PenghuniController;
use Illuminate\Support\Facades\Route;


// Route::group(['prefix' => 'penghuni'], function () {
//     Route::get('/dashboard', [PenghuniController::class, 'index']);
// });

Route::prefix('user')->middleware(['auth', 'role:user'])->group(function () {
    Route::get('/profile', function () {
        return view('user.profile');
    })->name('user.profile');
});

Route::get('/user/dashboard', function () {
    return view('user.dashboard');
})->name('user.dashboard')->middleware(['auth', 'role:user']);


?>