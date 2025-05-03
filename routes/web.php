<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CatProductsController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\frontend\HomeController;
use App\Http\Controllers\HeadlineController;
use App\Http\Controllers\LoginAuth;
use App\Http\Controllers\NewsLetterController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\frontend\ProductController as FrontendProductController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserAddressController;
use App\Http\Controllers\WishlistController;
use App\Models\Category;
use App\Models\Collections;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/about-us', function () {
    return view('frontend.about-us');
})->name('about.us');


Route::get('/contact-us', function () {
    return view('frontend.contact-us');
})->name('contact.us');


Route::get('/product/{slug}', [FrontendProductController::class, 'detail'])->name('product.detail');
Route::get('/new-in', [CatProductsController::class, 'newIn'])->name('new.in');
Route::get('/all-product', [CatProductsController::class, 'allProduct'])->name('all-product');
Route::get('/category/{cat}', [CatProductsController::class, 'catProduct'])->name('cat-product');
Route::get('/collection/{cat}', [CatProductsController::class, 'collectionProduct'])->name('collection-product');
Route::get('/best-seller', [CatProductsController::class, 'bestSellerProduct'])->name('best-seller');

Route::get('/live-search-suggestions', [SearchController::class, 'suggestions'])->name('live.search.suggestions');
Route::get('/search', action: [SearchController::class, 'search'])->name('search.view');

Route::post('/subscribe', [NewsLetterController::class, 'store'])->name('subscribe');

Route::post('/contact', [ContactController::class, 'submit']);

//faq
Route::get('/faq', [FaqController::class, 'index'])->name('faq');


// login
Route::get('/login', [LoginAuth::class, 'index'])->name('login');
Route::post('/login', [LoginAuth::class, 'login'])->name('login.auth');

// register
// Route::get('/register', [LoginAuth::class, 'register'])->name('register');
// Route::post('/register', [LoginAuth::class, 'registerUser'])->name('registerUser');


// verify otp
Route::get('login/otp-verify', [LoginAuth::class, 'otpVerify'])->name('otp-verify');
Route::post('login/otp-verify', [LoginAuth::class, 'verifyOtp'])->name('verify-otp');

// logout
Route::post('/logout', [LoginAuth::class, 'logout'])->name('logout');

//check User Ares Pin Code
Route::get('/check-pincode/{pin}', [CheckoutController::class, 'checkPincode']);

//track order
Route::get('track/order', [CheckoutController::class,'trackOrder'])->name('track.order');

//profile
Route::middleware(['user.auth'])->group(function () {
    Route::get('/profile', [LoginAuth::class, 'profile'])->name('profile');
    Route::post('/profile-update', [LoginAuth::class, 'updateProfile'])->name('profile.update');
    Route::post('/addresses', [UserAddressController::class, 'store'])->name('addresses.store');
    Route::delete('/addresses/{id}', [UserAddressController::class, 'destroy'])->name('addresses.destroy');
    Route::patch('/addresses/{id}/set-default', [UserAddressController::class, 'setDefault'])->name('addresses.setDefault');
    Route::put('/addresses/update/{id}', [UserAddressController::class, 'update'])->name('addresses.update');
    Route::get('/profile/order-detail/{id}', [OrderController::class, 'show'])->name('orders.show');

    //checkout
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');

    //checkout store
    Route::post('/checkout/buy/apply-coupon', [CheckoutController::class, 'applyBuyCoupon'])->name('checkout.buy.applyCoupon');
    Route::post('/checkout/apply-coupon', [CheckoutController::class, 'applyCoupon'])->name('checkout.applyCoupon');
    Route::get('/remove-coupon', [CouponController::class, 'removeCoupon'])->name('coupon.remove');

    Route::post('/checkout/remove-coupon', [CheckoutController::class, 'removeCoupon'])->name('checkout.removeCoupon');

    Route::post('/checkout/store', [CheckoutController::class, 'store'])->name('checkout.store');
    Route::post('/checkout/{id}/edit', [CheckoutController::class, 'editView'])->name('checkout.edit');

    Route::get('/order-success/{id}', function () {
        return view('frontend.order-success');
    })->name('order.success');

    Route::post('/wishlist/toggle', [WishlistController::class, 'toggleWishlist'])->name('wishlist.toggle');
    Route::get('/wishlist', [WishlistController::class, 'getWishlist'])->name('wishlist');

    Route::get('/buy', [CheckoutController::class, 'buy'])->name('buy');
    Route::get('/buy-now', [CheckoutController::class, 'buyNow'])->name('buy.now');
    Route::post('/buy-now/store', [CheckoutController::class, 'buyNowStore'])->name('buy.now.store');

    //cancel order
    Route::get('/order/cancel/{id}', [OrderController::class, 'cancel'])->name('order.cancel');

    //return order
    Route::post('/order/return/{id}', [OrderController::class, 'returnRequest'])->name('return.request');
    Route::post('/phonepe/callback', [PaymentController::class, 'phonepeCallback'])->name('phonepe.callback');
});




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

Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart', [CartController::class, 'getCart'])->name('cart.get');
Route::post('/cart/update', [CartController::class, 'updateCart'])->name('cart.update');
Route::delete('/cart/delete/{id}', [CartController::class, 'deleteCartItem'])->name('cart.delete');

