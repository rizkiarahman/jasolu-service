<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SparepartController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AIAssistantController;
use Illuminate\Support\Facades\Route;

// Redirect alamat host utama (/) ke halaman login
Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth'])->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('customers', CustomerController::class);
    Route::resource('spareparts', SparepartController::class);
    Route::resource('vehicles', VehicleController::class);
    Route::resource('services', ServiceController::class);

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/ai-assistant', [AIAssistantController::class, 'index'])->name('ai.index');
    Route::post('/ai-assistant/chat', [AIAssistantController::class, 'chat'])->name('ai.chat');
});

Route::middleware(['auth', 'admin'])->group(function () {

    Route::resource('users', UserController::class);
    Route::resource('reports', ReportController::class);
});

require __DIR__ . '/auth.php';
