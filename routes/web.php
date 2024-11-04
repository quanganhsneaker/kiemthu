<?php
use App\Models\Product; 
use App\Http\Controllers\Admin\orderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UploadController;
use App\Http\Controllers\FontendController;
use Illuminate\Support\Facades\Route;
// login 
Route::get('/login',[FontendController::class,'show_login'])->name('login');
Route::post('/check_login',[FontendController::class,'check_login']);
// Admin
Route::middleware('auth')->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/', function() {
            return view('admin.home');
        })->name('admin.home');

        // Route quản lý sản phẩm
        Route::prefix('product')->group(function () {
            Route::get('list', [ProductController::class, 'list_product'])->name('product.list');
            Route::post('add', [ProductController::class, 'insert_product'])->name('product.add');
            Route::get('create', [ProductController::class, 'add_product'])->name('product.create');
            Route::get('delete', [ProductController::class, 'delete_product'])->name('product.delete');
            Route::get('edit/{id}', [ProductController::class, 'edit_product'])->name('product.edit');
            Route::post('edit/{id}', [ProductController::class, 'update_product'])->name('product.update');
        });

        // Route quản lý đơn hàng
        Route::prefix('oder')->group(function () {
            Route::get('list', [orderController::class, 'list_order'])->name('order.list');
            Route::get('details/{order_detail}', [orderController::class, 'details_order'])->name('order.details');
            Route::delete('delete/{id}', [orderController::class, 'delete_order'])->name('order.delete');
            Route::post('confirm/{id}', [orderController::class, 'confirm_order'])->name('order.confirm');

        });
    });
});


// upload
Route::post('/upload',[UploadController::class,'uploadImage']);
Route::post('/uploads',[UploadController::class,'uploadImages']);
// fontend
Route::get('/', [FontendController:: class,'index'])->name('index');
Route::get('/product/{id}', [FontendController::class,'show_product']);

Route::get('/oder/confirm', function () {return view('oder.confirm');});
Route::get('/oder/success', function () {return view('oder.success');});
// cart
Route::post('/cart/add', [FontendController::class,'add_cart']);
Route::get('/cart', [FontendController::class,'show_cart'])->name('show_cart');
Route::get('/cart/delete/{id}', [FontendController::class,'delete_cart']);
Route::post('/cart/update', [FontendController::class,'update_cart']);
Route::post('/cart/send', [FontendController::class,'send_cart']);
// infor
Route::get('/info',function(){return view('info');});
// contact
Route::get('/contact',function(){return view('contact');});
// type
Route::get('/producttype', function () {
    $products = Product::all();
    return view('producttype', compact('products'));
});
// 
Route::get('/search', [ProductController::class, 'ajaxSearch']); // Thay đổi tên phương thức
Route::get('/logins', [FontendController::class, 'logins'])->name('logins'); 
Route::post('/logins', [FontendController::class, 'postlogins']);   
Route::get('/register', [FontendController::class, 'register'])->name('register'); 
Route::post('/register', [FontendController::class, 'postregister']); 
Route::get('/logout', [FontendController::class, 'logout'])->name('logout'); 
// quản lý đơn hàng user
Route::get('/my-orders', [FontendController::class, 'myOrders'])->name('my.orders');
Route::get('/order/{id}', [FontendController::class, 'orderDetails'])->name('order.details')->middleware('auth');
// doanh thu admin
Route::get('/admin/statistics/revenue', [orderController::class, 'revenueStatistics'])->name('statistics.revenue');
//  thống kê đơn hàng admin
Route::get('/admin/statistics/orders', [orderController::class, 'orderStatistics'])->name('statistics.orders');
// thống kê user
Route::get('/user-statistics', [orderController::class, 'userStatistics'])->name('user.statistics');
Route::get('/admin/dashboard', [orderController::class, 'dashboard'])->name('admin.dashboard');

