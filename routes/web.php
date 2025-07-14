<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\Penghuni\PenghuniController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


require base_path('routes/pemilik.php');
require base_path('routes/penghuni.php');

// Dashboard routes dengan role-based middleware yang terpisah
Route::get('/', [LandingPageController::class, 'index']);
Route::get('/user/room/{id}/show', [LandingPageController::class, 'show'])->name('user.rooms.show');
Route::post('/user/room/{id}/show', [LandingPageController::class, 'store'])->name('user.rooms.show');

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard')->middleware(['auth', 'role:admin']);

// Admin routes - khusus untuk mengelola user dan owner
Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/users', function () {
        return view('admin.users');
    })->name('admin.users');
});


require __DIR__ . '/auth.php';
