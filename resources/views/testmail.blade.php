<h1>Hi! {{$nameifor}}</h1>
<h1> Xác nhận đơn hàng Teddy-Shop</h1>

Route::get('/producttype', function (Request $request) {
    // Lấy danh sách danh mục từ cột `category` trong bảng `products`
    $categories = Product::select('category')->distinct()->pluck('category')->toArray();

    // Tạo query để lọc sản phẩm
    $query = Product::query();

    // Lọc theo danh mục sản phẩm
    if ($request->filled('brand')) {
        $query->where('category', $request->brand);
    }

    // Lọc theo giá tiền
    if ($request->filled('price')) {
        $priceRange = explode('-', $request->price);
        if (count($priceRange) == 2) {
            $query->whereBetween('price_sale', [$priceRange[0], $priceRange[1]]);
        } elseif ($request->price == '20000000') {
            $query->where('price_sale', '>=', 20000000);
        }
    }

    // Lấy danh sách sản phẩm
    $products = $query->get();
foreach ($products as $product) {
            // Tính điểm trung bình của sản phẩm này từ bảng reviews
            $product->averageRating = $product->reviews->avg('rating'); 
        }
    // Trả về view cùng dữ liệu
    return view('producttype', compact('products', 'categories'));
});