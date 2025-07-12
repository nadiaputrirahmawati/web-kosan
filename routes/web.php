<?php

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;


require base_path('routes/pemilik.php');
require base_path('routes/penghuni.php');

Route::group(['prefix' => 'admin'], function () {
    Route::get('/dashboard', [AdminController::class, 'index']);
});
