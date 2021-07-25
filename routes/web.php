<?php

use App\Http\Controllers\Dashboard\AboutController;
use App\Http\Controllers\Dashboard\AdminController;
use App\Http\Controllers\Dashboard\AgentController;
use App\Http\Controllers\Dashboard\BrandController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\CityController;
use App\Http\Controllers\Dashboard\ContactController;
use App\Http\Controllers\Dashboard\CountryController;
use App\Http\Controllers\Dashboard\CouponController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\LoginController;
use App\Http\Controllers\Dashboard\OrderController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\RoleController;
use App\Http\Controllers\Dashboard\SettingController;
use App\Http\Controllers\Dashboard\SliderController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Site\CartController;
use App\Http\Controllers\Site\CheckoutController;
use App\Http\Controllers\Site\HomeController;
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



Route::prefix('admin')->group(function () {

    Route::get('login', [LoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('login', [LoginController::class, 'login'])->name('admin.login.post');
    Route::get('logout', [LoginController::class, 'logout'])->name('admin.logout');

    Route::middleware(['auth:admin'])->group(function () {

        Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');

        Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
        Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');

        Route::resource('admins', AdminController::class);

        Route::resource('agents', AgentController::class);

        Route::resource('users', UserController::class);
        Route::get('/users/orderlist/{id}', [UserController::class, 'order'])->name('users.orders');

        Route::resource('brands', BrandController::class);

        Route::resource('sliders', SliderController::class);

        Route::resource('categories', CategoryController::class);

        Route::resource('products', ProductController::class);

        Route::get('products/images/{id}', [ProductController::class, 'addImages'])->name('products.images');
        Route::post('products/images', [ProductController::class, 'saveProductImages'])->name('products.images.store');
        Route::post('products/images/db', [ProductController::class, 'saveProductImagesDB'])->name('products.images.store.db');
        Route::get('products/images/{id}/delete', [ProductController::class, 'deleteImages'])->name('products.images.delete');

        Route::resource('countries', CountryController::class);

        Route::resource('cities', CityController::class);

        Route::resource('coupons', CouponController::class);

        Route::resource('roles', RoleController::class);


        Route::resource('orders', OrderController::class)->except(['create', 'store', 'destroy']);
        Route::get('/order/print/{id}', [OrderController::class, 'print'])->name('order.print');

        Route::resource('contacts', ContactController::class)->only(['index', 'show', 'destroy']);

        Route::get('/abouts', [AboutController::class, 'index'])->name('abouts.index');
        Route::post('/abouts/{id}', [AboutController::class, 'update'])->name('abouts.update');


    });

});

/*Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');*/


Route::prefix('')->group(function () {

    Route::get('/', [HomeController::class, 'index'])->name('home.index');

    Route::get('/search', [HomeController::class, 'search'])->name('search');

    Route::get('/profile/{id}', [HomeController::class, 'profile'])->name('profile');
    Route::post('/updateProfile/{id}', [HomeController::class, 'updateProfile'])->name('updateProfile');

    Route::get('/about', [HomeController::class, 'about'])->name('home.about');

    Route::get('contactus', [HomeController::class, 'contactus'])->name('contactus');
    Route::post('contactus', [HomeController::class, 'contactusAdd'])->name('contactus.store');

    Route::get('/categories', [HomeController::class, 'categories'])->name('categories');

    Route::get('/brands', [HomeController::class, 'brands'])->name('brands');

    Route::get('/products', [HomeController::class, 'products'])->name('products');
    Route::get('/product/{id}', [HomeController::class, 'productShow'])->name('product.show');
    Route::post('/product/add/cart', [HomeController::class, 'addToCart'])->name('product.add.cart');

    Route::get('/cart', [CartController::class, 'index'])->name('checkout.cart');
    Route::get('/cart/item/{id}/remove', [CartController::class, 'removeItem'])->name('checkout.cart.remove');
    Route::get('/cart/clear', [CartController::class, 'clearCart'])->name('checkout.cart.clear');

    Route::group(['middleware' => ['auth']], function () {

        Route::post('products/toggle_favorite/{product}', [HomeController::class, 'toggle_favorite'])->name('product.toggle_favorite');


        Route::get('/checkout', [CheckoutController::class, 'getCheckout'])->name('checkout.index');
        Route::post('/checkout/order', [CheckoutController::class, 'placeOrder'])->name('checkout.place.order');
        Route::get('/coupon/check', [CheckoutController::class, 'couponCheck'])->name('coupon.check');

        Route::view('/moyasar', 'frontend.moyasar-payment');

        Route::get('/payments_redirect/{id}', [CheckoutController::class, 'moyasarResponce'])->name('order.moyasarResponce');

        Route::get('myOrders/{id}', [HomeController::class, 'myOrders'])->name('myOrders');

    });
});



require __DIR__ . '/auth.php';


