<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminDashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('frontend.home');
})->name('home');



// ====================================================== Admin Panel Routes =============================================================

Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
    Route::post('/login', [AdminAuthController::class, 'login']);
    Route::get('/reset-password', [AdminAuthController::class, 'resetForm'])->name('admin.reset');
    Route::get('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
});


Route::middleware(['admin.auth'])->prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::get('/products', function () {
        return view('admin.product');
    })->name('admin.products');
});
