<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('frontend.home');
})->name('home');

Route::get('/product/{slug}', function () {
    return view('frontend.product-detail');
})->name('product.detail');



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

    Route::get('/products', [ProductController::class, 'index'])->name('admin.products');

    Route::get('/products/edit', function () {
        return view('admin.product-edit');
    })->name('admin.products.edit');

    Route::get('/products/add', [ProductController::class, 'add'])->name('admin.products.add');

    Route::get('/category', [CategoryController::class, 'index'])->name('admin.category');

    Route::get('/category/add', function () {
        return view('admin.category-add');
    })->name('admin.category.add');

    Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store');

    Route::get('/category/delete/{id}', [CategoryController::class, 'destroy'])->name('category.delete');
});
