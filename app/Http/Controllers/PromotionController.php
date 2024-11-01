<?php

// app/Http/Controllers/PromotionController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Promotion;

class PromotionController extends Controller
{
    public function applyPromotion(Request $request)
    {
        // Kiểm tra mã khuyến mãi có tồn tại và còn hạn không
        $promo = Promotion::where('code', $request->promo_code)
                          ->where('expires_at', '>=', now())
                          ->first();

        if ($promo) {
            // Tính tổng sau khi giảm giá
            $discount = $promo->discount;
            $newTotal = $request->total * (1 - $discount / 100);

            return response()->json([
                'new_total' => $newTotal, 
                'discount' => $discount,
                'message' => 'Mã khuyến mãi áp dụng thành công!'
            ]);
        }

        return response()->json([
            'error' => 'Mã khuyến mãi không hợp lệ hoặc đã hết hạn'
        ], 400);
    }
}
