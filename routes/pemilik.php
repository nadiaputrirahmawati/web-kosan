<?php

use App\Http\Controllers\Pemilik\PemilikController;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'pemilik'], function () {
    Route::get('/dashboard', [PemilikController::class, 'index']);
});

?>