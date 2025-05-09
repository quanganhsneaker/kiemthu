@extends('admin.main')
@section('content')
<form action="{{ url('admin/product/edit', $product->id) }}" enctype="multipart/form-data" method="post">
    @csrf
    <input type="hidden" name="id" value="{{ $product->id }}">
    <div class="admin-content-main-content-product-add">
        <div class="admin-content-main-content-left">
            <div class="admin-content-main-content-two-input">
                <input type="text" value="{{ old('name', $product->name) }}" name="name" placeholder="Tên sản phẩm">
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <input type="text" value="{{ old('material', $product->material) }}" name="material" placeholder="Chất liệu">
                @error('material')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="admin-content-main-content-two-input">
                <input type="text" value="{{ old('price_nomal', $product->price_nomal) }}" name="price_nomal" placeholder="Giá bán">
                @error('price_nomal')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <input type="text" value="{{ old('price_sale', $product->price_sale) }}" name="price_sale" placeholder="Giá giảm">
                @error('price_sale')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <textarea name="description" placeholder="Đặc điểm nổi bật">{{ old('description', $product->description) }}</textarea>
            @error('description')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            <textarea name="content" placeholder="Mô tả sản phẩm">{{ old('content', $product->content) }}</textarea>
            @error('content')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            <div>
                <label for="category">Loại sản phẩm</label>
                <select name="category" id="category">
                    <option value="acer" {{ old('category', $product->category) == 'acer' ? 'selected' : '' }}>Acer</option>
                    <option value="dell" {{ old('category', $product->category) == 'dell' ? 'selected' : '' }}>Dell</option>
                    <option value="macbook" {{ old('category', $product->category) == 'macbook' ? 'selected' : '' }}>MacBook</option>
                    <option value="hp" {{ old('category', $product->category) == 'hp' ? 'selected' : '' }}>HP</option>
                    <option value="lenovo" {{ old('category', $product->category) == 'lenovo' ? 'selected' : '' }}>Lenovo</option>
                    <option value="asus" {{ old('category', $product->category) == 'asus' ? 'selected' : '' }}>Asus</option>
                    <option value="hot" {{ old('category', $product->category) == 'hot' ? 'selected' : '' }}>Hot</option>
                    <option value="accessory" {{ old('category', $product->category) == 'accessory' ? 'selected' : '' }}>Accessory</option>
                </select>
                @error('category')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="main-btn">Cập nhật sản phẩm</button>
        </div>
        <div class="admin-content-main-content-right">
            <div class="admin-content-main-content-right-imgage">
                <label for="file">Ảnh đại diện</label>
                <input id="file" type="file">
                <input type="hidden" name="image" value="{{ old('image', $product->image) }}" id="input-file-img-hiden">
                <div class="image-show" id="input-file-img">
                    <img src="{{ asset($product->image) }}" alt="">
                </div>
                @error('image')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="admin-content-main-content-right-imgages">
                <label for="files">Ảnh sản phẩm</label>
                <input id="files" type="file" multiple>
                <div class="images-show" id="input-file-imgs">
                    @php
                        $product_images = explode("*", $product->images ?? '');
                    @endphp
                    @foreach ($product_images as $product_image)
                        @if ($product_image)
                            <img src="{{ asset($product_image) }}" alt="">
                            <input type="hidden" name="images[]" value="{{ $product_image }}" id="input-file-img-hiden">
                        @endif
                    @endforeach
                </div>
                @error('images')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
</form>
@endsection
@section('footer')
    <script src="{{ asset('backend/asset/js/product_ajax.js') }}"></script>
@endsection