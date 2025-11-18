<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\User\UserDashboardController;
use App\Http\Controllers\User\RoomController as UserRoomController;
use App\Http\Controllers\User\DocumentController;
use App\Http\Controllers\User\NotificationController;

// Login routes
Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Admin routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
});

// User routes
Route::prefix('user')->name('user.')->group(function () {
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