Route::get('/product/details/{id}', [CartController::class, 'getProductDetails']);

//blogs
Route::get('/all-blogs', [BlogController::class, 'homeIndex'])->name('allblogs');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.detail');


// ====================================================== Admin Panel Routes =============================================================

Route::prefix('admin-panel')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
    Route::post('/login', [AdminAuthController::class, 'login']);
    Route::get('/reset-password', [AdminAuthController::class, 'resetForm'])->name('admin.reset');
    Route::get('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
});

Route::get('admin-panel/', function () {
    return redirect()->route('admin.dashboard');
});


Route::middleware(['admin.auth'])->prefix('admin-panel')->group(function () {


    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    Route::get('/products', [ProductController::class, 'index'])->name('admin.products');

    Route::get('/products/edit/{id}', [ProductController::class, 'edit'])->name('admin.products.edit');

    Route::get('/products/add', [ProductController::class, 'add'])->name('admin.products.add');
    Route::post('/products/store', [ProductController::class, 'store'])->name('admin.products.store');
    Route::get('/products/delete/{id}', [ProductController::class, 'destroy'])->name('product.delete');
    Route::post('/products/update', [ProductController::class, 'update'])->name('product.update');
    Route::delete('/product/image/delete/{id}', [ProductController::class, 'deleteImage'])->name('product.image.delete');
    Route::get('product/download-csv', [ProductController::class, 'downloadCSV'])->name('product.csv.download');

    //Stock
    Route::get('/stock', [ProductController::class, 'stock'])->name('admin.stock');
    Route::get('customers/download-csv', [CustomersController::class, 'downloadCSV'])->name('customers.csv.download');

    Route::get('/category', [CategoryController::class, 'index'])->name('admin.category');
    Route::get('/category/add', function () {
        return view('admin.category-add');
    })->name('admin.category.add');
    Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store');
    Route::get('/category/delete/{id}', [CategoryController::class, 'destroy'])->name('category.delete');
    Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('admin.category.edit');
    Route::post('/category/update', [CategoryController::class, 'update'])->name('category.update');

    //Collection
    Route::get('/collection', [CollectionController::class, 'index'])->name('admin.collection');

    Route::get('/collection/add', function () {
        return view('admin.collection-add');
    })->name('admin.collection.add');
    Route::post('/collection/store', [CollectionController::class, 'store'])->name('collection.store');
    Route::get('/collection/edit/{id}', [CollectionController::class, 'edit'])->name('collection.edit');
    Route::post('/collection/update', [CollectionController::class, 'update'])->name('collection.update');
    Route::get('/collection/delete/{id}', [CollectionController::class, 'destroy'])->name('collection.delete');


    //orders
    Route::get('/orders', [OrderController::class, 'index'])->name('admin.orders');
    Route::get('/order/view/{id}', [OrderController::class, 'view'])->name('admin.order.view');
    Route::get('orders/download-csv', [OrderController::class, 'downloadCSV'])->name('orders.csv.download');

    //coupons
    Route::get('/coupons', [CouponController::class, 'index'])->name('admin.coupons');
    Route::get('/coupons/add', function () {
        $categories = Category::all();
        $collections = Collections::all();
        $products = Product::all();
        return view('admin.coupon-add', compact('categories', 'collections', "products"));
    })->name('admin.coupons.add');
    Route::post('/coupons/store', [CouponController::class, 'store'])->name('admin.coupons.store');
    Route::get('/coupons/delete/{id}', [CouponController::class, 'destroy'])->name('admin.coupons.delete');
    Route::get('/coupons/edit/{id}', [CouponController::class, 'edit'])->name('admin.coupons.edit');
    Route::post('/coupons/update', [CouponController::class, 'update'])->name('admin.coupons.update');

    //Headlines
    Route::get('/headline', [HeadlineController::class, 'index'])->name('admin.headline');
    Route::post('/headline/store', [HeadlineController::class, 'store'])->name('admin.headline.store');
    Route::get('/headline/add', [HeadlineController::class, 'create'])->name('admin.headline.add');
    Route::get('/headline/delete/{id}', [HeadlineController::class, 'destroy'])->name('admin.headline.delete');
    Route::get('/headline/edit/{id}', [HeadlineController::class, 'edit'])->name('admin.headline.edit');
    Route::post('/headline/update', [HeadlineController::class, 'update'])->name('admin.headline.update');
    Route::post('headling/status/update', [HeadlineController::class,'toggleStatus'])->name('admin.headline.status.update');

    //Customers
    Route::get('/customers', [CustomersController::class, 'index'])->name('admin.customers');
    Route::get('customers/download-csv', [CustomersController::class, 'downloadCSV'])->name('customers.csv.download');


    //Blogs
    Route::get('/blogs', [BlogController::class, 'index'])->name('admin.blogs');
    Route::get('/blogs/add', [BlogController::class, 'create'])->name('admin.blogs.add');
    Route::post('/blogs/store', [BlogController::class, 'store'])->name('admin.blog.store');
    Route::get('/blog/edit/{id}', [BlogController::class, 'edit'])->name('admin.blog.edit');
    Route::post('/blog/update', [BlogController::class, 'update'])->name('admin.blog.update');
    Route::get('/blog/delete/{id}', [BlogController::class, 'destroy'])->name('admin.blog.delete');
    Route::get('/download/qr/{id}', [BlogController::class, 'downloadQr'])->name('admin.blog.qr.download');

    //Contact Form
    Route::get('/contact-form', [ContactController::class, 'index'])->name('admin.contact');
    Route::get('contact/download-csv', [ContactController::class, 'downloadCSV'])->name('contact.csv.download');

    //newsletter
    Route::get('/newsletter', [NewsLetterController::class, 'index'])->name('admin.newsletter');
    Route::get('newsletter/download-csv', [NewsLetterController::class, 'downloadCSV'])->name('newsletter.csv.download');

    //cart
    Route::get('/cart', [CartController::class, 'adminCart'])->name('admin.cart');
    Route::get('cart/download-csv', [CartController::class, 'downloadCSV'])->name('cart.csv.download');

    //wishlist
    Route::get('/wishlist', [WishlistController::class, 'adminWishlist'])->name('admin.wishlist');
    Route::get('/wishlist', [WishlistController::class, 'adminWishlist'])->name('admin.wishlist');
    Route::get('/wishlist/{id}/liked-users', [WishlistController::class, 'adminWishlistLiked'])->name('admin.wishlist.liked');
    Route::get('wishlist/download-csv/{id}', [WishlistController::class, 'downloadCSV'])->name('wishlist.csv.download');

    //confirm Order
    Route::get('/order/confirm/{id}', [OrderController::class, 'confirm'])->name('admin.order.confirm');

    //Return Order
    Route::get('/order/return/approve/{id}', [OrderController::class, 'returnedApprove'])->name('admin.order.returnedApprove');
    Route::get('/order/return/cancel/{id}', [OrderController::class, 'returnedCancel'])->name('admin.order.returnedCancel');
    Route::get('/order/return/{id}', [OrderController::class, 'return'])->name('admin.order.returned');
    Route::get('/order/refund/{id}', [OrderController::class, 'refund'])->name('admin.order.refunded');

    //Cancel Order
    Route::get('/order/cancel/{id}', [OrderController::class, 'AdminCancel'])->name('admin.order.cancel');


    //packed order
    Route::get('/order/packed/{id}', [OrderController::class, 'packed'])->name('admin.order.packed');

    //shipped order
    Route::get('/order/shipped/{id}', [OrderController::class, 'shipped'])->name('admin.order.shipped');

     //out for delivery order
     Route::get('/order/out-for-delivery/{id}', [OrderController::class, 'outForDelivery'])->name('admin.order.out.of.delivered');


    //delivered order
    Route::get('/order/delivered/{id}', [OrderController::class, 'delivered'])->name('admin.order.delivered');

    //FAQ
    Route::get('/faq', [FaqController::class, 'faq'])->name('admin.faq');
    Route::get('/faq/add', [FaqController::class, 'faqAdd'])->name('admin.faq.add');
    Route::post('/faq/store', [FaqController::class, 'faqStore'])->name('admin.faq.store');
    Route::get('/faq/edit/{id}', [FaqController::class, 'faqEdit'])->name('admin.faq.edit');
    Route::post('/faq/update/{id}', [FaqController::class, 'faqUpdate'])->name('admin.faq.update');
    Route::get('/faq/delete/{id}', [FaqController::class, 'faqDelete'])->name('admin.faq.delete');
});
