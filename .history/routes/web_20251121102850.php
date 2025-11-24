<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\User\UserDashboardController;
use App\Http\Controllers\User\RoomController as UserRoomController;
use App\Http\Controllers\User\DocumentController;
use App\Http\Controllers\User\NotificationController;
use App\Http\Controllers\Admin\RoomController as AdminRoomController;
use App\Http\Controllers\Admin\ProkerController;

// Login routes
Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Admin routes
// Route::prefix('admin')->name('admin.')->group(function () {
//     Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
//     Route::resource('room', AdminRoomController::class);
//     Route::get('/room/{room}/proker/index', [ProkerController::class, 'index'])->name('room.proker.index');
//     Route::get('/room/{room}/proker/create', [ProkerController::class, 'create'])->name('room.proker.create');
//     Route::post('/room/{room}/proker', [ProkerController::class, 'store'])->name('room.proker.store');
//     Route::get('/timeline', [AdminController::class, 'timeline'])->name('timeline');
//     Route::get('/documents', [AdminController::class, 'documents'])->name('documents');
// });

Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Room resource
    Route::resource('room', AdminRoomController::class);

    // Proker nested di dalam Room
    Route::get('/room/{room}/proker/index', [ProkerController::class, 'index'])->name('room.proker.index');
    Route::get('/room/{room}/proker/create', [ProkerController::class, 'create'])->name('room.proker.create');
    Route::post('/room/{room}/proker', [ProkerController::class, 'store'])->name('room.proker.store');
    Route::get('/room/{room}/proker/{proker}/edit', [ProkerController::class, 'edit'])->name('room.proker.edit');
    Route::put('/room/{room}/proker/{proker}', [ProkerController::class, 'update'])->name('room.proker.update');
    Route::delete('/room/{room}/proker/{proker}', [ProkerController::class, 'destroy'])->name('room.proker.destroy');

    // Admin extras
    Route::get('/timeline', [AdminController::class, 'timeline'])->name('timeline');
    Route::get('/documents', [AdminController::class, 'documents'])->name('documents');
});


// User routes
Route::middleware('role:user', 'ver')->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
    Route::get('/rooms', [UserRoomController::class, 'index'])->name('rooms');
    Route::get('/room/{id}', [UserRoomController::class, 'show'])->name('room.detail');
    Route::get('/documents', [DocumentController::class, 'index'])->name('documents');
    Route::get('/document/create/{roomId}', [DocumentController::class, 'create'])->name('document.create');
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications');
    Route::get('/notifications/unread-count', [NotificationController::class, 'unreadCount'])->name('notifications.unread-count');
    Route::get('/timeline', fn() => view('user.timeline'))->name('timeline');
    Route::get('/profile', fn() => view('user.Profile'))->name('profile');

});
