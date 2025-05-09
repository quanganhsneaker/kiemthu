<?php
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\ReviewController;
use App\Models\Order;
use App\Models\Product; 
use App\Http\Controllers\Admin\orderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UploadController;
use App\Http\Controllers\FontendController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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
    // doanh thu admin
Route::get('/admin/statistics/revenue', [orderController::class, 'doanhthu'])->name('statistics.revenue');
//  thống kê đơn hàng admin
Route::get('/admin/statistics/orders', [orderController::class, 'orderStatistics'])->name('statistics.orders');
// thống kê user
Route::get('/user-statistics', [orderController::class, 'userStatistics'])->name('user.statistics');
Route::get('/admin/dashboard', [orderController::class, 'dashboard'])->name('admin.dashboard');
Route::delete('/admin/user/delete/{id}', [orderController::class, 'destroy'])->name('admin.user.delete');


Route::get('/admin/news/edit-images', [FontendController::class, 'edit'])->name('admin.edit.images');
Route::post('/admin/update-media', [FontendController::class, 'updateMedia'])->name('admin.update.media');

// Trang chỉnh sửa nội dung của admin
Route::get('/admin/news/edit_content', [FontendController::class, 'content'])->name('admin.edit.content');

// Route cho hành động cập nhật nội dung
Route::put('/admin/news/update_content', [FontendController::class, 'updateContent'])->name('admin.updateContent');
// khiếu nại admin 
Route::get('/admin/complaints', [ComplaintController::class, 'index'])->middleware('auth')->name('admin.complaints');
});
Route::patch('/admin/complaints/{id}/confirm', [ComplaintController::class, 'confirm'])->middleware('auth')->name('admin.complaints.confirm');

// khiếu nại user
Route::post('/submit_complaint', [ComplaintController::class, 'store'])->name('complaint.store');

// upload
Route::post('/upload',[UploadController::class,'uploadImage']);
Route::post('/uploads',[UploadController::class,'uploadImages']);
// fontend
Route::get('/', [FontendController:: class,'index'])->name('index');
Route::get('/product/{id}', [FontendController::class,'show_product']);

Route::get('/oder/confirm/{id}', [FontendController::class, 'confirmOrder'])->name('oder.confirm');
Route::get('/oder/success', function () {return view('oder.success');});
// cart
Route::post('/cart/add', [FontendController::class,'add_cart']);
Route::get('/cart', [FontendController::class,'show_cart'])->name('show_cart');
Route::get('/cart/delete/{id}', [FontendController::class,'delete_cart']);
Route::post('/cart/update', [FontendController::class,'update_cart']);
Route::post('/cart/send', [FontendController::class,'send_cart']);
// infor

Route::get('/info', [FontendController::class,'info']);
// contact
Route::get('/contact',function(){return view('contact');});
// type
Route::get('/producttype', [ProductController::class, 'productType']);
// feature 1
Route::get('/teddyshopf1', [FontendController::class, 'teddyshopf1'])->name('teddyshopf1');
Route::get('/teddyshopf2', [FontendController::class, 'teddyshopf2'])->name('teddyshopf2');
// 
Route::get('/search', [ProductController::class, 'ajaxSearch'])->name('ajax.search');

Route::get('/logins', [FontendController::class, 'logins'])->name('logins'); 
Route::post('/logins', [FontendController::class, 'postlogins']);   
Route::get('/register', [FontendController::class, 'register'])->name('register'); 
Route::post('/register', [FontendController::class, 'postregister'])->name('postregister'); 
Route::get('/logout', [FontendController::class, 'logout'])->name('logout'); 
// quản lý đơn hàng user
Route::get('/my-orders', [FontendController::class, 'myOrders'])->name('my.orders');
Route::get('/order/{id}', [FontendController::class, 'orderDetails'])->name('order.details')->middleware('auth');
// chat
Route::get('/chatuser', [FontendController::class, 'chatUser'])->name('chatuser');
Route::post('/send-message', [FontendController::class, 'sendMessage'])->name('send.message');
Route::post('/send-admin-message', [FontendController::class, 'sendAdminMessage'])->name('send.admin.message');
Route::get('/admin/chat/list_users', [FontendController::class, 'listUsers'])->name('admin.chat.list_users');
Route::get('/admin/chat/user/{id}', [FontendController::class, 'chatWithUser'])->name('admin.chat.user');
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');
Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
Route::get('/product/{id}', [FontendController::class, 'showProduct'])->name('product.show');