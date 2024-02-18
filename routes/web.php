<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::controller(App\Http\Controllers\FrontendController::class)->group(function() {
    Route::get('/', 'index')->name('index');
    Route::get('/about', 'about')->name('about');
    Route::get('/favorite', 'favorite')->name('favorite');
    Route::get('/menu', 'menu')->name('menu');
    Route::get('/menuDetail/{id}', 'menuDetail')->name('menuDetail');
    Route::get('/blog', 'blog')->name('blog');
    Route::get('/contact', 'contact')->name('contact');
    Route::middleware(['auth'])->group(function () {
        Route::get('/cart', 'cart')->name('cart');
        Route::post('/post_cart', 'post_cart')->name('post_cart');
        Route::post('/plus_cart', 'plus_cart')->name('plus_cart');
        Route::post('/minus_cart', 'minus_cart')->name('minus_cart');
        Route::delete('/delete_cart', 'delete_cart')->name('delete_cart');
        Route::get('/checkout/{id}', 'checkout')->name('checkout');
        Route::post('/post_checkout', 'post_checkout')->name('post_checkout');
        Route::get('/payment/{id}', 'payment')->name('payment');
        Route::post('/midtrans_notify', 'midtrans_notify')->name('midtrans_notify');
        Route::post('/midtrans_pay', 'midtrans_pay')->name('midtrans_pay');
        Route::post('/payments_finish', 'payments_finish')->name('payments_finish');
        Route::get('/get-order', 'getOrder')->name('getOrder');
    });
});
Route::post('payments/midtrans-notification', [App\Http\Controllers\PaymentCallbackController::class, 'receive']);

Auth::routes([
    'login'    => true,
    'logout'   => true,
    'register' => true,
    'reset'    => false,
    'confirm'  => false,
    'verify'   => false,
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('products', App\Http\Controllers\ProductController::class);
