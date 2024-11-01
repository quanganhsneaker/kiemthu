<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class orderController extends Controller
{
    //
    public function list_order(){
        $orders = Order::all();
        return view("admin.order.list",[
            'orders' => $orders
        ]);
        
    }
    public function details_order(Request $request){
        $order_detail = json_decode($request ->order_detail,true);
        $product_id = array_keys($order_detail);
        $products = Product::whereIn('id', $product_id)->get();
        // dd($products);
        return view('admin.order.detail',[
            'products' => $products,
            'order_detail' => $order_detail
        ]);
    }
    public function delete_order($id)
{
    $order = Order::findOrFail($id);
    $order->delete();

    return redirect()->route('order.list')->with('success', 'Xóa đơn hàng thành công!');
}
public function confirm_order($id)
{
    $order = Order::findOrFail($id);
    $order->status = 'Đã xác nhận'; // Cập nhật trạng thái
    $order->save();

    return redirect()->route('order.list')->with('success', 'Đơn hàng đã được xác nhận!');
}


}
