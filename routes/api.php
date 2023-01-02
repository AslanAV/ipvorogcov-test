<?php

use App\Http\Controllers\FrontendController;
use App\Http\Controllers\TokenController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::post('/token', [TokenController::class, 'store']);
    Route::match(['get', 'post'], '/save-data', [FrontendController::class, 'store'])->name('frontend');
});
