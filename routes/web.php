<?php

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;


require base_path('routes/pemilik.php');
require base_path('routes/penghuni.php');

Route::group(['prefix' => 'admin'], function () {
    Route::get('/dashboard', [AdminController::class, 'index']);
});

// Dashboard routes dengan role-based middleware yang terpisah
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard')->middleware(['auth', 'role:admin']);



Route::get('/user/dashboard', function () {
    return view('user.dashboard');
})->name('user.dashboard')->middleware(['auth', 'role:user']);

// Admin routes - khusus untuk mengelola user dan owner
Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/users', function () {
        return view('admin.users');
    })->name('admin.users');
});




// User routes - khusus untuk user
Route::prefix('user')->middleware(['auth', 'role:user'])->group(function () {
    Route::get('/profile', function () {
        return view('user.profile');
    })->name('user.profile');
});

require __DIR__ . '/auth.php';
