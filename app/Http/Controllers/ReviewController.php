<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Product;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'product_id' => 'required|exists:products,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string',
        ]);
    
        // Kiểm tra nếu đã tồn tại đánh giá cho order_id, product_id và user_id
        $existingReview = Review::where('order_id', $request->order_id)
            ->where('product_id', $request->product_id)
            ->where('user_id', auth()->id()) // Đảm bảo chỉ kiểm tra đánh giá của người dùng hiện tại
            ->exists(); // Sử dụng exists để tối ưu hóa
    
        if ($existingReview) {
            return back()->with('error', 'Bạn đã đánh giá sản phẩm này trong đơn hàng này rồi.');
        }
    
        // Tạo đánh giá mới
        Review::create([
            'user_id' => auth()->id(),
            'order_id' => $request->order_id,
            'product_id' => $request->product_id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);
    
        return back()->with('success', 'Đánh giá của bạn đã được gửi.');
    }
 
    
    
}
