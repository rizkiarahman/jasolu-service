<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SparepartController;

Route::get('/', [DashboardController::class, 'index']);
Route::resource('spareparts', SparepartController::class);