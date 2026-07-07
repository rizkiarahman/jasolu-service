<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SparepartController;
use App\Http\Controllers\CustomerController;


Route::get('/', [DashboardController::class, 'index']);
Route::resource('spareparts', SparepartController::class);
Route::resource('customers', CustomerController::class);
