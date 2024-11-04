<?php

namespace App\Http\Controllers;

use App\Mail\TestMail;
use App\Models\Order;
use App\Models\Promotion;
use App\Models\User;
use App\Notifications\EmailNotification;
use Arr;
use Auth;
use Hash;
use Illuminate\Http\Request;
use App\Models\product;
use Illuminate\Support\Facades\Mail;
use Notification;
use Session;
use Str;
use Illuminate\Foundation\Auth\User as Authenticatable;
class FontendController extends Controller
{
    public function index(){
        $products = product::all();
       
        return view("home",[
            'products' => $products,
        ]);
}
public function show_product(Request $request){
    $product = Product::find($request -> id);
    return view('product',[
        'product'=> $product
    ]);
}
public function info(Request $request){
    return view("info");
}
public function contact(Request $request){
    return view("contact");
}

public function producttype(Request $request) {
    $products = Product::all(); // Lấy tất cả sản phẩm
    return view('producttype', compact('products'));
}

public function add_cart(Request $request){
    $product_id = $request->product_id;
    $product_qty = $request->product_qty;

    if (is_null(Session::get('cart'))) {
        Session::put('cart', [
            $product_id => $product_qty
        ]);
    } else {
        $cart = Session::get('cart');
        if (Arr::exists($cart, $product_id)) {
            $cart[$product_id] = $cart[$product_id] + $product_qty;
        } else {
            $cart[$product_id] = $product_qty;
        }
        Session::put('cart', $cart);
    }

    // Tạo session flash message
    session()->flash('success', 'Bạn đã thêm vào giỏ hàng thành công!');

    return redirect('/cart');
}

public function show_cart() {
    $cart = Session::get('cart', []); // Trả về mảng rỗng nếu không có giá trị trong session
    $product_id = is_array($cart) ? array_keys($cart) : []; // Kiểm tra nếu cart là mảng

    $products = product::whereIn('id', $product_id)->get();

    return view('cart', [
        'products' => $products,
    ]);
}

public function delete_cart(Request $request){
    $cart = Session::get('cart');
    $product_id = $request -> id;
    unset($cart[$product_id]);
    Session::put('cart',$cart);
    return redirect('/cart');

}
public function update_cart(Request $request){
    $cart = $request -> product_id;
    Session::put('cart',$cart);
    return redirect('/cart');
}
public function send_cart(Request $request){
//    dd($request->all());
    
  $token = Str::random(12);
  $order = new Order();
  $order -> name = $request -> input('name');
  $order -> phone = $request -> input('phone');
  $order -> email = $request -> input('email');
  $order -> city = $request -> input('city');
  $order -> district = $request -> input('district');
  $order -> ward = $request -> input('ward');
  $order -> address = $request -> input('address');
  $order -> note = $request -> input('note');
  $order_detail = json_encode($request -> input('product_id'));
  $order -> order_detail = $order_detail;
  $order -> token =  $token;
  $order->user_id = Auth::id(); // Gán ID của người dùng hiện tại
  $order -> save();
  Session::forget('cart');
  $mailifor = $order -> email;
  $nameifor = $order -> name;
  $Mail = Mail::to($mailifor) -> send(new TestMail($nameifor));
Notification::send($order, new EmailNotification($order));
  return redirect('/oder/confirm');
}
public function show_login(){
    return view('login');
}
public function check_login(Request $request){
if(Auth::attempt(
    [
        'email'=> $request -> input('email'),
        'password'=> $request -> input('password')
    ]
))

{
    return redirect('admin');
}

return redirect() -> back();
;
}
public function logins(){
return view('logins');
}
public function register(){
return view('register');
}
public function postregister(Request $request){

$request -> merge(['password' =>Hash::make($request-> password)]);

try {

User::create($request->all());
} catch (\Throwable $th) {
    dd($th);
   
}
return redirect()-> route('logins');
}
public function postlogins(Request $request){
    if(Auth::attempt(['email' => $request-> email, 'password' => $request-> password])){
        return redirect()-> route('index');
    }else{
        return redirect()-> back();
    }

}
public function logout(Request $request){
    Auth::logout();
        return redirect()-> back();
    

}
public function myOrders() {
    // Lấy tất cả đơn hàng của người dùng hiện tại
    $orders = Order::where('user_id', Auth::id())->get();
    $products = Product::all(); // Lấy tất cả sản phẩm

    // Khởi tạo biến để tính tổng tiền của tất cả đơn hàng
    $grandTotal = 0;

    // Tính tổng tiền cho mỗi đơn hàng
    foreach ($orders as $order) {
        $order_detail = json_decode($order->order_detail, true); // Giả sử order_detail là JSON
        $total_price = 0; // Khởi tạo tổng tiền cho từng đơn hàng

        foreach ($order_detail as $product_id => $quantity) {
            // Tìm sản phẩm dựa trên product_id
            $product = $products->firstWhere('id', $product_id);
            if ($product) {
                $total_price += $product->price_nomal * $quantity; // Tính tổng tiền cho đơn hàng
            }
        }
        
        $order->total_price = $total_price; // Gán giá trị tổng tiền cho đơn hàng
        $grandTotal += $total_price; // Cộng tổng tiền của đơn hàng vào tổng tiền toàn bộ
    }

    return view('my_orders', [
        'orders' => $orders,
        'products' => $products,
        'grandTotal' => $grandTotal, // Truyền biến tổng tiền vào view
    ]);
}


public function orderDetails($id) {
    // Lấy chi tiết đơn hàng theo ID
    $order = Order::findOrFail($id);
    $order_detail = json_decode($order->order_detail, true);
    $products = Product::all(); // Thêm dòng này để gán giá trị cho $products
    return view('order_details', [
         'products' => $products,'order' => $order,
      
        'order_detail' => $order_detail,
    ]);
}

}