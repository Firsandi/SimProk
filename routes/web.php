<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.login');
});


Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');