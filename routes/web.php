<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DocumentAdminController;
use App\Http\Controllers\Admin\RoomController as AdminRoomController;
use App\Http\Controllers\Admin\ProkerController;
use App\Http\Controllers\Admin\RoomMemberController;
use App\Http\Controllers\Admin\DocumentReviewController;
use App\Http\Controllers\User\UserDashboardController;
use App\Http\Controllers\User\DocumentController;
use App\Http\Controllers\User\NotificationController;
use App\Http\Controllers\User\ProfileController;

// ==========================================
// AUTH ROUTES (Tanpa Middleware - Public)
// ==========================================

// Login
Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Forgot Password
Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ForgotPasswordController::class, 'reset'])->name('password.update');

// ==========================================
// ADMIN ROUTES (Middleware: auth + role:admin)
// ==========================================
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

    //Dokumen
    Route::get('/dokumen', [\App\Http\Controllers\Admin\DocumentAdminController::class, 'index'])->name('dokumen.index');
    Route::get('/dokumen/{document}', [\App\Http\Controllers\Admin\DocumentAdminController::class, 'show'])->name('dokumen.show');
    Route::post('/dokumen/{document}/review', [\App\Http\Controllers\Admin\DocumentAdminController::class, 'review'])->name('dokumen.review');

    // Room Management
    Route::resource('room', AdminRoomController::class);

    // Proker Management (nested di dalam Room)
    Route::get('/room/{room}/proker/index', [ProkerController::class, 'index'])->name('room.proker.index');
    Route::get('/room/{room}/proker/create', [ProkerController::class, 'create'])->name('room.proker.create');
    Route::post('/room/{room}/proker', [ProkerController::class, 'store'])->name('room.proker.store');
    Route::get('/room/{room}/proker/{proker}/edit', [ProkerController::class, 'edit'])->name('room.proker.edit');
    Route::put('/room/{room}/proker/{proker}', [ProkerController::class, 'update'])->name('room.proker.update');
    Route::delete('/room/{room}/proker/{proker}', [ProkerController::class, 'destroy'])->name('room.proker.destroy');
    Route::get('/room/{room}/proker/{proker}', [ProkerController::class, 'show'])->name('room.proker.show');
    
    //  TAMBAH 2 BARIS INI - Proker Member Management
    Route::post('/room/{room}/proker/{proker}/add-member', [ProkerController::class, 'addMember'])->name('room.proker.addMember');
    Route::post('/room/{room}/proker/{proker}/remove-member', [ProkerController::class, 'removeMember'])->name('room.proker.removeMember');

    // Room Member Management
    Route::get('/room/{room}/member/create', [RoomMemberController::class, 'create'])->name('room.member.create');
    Route::post('/room/{room}/member', [RoomMemberController::class, 'store'])->name('room.member.store');
    Route::get('/room/{room}/member', [RoomMemberController::class, 'index'])->name('room.member.index');
    Route::get('/room/{room}/member/{member}/edit', [RoomMemberController::class, 'edit'])->name('room.member.edit');
    Route::put('/room/{room}/member/{member}', [RoomMemberController::class, 'update'])->name('room.member.update');
    Route::delete('/room/{room}/member/{member}', [RoomMemberController::class, 'destroy'])->name('room.member.destroy');

    // Document Review
    Route::get('/documents', [DocumentReviewController::class, 'index'])->name('documents.index');
    Route::get('/documents/{document}', [DocumentReviewController::class, 'show'])->name('documents.show');
    Route::post('/documents/{document}/review', [DocumentReviewController::class, 'store'])->name('documents.store');
    Route::get('/documents/{document}/download', [DocumentReviewController::class, 'download'])->name('documents.download');
});

// ==========================================
// USER ROUTES (Middleware: auth + role:sekretaris,bendahara)
// ==========================================
Route::middleware(['auth', 'role:sekretaris,bendahara'])->prefix('user')->name('user.')->group(function () {

    // Dashboard
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');

    // My Prokers
    Route::get('/myprokers', [UserDashboardController::class, 'myProkers'])->name('myprokers');

    // Profile Management
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/change-password', [ProfileController::class, 'changePassword'])->name('profile.change-password');

   //  NOTIFICATIONS - TAMBAH ROUTES INI
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications');
    Route::post('/notifications/{notification}/read', [NotificationController::class, 'read'])->name('notifications.read');
    Route::post('/notifications/read-all', [NotificationController::class, 'readAll'])->name('notifications.readAll');
    Route::delete('/notifications/{notification}', [NotificationController::class, 'destroy'])->name('notifications.destroy');
    Route::get('/notifications/unread-count', [NotificationController::class, 'unreadCount'])->name('notifications.unread-count');
    

    // Documents
    Route::get('/documents', [DocumentController::class, 'index'])->name('documents');
    Route::get('/documents/create/{proker}', [DocumentController::class, 'create'])->name('documents.create');
    Route::post('/documents', [DocumentController::class, 'store'])->name('documents.store');
    Route::get('/documents/{document}', [DocumentController::class, 'show'])->name('documents.show');
    Route::get('/documents/{document}/download', [DocumentController::class, 'download'])->name('documents.download');
    Route::delete('/documents/{document}', [DocumentController::class, 'destroy'])->name('documents.destroy');
});
