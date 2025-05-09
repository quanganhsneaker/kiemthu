<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ProductController extends Controller
{
    public function add_product()
    {
        return view('admin.product.add', [
            'title' => 'Thêm Sản Phẩm'
        ]);
    }


    public function insert_product(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'material' => 'nullable|string|max:255',
            'price_nomal' => 'required|numeric|min:0',
            'price_sale' => 'nullable|numeric|min:0|lte:price_nomal',
            'description' => 'nullable|string',
            'content' => 'nullable|string',
            'image' => 'required|string|max:255',   
            'images' => 'nullable|array',
            'images.*' => 'string|max:255',
            'category' => 'required|string|in:acer,dell,macbook,hp,lenovo,asus,hot,accessory',
        ], [
            'name.required' => 'Vui lòng nhập tên sản phẩm.',
            'name.max' => 'Tên sản phẩm không được vượt quá 255 ký tự.',
            'price_nomal.required' => 'Vui lòng nhập giá bán.',
            'price_nomal.numeric' => 'Giá bán phải là số.',
            'price_nomal.min' => 'Giá bán không được nhỏ hơn 0.',
            'price_sale.numeric' => 'Giá giảm phải là số.',
            'price_sale.min' => 'Giá giảm không được nhỏ hơn 0.',
            'price_sale.lte' => 'Giá giảm phải nhỏ hơn hoặc bằng giá bán.',
            'image.required' => 'Vui lòng chọn ảnh đại diện.',
            'image.max' => 'Đường dẫn ảnh đại diện quá dài.',
            'images.array' => 'Hình ảnh phụ phải là một mảng.',
            'images.*.max' => 'Mỗi hình ảnh phụ không được vượt quá 255 ký tự.',
            'category.required' => 'Vui lòng chọn loại sản phẩm.',
            'category.in' => 'Loại sản phẩm không hợp lệ.',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()
                             ->withErrors($validator)
                             ->withInput();
        }
    
        $validated = $validator->validated();
    
        $product = new Product();
        $product->name = $validated['name'];
        $product->material = $validated['material'] ?? null;
        $product->price_nomal = $validated['price_nomal'];
        $product->price_sale = $validated['price_sale'] ?? null;
        $product->description = $validated['description'] ?? null;
        $product->content = $validated['content'] ?? null;
        $product->image = $validated['image'];
        $product->images = isset($validated['images']) ? implode('*', $validated['images']) : null;
        $product->category = $validated['category'];
        $product->save();
    
        return redirect()->back()->with('success', '🎉 Bạn đã thêm sản phẩm thành công!');
    }
    

    public function list_product()
    {
        $products = DB::table('products')->paginate(8);
    
        $acerProducts = Product::where('category', 'acer')->get();
        $dellProducts = Product::where('category', 'dell')->get();
        $macbookProducts = Product::where('category', 'macbook')->get();
        $accessoryProducts = Product::where('category', 'accessory')->get();
        $hotProducts = Product::where('category', 'hot')->get();
        $hp = Product::where('category', 'hp')->get();
        $lenovo = Product::where('category', 'lenovo')->get();
        $asus = Product::where('category', 'asus')->get();
       
    
        return view('admin.product.list', [
            'title' => 'Danh sách Sản Phẩm',
            'products' => $products,
            'acerProducts' => $acerProducts,
            'dellProducts' => $dellProducts,
            'macbookProducts' => $macbookProducts,
            'accessoryProducts' => $accessoryProducts,
            'hotProducts' => $hotProducts,
            'hp' => $hp,
            'lenovo' => $lenovo,
            'asus' => $asus

        ]);
    }
    

    public function delete_product(Request $request)
    {
        Product::find($request->product_id)->delete(); // Sửa tên class 'product' thành 'Product'
        return response()->json([
            'success' => true
        ]);
    }

    public function edit_product(Request $request)
    {
        $product = Product::find($request->id);
    
        return view('admin.product.edit', [
            'title' => 'Sửa sản phẩm',
            
            'product' => $product
        ]);
    }

    public function update_product(Request $request)
    {
        $product = Product::find($request->id);

        if (!$product) {
            return redirect()->back()->with('error', 'Sản phẩm không tồn tại.');
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'material' => 'nullable|string|max:255',
            'price_nomal' => 'required|numeric|min:0',
            'price_sale' => 'nullable|numeric|min:0|lte:price_nomal',
            'description' => 'nullable|string',
            'content' => 'nullable|string',
            'image' => 'required|string|max:255',
            'images' => 'nullable|array',
            'images.*' => 'string|max:255',
            'category' => 'required|string|in:acer,dell,macbook,hp,lenovo,asus,hot,accessory',
        ], [
            'name.required' => 'Vui lòng nhập tên sản phẩm.',
            'name.max' => 'Tên sản phẩm không được vượt quá 255 ký tự.',
            'price_nomal.required' => 'Vui lòng nhập giá bán.',
            'price_nomal.numeric' => 'Giá bán phải là số.',
            'price_nomal.min' => 'Giá bán không được nhỏ hơn 0.',
            'price_sale.numeric' => 'Giá giảm phải là số.',
            'price_sale.min' => 'Giá giảm không được nhỏ hơn 0.',
            'price_sale.lte' => 'Giá giảm phải nhỏ hơn hoặc bằng giá bán.',
            'image.required' => 'Vui lòng chọn ảnh đại diện.',
            'image.max' => 'Đường dẫn ảnh đại diện quá dài.',
            'images.array' => 'Hình ảnh phụ phải là một mảng.',
            'images.*.max' => 'Mỗi hình ảnh phụ không được vượt quá 255 ký tự.',
            'category.required' => 'Vui lòng chọn loại sản phẩm.',
            'category.in' => 'Loại sản phẩm không hợp lệ.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
        }

        $product->name = $request->input('name');
        $product->material = $request->input('material');
        $product->price_nomal = $request->input('price_nomal');
        $product->price_sale = $request->input('price_sale');
        $product->description = $request->input('description');
        $product->content = $request->input('content');
        $product->image = $request->input('image');
        $product->images = $request->input('images') ? implode('*', $request->input('images')) : null;
        $product->category = $request->input('category');
        $product->save();

        return redirect('/admin/product/list')->with('success', '🎉 Bạn đã cập nhật sản phẩm thành công!');
    }
    public function ajaxSearch(Request $request)
    {
        $query = $request->input('query');
        $products = Product::where('name', 'LIKE', "%{$query}%")
                            ->orWhere('material', 'LIKE', "%{$query}%")
                            ->get();
    
        if ($products->isEmpty()) {
            return response()->json('<p>Không có sản phẩm nào phù hợp.</p>');
        }
    
        $output = '';
        foreach ($products as $product) {
            $output .= '<div class="hot-product-item">
                            <a href="/product/'.$product->id.'">
                                <img src="'.asset($product->image).'" alt="'.$product->name.'">
                            </a>
                            <div class="head">
                                <div class="title">
                                    <p><a href="/product/'.$product->id.'">'.$product->name.'</a></p>
                                </div>
                                <div class="rating">
                                    <img style="height: 17px; width: 18px;" src="'.asset('fontend/asset/images/Star 6.svg').'" alt="Rating">
                                    <span style="color: orange;" class="value">4.9</span>
                                </div>
                            </div>
                            <span>'.$product->material.'</span>
                        </div>';
        }
    
        return response()->json($output); // Trả về HTML được tạo
    }
    public function show($id)
    {
        $product = Product::with('reviews.user')->findOrFail($id); // Load sản phẩm và đánh giá
        return view('product', compact('product'));
    }
    public function productType(Request $request)
    {
        // Lấy danh sách danh mục từ cột `category` trong bảng `products`
        $categories = Product::select('category')->distinct()->pluck('category')->toArray();
    
        // Tạo query để lọc sản phẩm
        $query = Product::query();
    
        // Lọc theo danh mục sản phẩm (category)
        if ($request->filled('brand')) {
            $query->where('category', $request->brand);
        }
    
        // Lọc theo giá tiền (price_nomal, ép kiểu để so sánh)
        if ($request->filled('price')) {
            $priceRange = explode('-', $request->price);
    
            // Kiểm tra nếu có khoảng giá từ - đến
            if (count($priceRange) == 2) {
                // Dùng cast() để chuyển price_nomal sang số cho phép so sánh
                $query->whereRaw('CAST(price_nomal AS DECIMAL) BETWEEN ? AND ?', [$priceRange[0], $priceRange[1]]);
            } elseif ($request->price == '20000000') {
                // Nếu chọn giá trên 20 triệu
                $query->whereRaw('CAST(price_nomal AS DECIMAL) >= ?', [20000000]);
            }
        }
    
        // Lấy danh sách sản phẩm theo các điều kiện đã lọc
        $products = $query->get();
    
        // Tính điểm trung bình của sản phẩm
        foreach ($products as $product) {
            $product->averageRating = $product->reviews->avg('rating');
        }
    
        // Trả về view cùng dữ liệu
        return view('producttype', compact('products', 'categories'));
    }
    
    
    
    

    
}
