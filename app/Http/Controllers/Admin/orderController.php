<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
class orderController extends Controller
{
    //
    public function list_order(){
        $orders = Order::all();
        $title ='Danh sách đơn hàng';
        return view("admin.order.list",[
            'orders' => $orders,
            'title' => 'Danh sách đơn hàng',
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
// ===============================================diệu==================================================================
public function doanhthu()
{
    $title = 'Thống kê doanh thu';
    // Lấy ngày đầu tiên và ngày cuối cùng của tuần này
    $startOfWeek = Carbon::now()->startOfWeek();
    $endOfWeek = Carbon::now()->endOfWeek();

    // Lấy ngày đầu tiên và ngày cuối cùng của tuần trước
    $startOfLastWeek = Carbon::now()->subWeek()->startOfWeek();
    $endOfLastWeek = Carbon::now()->subWeek()->endOfWeek();

    // Lấy các đơn hàng trong tuần này và tuần trước
    $ordersThisWeek = Order::whereBetween('created_at', [$startOfWeek, $endOfWeek])->get();
    $ordersLastWeek = Order::whereBetween('created_at', [$startOfLastWeek, $endOfLastWeek])->get();

    // Tính doanh thu tuần này
    $revenueThisWeek = $this->calculateRevenue($ordersThisWeek);

    // Tính doanh thu tuần trước
    $revenueLastWeek = $this->calculateRevenue($ordersLastWeek);

    // Tạo dữ liệu cho biểu đồ
    $labels = ['Tuần này', 'Tuần trước'];
    $revenues = [$revenueThisWeek, $revenueLastWeek];

    return view('admin.statistics.revenue', [
           'title' => 'Thống kê doanh thu',
        'revenues' => json_encode($revenues),
        'labels' => json_encode($labels),
        'revenueThisWeek' => $revenueThisWeek, // Truyền biến này
        'revenueLastWeek' => $revenueLastWeek  // Truyền biến này
    ]);
}

// tính 
private function calculateRevenue($orders)
{
    $totalRevenue = 0;

    foreach ($orders as $order) {
      
        $orderDetails = json_decode($order->order_detail, true);

        if (is_array($orderDetails)) {
            foreach ($orderDetails as $productId => $quantity) {
                // Tìm sản phẩm theo ID
                $product = Product::find($productId);

                if ($product) {
                    // Tính thành tiền và cộng vào tổng doanh thu
                    $totalRevenue += $product->price_nomal * $quantity;
                }
            }
        }
    }

    return $totalRevenue;
}


    //  thống kê đơn hàng
    public function orderStatistics()
    {
        $title ="Thống kê đơn hàng";
        // Lấy tổng số đơn hàng
        $tong  = Order::count();
    
        // Lấy số đơn hàng chua xasc nhan (giả sử status = 0 là đang chờ)
        $chuaxacnhan = Order::where('status', '0')->count( ); // Sử dụng '0' cho giá trị string
    
        // Tính số đơn hàng đã xác nhận
        $daxacnhan = $tong - $chuaxacnhan; // Tổng đơn hàng - Đơn hàng đang chờ
    
        return view('admin.statistics.orders', [
            'title' => 'Thống kê đơn hàng',
            'tong' => $tong,
            'daxacnhan' => $daxacnhan,
            'chuaxacnhan' => $chuaxacnhan
        ]);
    }
    // ==========================================================================================================================================
    public function userStatistics()
    {
        $title = " Người dùng (user)";
    
        // Lấy danh sách người dùng trừ người có id = 1
        $users = User::select('id', 'name', 'email', 'created_at')
                     ->where('id', '!=', 1) // Loại bỏ người dùng có id = 1
                     ->get();
    
        // Tính tổng số người dùng
        $totalUsers = $users->count(); // Đếm tổng số người dùng
    
        return view('admin.statistics.users', [
            'title' => $title,
            'users' => $users, // Gửi danh sách người dùng vào view
            'totalUsers' => $totalUsers // Gửi tổng số người dùng vào view
        ]);
    }
    
    public function destroy($id)
{
    // Tìm người dùng theo ID
    $user = User::find($id);

    if (!$user) {
        return redirect()->back()->with('error', 'Người dùng không tồn tại!');
    }

    try {
        // Xóa người dùng
        $user->delete();
        return redirect()->back()->with('success', 'Xóa người dùng thành công!');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Đã xảy ra lỗi khi xóa người dùng.');
    }
}

    
    public function dashboard()
    {
        // Tính tổng doanh thu từ bảng đơn hàng
        $totalOrders = Order::count(); // Tổng số đơn hàng
        $orders = Order::all(); // Lấy tất cả các đơn hàng để tính doanh thu
        $totalRevenue = $this->calculateRevenue($orders); // Gọi hàm calculateRevenue để tính doanh thu
        $totalUsers = User::count(); // Đếm tổng số người dùng
        // Trả về view cùng với biến tổng doanh thu
        return view('admin.dashboard', [
            'totalOrders' => $totalOrders,
            'totalRevenue' => $totalRevenue, // Truyền tổng doanh thu vào view
            'totalUsers' => $totalUsers, // Truyền tổng số người dùng vào view
        ]);
    }
 
    
}
