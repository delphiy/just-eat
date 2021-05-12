<?php

use App\Http\Controllers\BasketController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Auth::routes();

Route::post('restaurants', [RestaurantController::class, 'index'])->name('search.restaurants');
Route::get('restaurant/{slug}', [ProductController::class, 'index'])->name('restaurant.products');
Route::get('home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth', 'web']], function() {

    //Basket
    Route::get('/basket', [BasketController::class, 'index'])->name('basket.index');
    Route::post('/basket', [BasketController::class, 'store'])->name('basket.store');

    //Checkout
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::get('/user/setup-intent', [UserController::class, 'getSetupIntent']);
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

    //Stripe
    Route::get('/user/payment-methods', [UserController::class, 'getPaymentMethods'])->name('user.paymentMethods');

    //Account
    Route::get('/account', [UserController::class, 'myAccount'])->name('my-account');
    Route::get('/track-order', [UserController::class, 'trackOrder'])->name('my-account');

});
