<?php

namespace App\Http\Controllers;

use App\Mail\TestMail;
use App\Models\Content;
use App\Models\Order;
use App\Models\Promotion;
use App\Models\Setting;
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
public function info(Request $request)
{
    // Truy vấn dữ liệu từ cơ sở dữ liệu (ví dụ lấy tất cả nội dung hoặc một bản ghi cụ thể)
    $content = Content::first(); // Hoặc Content::find(1) hoặc Content::all() tùy vào yêu cầu của bạn

    // Truyền dữ liệu vào view
    return view("info", compact('content'));
}

public function contact(Request $request){
    return view("contact");
}

public function producttype(Request $request) {
    $products = Product::all(); // Lấy tất cả sản phẩm
    return view('producttype', compact('products'));
}
// feature1
public function teddyshopf1(Request $request){
    return view("teddyshopf1");
}
public function teddyshopf2(Request $request){
    return view("teddyshopf2");
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

public function show_cart()
{
    // Lấy giỏ hàng từ session, trả về mảng rỗng nếu không có giá trị trong session
    $cart = Session::get('cart', []);

    // Kiểm tra nếu giỏ hàng là một mảng
    $product_ids = is_array($cart) ? array_keys($cart) : [];

    // Lấy thông tin các sản phẩm trong giỏ từ cơ sở dữ liệu
    $products = Product::whereIn('id', $product_ids)->get();

    // Tính tổng số lượng sản phẩm trong giỏ hàng
    $total_quantity = 0;
    foreach ($cart as $product_id => $quantity) {
        $total_quantity += $quantity;
    }

    // Trả về view giỏ hàng với các sản phẩm và tổng số lượng
    return view('cart', [
        'products' => $products,
        'total_quantity' => $total_quantity,
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
public function send_cart(Request $request)
{
    // Tạo mã token ngẫu nhiên cho đơn hàng
    $token = Str::random(12);
    
    // Lưu đơn hàng vào cơ sở dữ liệu
    $order = new Order();
    $order->name = $request->input('name');
    $order->phone = $request->input('phone');
    $order->email = $request->input('email');
    $order->city = $request->input('city');
    $order->district = $request->input('district');
    $order->ward = $request->input('ward');
    $order->address = $request->input('address');
    $order->note = $request->input('note');
    $order_detail = json_encode($request->input('product_id'));
    $order->order_detail = $order_detail;
    $order->token = $token;
    $order->user_id = Auth::id(); // Gán ID người dùng hiện tại
    $order->save();

    // Xóa giỏ hàng sau khi gửi đơn
    Session::forget('cart');

    // Gửi email xác nhận cho khách hàng (tuỳ chỉnh theo logic của bạn)
    Mail::to($order->email)->send(new TestMail($order->name));

    // Gửi thông báo
    Notification::send($order, new EmailNotification($order));

    // Chuyển hướng đến trang xác nhận với ID đơn hàng
    return redirect()->route('oder.confirm', ['id' => $order->id]);
}
// ================================================================quỳnh=======================================

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
// quỳnh 
// ===========================================================khánh=========================================================
public function myOrders() {
    $orders = Order::where('user_id', Auth::id())
    ->where('status', 'Đã xác nhận') 
    ->get();

    $products = Product::all();
    $grandTotal = 0;

    // Tính tổng tiền cho mỗi đơn hàng
    foreach ($orders as $order) {
        $order_detail = json_decode($order->order_detail, true); // Giải mã JSON
    
        // Kiểm tra nếu $order_detail là mảng, nếu không, gán giá trị mặc định
        if (!is_array($order_detail)) {
            $order_detail = []; // Gán giá trị mặc định nếu không phải là mảng
        }
    
        $total_price = 0; // Khởi tạo tổng tiền cho từng đơn hàng
    
        foreach ($order_detail as $product_id => $quantity) {
            // Tìm sản phẩm dựa trên product_id
            $product = $products->firstWhere('id', $product_id);
            if ($product) {
                $total_price += $product->price_nomal * $quantity; // Tính tổng tiền cho đơn hàng
            }
        }
    
        $order->total_price = $total_price; // Gán tổng tiền cho đơn hàng
        $grandTotal += $total_price; // Cộng tổng tiền của đơn hàng vào tổng tiền toàn bộ
    }
    

    return view('my_orders', [
        'orders' => $orders,
        'products' => $products,
        'grandTotal' => $grandTotal, 
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
// ==========================================================================hết khánh=================================================================================
public function edit()
{
    $sliderImage1 = \App\Models\Setting::where('key', 'slider_image_1')->value('value');
    $sliderImage2 = \App\Models\Setting::where('key', 'slider_image_2')->value('value');
    $sliderImage3 = \App\Models\Setting::where('key', 'slider_image_3')->value('value');
    $title = 'Quản lý hình ảnh sidebar'; // Đặt tiêu đề bạn muốn truyền vào view
    return view('admin.news.edit_images', compact('sliderImage1', 'sliderImage2', 'sliderImage3','title')); // Truyền dữ liệu vào view
}


// sửa hình ảnh side bar của admin lên trang user
public function updateMedia(Request $request)
{
    // Validate input
    $request->validate([
        'image1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'image2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'image3' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Upload images and get paths if they exist
    if ($request->hasFile('image1')) {
        $path1 = $request->file('image1')->store('images', 'public'); // Chỉ định lưu vào storage/app/public/images
        Setting::updateOrCreate(['key' => 'slider_image_1'], ['value' => $path1]);
    }

    if ($request->hasFile('image2')) {
        $path2 = $request->file('image2')->store('images', 'public'); // Chỉ định lưu vào storage/app/public/images
        Setting::updateOrCreate(['key' => 'slider_image_2'], ['value' => $path2]);
    }

    if ($request->hasFile('image3')) {
        $path3 = $request->file('image3')->store('images', 'public'); // Chỉ định lưu vào storage/app/public/images
        Setting::updateOrCreate(['key' => 'slider_image_3'], ['value' => $path3]);
    }



    return redirect()->back()->with('success', 'Cập nhật hình ảnh thành công!');
}
 public function content()
    {
        $title = 'Quản lý hình ảnh sidebar';
        $content = Content::first(); // Giả sử bạn chỉ có một bản ghi
        return view('admin.news.edit_content', compact('title', 'content'));
    }

    public function updateContent(Request $request)
    {
        $content = Content::find(1); // Lấy bản ghi đầu tiên hoặc theo ID động

        // Validate dữ liệu
        $validated = $request->validate([
            'promotion_title' => 'required|string|max:255',
            'promotion_description' => 'required|string',
            'remaining_quantity' => 'required|integer|min:0',
            'company_title' => 'required|string|max:255',
            'company_description' => 'required|string',
            'return_policy' => 'required|string',
            'feedback_text' => 'required|string',
            'hpvenus_image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'asustuf_image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'feedback_image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        // Cập nhật dữ liệu từ form
        $content->promotion_title = $request->promotion_title;
        $content->promotion_description = $request->promotion_description;
        $content->remaining_quantity = $request->remaining_quantity;
        $content->company_title = $request->company_title;
        $content->company_description = $request->company_description;
        $content->return_policy = $request->return_policy;
        $content->feedback_text = $request->feedback_text;
        $content->feature2_description = $request->feature2_description;

        // Xử lý hình ảnh
        if ($request->hasFile('hpvenus_image')) {
            $path = $request->file('hpvenus_image')->store('public/images');
            $content->hpvenus_image = basename($path);
        }

        if ($request->hasFile('asustuf_image')) {
            $path = $request->file('asustuf_image')->store('public/images');
            $content->asustuf_image = basename($path);
        }

        if ($request->hasFile('feedback_image')) {
            $path = $request->file('feedback_image')->store('public/images');
            $content->feedback_image = basename($path);
        }
        if ($request->hasFile('company_image')) {
            $path = $request->file('company_image')->store('public/images');
            $content->company_image = basename($path);
        }
        if ($request->hasFile('feature2_image')) {
            $path = $request->file('feature2_image')->store('public/images');
            $content->feature2_image = basename($path);
        }
        // Lưu bản ghi
        $content->save();

        // Thông báo thành công
        return redirect()->route('admin.edit.content')->with('success', 'Cập nhật nội dung thành công!');
    }
public function confirmOrder($id)
{
    $order = Order::findOrFail($id); // Lấy đơn hàng dựa trên ID
    $orderDetails = json_decode($order->order_detail, true); // Giải mã chi tiết đơn hàng
    
    // Lấy thông tin sản phẩm từ bảng products
    $products = Product::whereIn('id', array_keys($orderDetails))->get();
    
    // Trả về view và truyền thông tin đơn hàng và sản phẩm
    return view('oder.confirm', compact('order', 'orderDetails', 'products'));
}


public function chatUser()
{
    $messages = \App\Models\Message::where('user_id', auth()->id())->get();
    return view('chatuser', compact('messages'));
}



public function sendMessage(Request $request)
{
    \App\Models\Message::create([
        'user_id' => auth()->id(),
        'message' => $request->message,
        'is_admin' => false,
    ]);

    return response()->json(['success' => true]);
}

public function sendAdminMessage(Request $request)
{
    \App\Models\Message::create([
        'admin_id' => auth()->id(),
        'user_id' => $request->user_id,
        'message' => $request->message,
        'is_admin' => true,
    ]);

    return response()->json(['success' => true]);
}

public function listUsers()
{
    $title = "Danh sách tin nhắn";

    // Lấy danh sách user có tin nhắn và tin nhắn mới nhất
    $users = \App\Models\User::with('latest_message')->whereHas('messages')->get();

    return view('admin.chat.list_users', compact('users', 'title'));
}

public function chatWithUser($userId)
{
    $title ="Nhắn tin";
    $messages = \App\Models\Message::where('user_id', $userId)->get();
    $user = \App\Models\User::findOrFail($userId);
    return view('admin.chat.chat_with_user', compact('messages', 'user','title'));
}

}