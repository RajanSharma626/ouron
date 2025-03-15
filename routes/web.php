<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CatProductsController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\LoginAuth;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('frontend.home');
});

Route::get('/home', function () {
    return view('frontend.home');
})->name('home');

Route::get('/about-us', function () {
    return view('frontend.about-us');
})->name('about.us');

Route::get('/faq', function () {
    return view('frontend.faq');
})->name('faq');

Route::get('/contact-us', function () {
    return view('frontend.contact-us');
})->name('contact.us');

Route::get('/blogs', function () {
    return view('frontend.blogs');
})->name('blogs');

Route::get('/product/{slug}', function () {
    return view('frontend.product-detail');
})->name('product.detail');


// login
Route::get('/login', [LoginAuth::class, 'index'])->name('login');
Route::post('/login', [LoginAuth::class, 'login'])->name('login.auth');

// register
Route::get('/register', [LoginAuth::class, 'register'])->name('register');
Route::post('/register', [LoginAuth::class, 'registerUser'])->name('registerUser');


// verify otp
Route::get('login/otp-verify', [LoginAuth::class, 'otpVerify'])->name('otp-verify');
Route::post('login/otp-verify', [LoginAuth::class, 'verifyOtp'])->name('verify-otp');

// logout
Route::post('/logout', [LoginAuth::class, 'logout'])->name('logout');

//profile
Route::middleware(['user.auth'])->group(function () {
    Route::get('/profile', [LoginAuth::class, 'profile'])->name('profile');
    Route::post('/profile', [LoginAuth::class, 'updateProfile'])->name('update-profile');

    //checkout
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');

    //checkout store
    Route::post('/checkout', [CheckoutController::class, 'checkout'])->name('checkout.store');
});





Route::get('/new-in', [CatProductsController::class, 'newIn'])->name('new.in');
Route::get('/all-product', [CatProductsController::class, 'allProduct'])->name('all-product');


// Policy Routes
Route::get('/shipping-policy', function () {
    return view('frontend.shipping-policy');
})->name('shipping-policy');

Route::get('/refund-exchange-policy', function () {
    return view('frontend.refund-exchange-policy');
})->name('refund-exchange-policy');

Route::get('/terms-and-conditions', function () {
    return view('frontend.terms-and-conditions');
})->name('terms-and-conditions');

Route::get('/privacy-policy', function () {
    return view('frontend.privacy-policy');
})->name('privacy-policy');



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

    Route::get('/products/edit/{id}', [ProductController::class, 'edit'])->name('admin.products.edit');

    Route::get('/products/add', [ProductController::class, 'add'])->name('admin.products.add');
    Route::post('/products/store', [ProductController::class, 'store'])->name('admin.products.store');
    Route::get('/products/delete/{id}', [ProductController::class, 'destroy'])->name('product.delete');
    Route::post('/products/update', [ProductController::class, 'update'])->name('product.update');


    Route::get('/category', [CategoryController::class, 'index'])->name('admin.category');
    Route::get('/category/add', function () {
        return view('admin.category-add');
    })->name('admin.category.add');
    Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store');
    Route::get('/category/delete/{id}', [CategoryController::class, 'destroy'])->name('category.delete');
});
