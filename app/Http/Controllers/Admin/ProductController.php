<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use DB;
use Illuminate\Http\Request;

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
        $product = new Product();
        $product->name = $request->input('name');
        $product->material = $request->input('material');
        $product->price_nomal = $request->input('price_nomal');
        $product->price_sale = $request->input('price_sale');
        $product->description = $request->input('description');
        $product->content = $request->input('content');
        $product->image = $request->input('image');
        $product->images = implode('*', $request->input('images'));
        $product->category = $request->input('category'); // Lưu danh mục vào sản phẩm
    
        $product->save();
    
        return redirect()->back();
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
    
        $product->name = $request->input('name');
        $product->material = $request->input('material');
        $product->price_nomal = $request->input('price_nomal');
        $product->price_sale = $request->input('price_sale');
        $product->description = $request->input('description');
        $product->content = $request->input('content');
        $product->image = $request->input('image');
        $product_images = implode('*', $request->input('images'));
        $product->images = $product_images;
        $product->save();

        return redirect('/admin/product/list');
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
    
    
}
