<?php

use App\Http\Controllers\LoginUserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterUserController;
use Illuminate\Support\Facades\Auth;

Route::get('/admin/register', [RegisterUserController::class, 'create'])
    ->name('admin.register');
Route::post('/admin/register', [RegisterUserController::class, 'store'])
    ->name('admin.register');

Route::get('/admin/login', [LoginUserController::class, 'create'])
    ->name('admin.login');
Route::post('/admin/login', [LoginUserController::class, 'store'])
    ->name('admin.login');

// User routes
Route::get('/user/register', [RegisterUserController::class, 'create'])
    ->name('user.register');
Route::post('/user/register', [RegisterUserController::class, 'store'])
    ->name('user.register');

Route::get('/user/login', [LoginUserController::class, 'create'])
    ->name('user.login');
Route::post('/user/login', [LoginUserController::class, 'store'])
    ->name('user.login');

// Owner routes
Route::get('/owner/register', [RegisterUserController::class, 'create'])
    ->name('owner.register');
Route::post('/owner/register', [RegisterUserController::class, 'store'])
    ->name('owner.register');

Route::get('/owner/login', [LoginUserController::class, 'create'])
    ->name('owner.login');
Route::post('/owner/login', [LoginUserController::class, 'store'])
    ->name('owner.login');

// Logout route
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout')->middleware('auth');
