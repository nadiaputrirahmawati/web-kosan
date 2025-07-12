<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Dashboard routes dengan role-based middleware yang terpisah
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard')->middleware(['auth', 'role:admin']);

Route::get('/owner/dashboard', function () {
    return view('owner.dashboard');
})->name('owner.dashboard')->middleware(['auth', 'role:owner']);

Route::get('/user/dashboard', function () {
    return view('user.dashboard');
})->name('user.dashboard')->middleware(['auth', 'role:user']);

// Admin routes - khusus untuk mengelola user dan owner
Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/users', function () {
        return view('admin.users');
    })->name('admin.users');

    Route::get('/owners', function () {
        return view('admin.owners');
    })->name('admin.owners');

    Route::get('/reports', function () {
        return view('admin.reports');
    })->name('admin.reports');
});

// Owner routes - khusus untuk owner
Route::prefix('owner')->middleware(['auth', 'role:owner'])->group(function () {
    Route::get('/kost', function () {
        return view('owner.kost');
    })->name('owner.properties');
});

// User routes - khusus untuk user
Route::prefix('user')->middleware(['auth', 'role:user'])->group(function () {
    Route::get('/profile', function () {
        return view('user.profile');
    })->name('user.profile');

    Route::get('/bookings', function () {
        return view('user.bookings');
    })->name('user.bookings');

    Route::get('/search', function () {
        return view('user.search');
    })->name('user.search');
});

require __DIR__ . '/auth.php';
