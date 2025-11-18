<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Admin\ProkerController;



// Login routes
Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Admin dashboard
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::resource('room', RoomController::class);
    Route::get('/room/{room}/proker/index', [ProkerController::class, 'index'])->name('room.proker.index');
    Route::get('/room/{room}/proker/create', [ProkerController::class, 'create'])->name('room.proker.create');
    Route::post('/room/{room}/proker', [ProkerController::class, 'store'])->name('room.proker.store');
    Route::get('/timeline', [AdminController::class, 'timeline'])->name('timeline');
    Route::get('/documents', [AdminController::class, 'documents'])->name('documents');
});