<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\LoginAdminController;
use App\Http\Controllers\LoginOwnerController;
use App\Http\Controllers\RegisterAdminController;
use App\Http\Controllers\RegisterOwnerController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {

    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');

    Route::get('/owner/register', [RegisterOwnerController::class, 'show'])
        ->name('owner.show');

    Route::post('/owner/register', [RegisterOwnerController::class, 'store'])
        ->name('owner.register');

    Route::get('/owner/login', [LoginOwnerController::class, 'show'])
        ->name('owner.login.show');

    Route::post('/owner/login', [LoginOwnerController::class, 'store'])
        ->name('owner.login.store');

    Route::get('/admin/login', [LoginAdminController::class, 'index'])
        ->name('admin.login.show');

    Route::post('/admin/login', [LoginAdminController::class, 'store'])
        ->name('admin.login.store');

    Route::get('/admin/register', [RegisterAdminController::class, 'index'])
        ->name('admin.register.show');

    Route::post('/admin/register', [RegisterAdminController::class, 'store'])
        ->name('admin.register.store');
});


Route::middleware('auth')->group(function () {

    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');

    Route::post('owner/logout', [LoginOwnerController::class, 'destroy'])
        ->name('owner.logout');

    Route::post('admin/logout', [LoginAdminController::class, 'destroy'])
        ->name('admin.logout');
});
