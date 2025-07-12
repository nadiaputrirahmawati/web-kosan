<?php

use App\Http\Controllers\Penghuni\PenghuniController;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'penghuni'], function () {
    Route::get('/dashboard', [PenghuniController::class, 'index']);
});

?>