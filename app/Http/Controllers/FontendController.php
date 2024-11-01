<?php

namespace App\Http\Controllers;

use App\Mail\TestMail;
use App\Models\Order;
use App\Models\Promotion;
use App\Notifications\EmailNotification;
use Arr;
use Auth;
use Illuminate\Http\Request;
use App\Models\product;
use Illuminate\Support\Facades\Mail;
use Notification;
use Session;
use Str;
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

public function show_cart(){
$cart = Session::get('cart');
$product_id = array_keys($cart);

$products = product::whereIn('id',$product_id) -> get();

return view('cart',[
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

}