<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WithdrawalController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\Penghuni\PenghuniController;
use App\Http\Controllers\Admin\UserManagementController;


require base_path('routes/pemilik.php');
require base_path('routes/penghuni.php');

// Dashboard routes dengan role-based middleware yang terpisah
Route::get('/', [LandingPageController::class, 'index']);
Route::get('/user/room/{id}/show', [LandingPageController::class, 'show'])->name('user.rooms.show');
Route::get('/user/room/{id}/gallery', [LandingPageController::class, 'gallery'])->name('room.gallery');
// Route::post('/user/room/{id}/show', [LandingPageController::class, 'store'])->name('user.rooms.store');



// Admin routes - khusus untuk mengelola user dan owner
Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::resource('user-management', UserManagementController::class);
    Route::get('withdrawals', [WithdrawalController::class, 'index'])->name('withdrawals.index');
    Route::get('withdrawals/{id}/show', [WithdrawalController::class, 'show'])->name('withdrawals.show');
    Route::put('withdrawals/{id}/update', [WithdrawalController::class, 'update'])->name('withdrawals.update');


    // Route::get('/users', function () {
    //     return view('admin.users');
    // })->name('admin.users');
});


require __DIR__ . '/auth.php';
