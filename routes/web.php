<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Payment\VNpayController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/', [ProductController::class, 'index']);

Route::get('master', function () {
    return view('Admin.master');
});

Route::get('index', [ProductController::class, 'index'])->name('index');

//Đặt hàng
Route::get('checkout', [ProductController::class, 'checkout'])->name('checkout');
Route::post('checkout', [ProductController::class, 'postCheckout'])->name('postCheckout');
//VNPAY
Route::get('/vnpay-index', function () {
    return view('VNPAY/vnpay-index');
});
Route::post('/vnpay/create_payment', [VNpayController::class, 'createPayment'])->name('postCreatePayment');
Route::get('/vnpay_return', [VNpayController::class, 'vnpayReturn'])->name('vnpayReturn');

//Others
Route::get('about', function () {
    return view('Others.about');
})->name('about');

Route::get('test', function () {
    return view('welcome');
});

Route::get('contact', function () {
    return view('Others.contact');
})->name('contact');


//Feature Account
Route::get('login', [UserController::class, 'getLogin'])->name('login');
Route::post('login', [UserController::class, 'postLogin'])->name('login');
Route::get('logout', [UserController::class, 'logout'])->name('logout');

Route::get('sign-up', [UserController::class, 'getSignup'])->name('sign-up');
Route::post('sign-up', [UserController::class, 'postSignup'])->name('postSignup');

Route::get('detail/{id}', [ProductController::class, 'show'])->name('detail-product');
Route::get('type/{id}', [ProductController::class, 'typeProduct'])->name('type-product');

//Cart
//để liên kết với nút hình Giỏ hàng để thêm sản phẩm vào giỏ hàng
Route::get('/add-to-cart/{id}', [ProductController::class, 'addToCart'])->name('addtocart');
Route::get('/add-many-to-cart/{id}', [ProductController::class, 'addManyToCart'])->name('addmanytocart');
Route::get('/delete-cart/{id}', [ProductController::class, 'delCart'])->name('delete-cart');

Route::get('admin/login', [AdminController::class, 'getLogin'])->name('admin.getLogin');
Route::post('admin/login', [AdminController::class, 'postLogin'])->name('admin.postLogin');

Route::prefix('admin')->middleware(['middleware' => 'adminLogin'])->group(function () {
    Route::get('logout', [AdminController::class, 'logout'])->name('admin.logout');
    Route::any('', function () {
        return redirect()->route('order.list');
    });
    Route::prefix('product')->group(function () {
        Route::get('add', [AdminController::class, 'getAddProduct'])->name('product.add');
        Route::get('edit', [AdminController::class, 'getEditProduct'])->name('product.edit');
        Route::get('list', [AdminController::class, 'getListProduct'])->name('product.list');
    });

    Route::prefix('orders')->group(function () {
        Route::any('', function () {
            return redirect()->route('order.list');
        });

        Route::get('list', [OrderController::class, 'getListOrder'])->name('order.list');
        Route::get('waiting', [OrderController::class, 'waiting'])->name('order.waiting');

        Route::get('payment', [VNpayController::class, 'getvnpay'])->name('order.payment');


        Route::get('confirmed', [OrderController::class, 'confirmed'])->name('order.confirmed');
        Route::get('confirmed/{id}', [OrderController::class, 'setConfirmed'])->name('order.setConfirmed');

        Route::get('delivering', [OrderController::class, 'delivering'])->name('order.delivering');
        Route::get('delivering/{id}', [OrderController::class, 'setDelivering'])->name('order.setDelivering');

        Route::get('delivered', [OrderController::class, 'delivered'])->name('order.delivered');
        Route::get('delivered/{id}', [OrderController::class, 'setDelivered'])->name('order.setDelivered');

        Route::get('cancelled', [OrderController::class, 'cancelled'])->name('order.cancelled');
        Route::get('cancelled/{id}', [OrderController::class, 'setCancelled'])->name('order.setCancelled');
        Route::get('returnOrder/{id}', [OrderController::class, 'returnOrder'])->name('order.return');
        Route::get('deleted/{id}', [OrderController::class, 'returnOrder'])->name('order.deleted');
    });
});
