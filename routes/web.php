<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardOwnerController;
use App\Http\Controllers\DashboardAdminController;

Route::get('/', function () {
    return view('admin.dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/owner/dashboard', [DashboardOwnerController::class, 'index'])
    ->name('owner.dashboard')
    ->middleware([
        'auth',
        'role.owner'
    ]);

Route::get('/admin/dashboard', [DashboardAdminController::class, 'index'])
    ->name('admin.dashboard')
    ->middleware([
        'auth',
        'role.admin'
    ]);

require __DIR__ . '/auth.php';
