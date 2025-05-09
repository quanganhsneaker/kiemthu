@extends('admin.main')
@section('content')

@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $err)
                <li>{{ $err }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="/admin/product/add" enctype="multipart/form-data" method="post">
    <div class="admin-content-main-content-product-add">
        <div class="admin-content-main-content-left">
            <div class="admin-content-main-content-two-input">
                <input type="text" value="{{old('name')}}" required name="name" placeholder="Tên sản phẩm">
                <input type="text" value="{{old('material')}}" name="material" placeholder="Chất liệu">
            </div>
            <div class="admin-content-main-content-two-input">
                <input type="text" value="{{old('price_nomal')}}" name="price_nomal" placeholder="Giá bán">
                <input type="text" value="{{old('price_sale')}}" name="price_sale" placeholder="Giá giảm">
            </div>
            <textarea name="description" placeholder="Đặc điểm nổi bật">{{ old('description') }}</textarea>
            <textarea name="content" placeholder="Mô tả sản phẩm">{{ old('content') }}</textarea>

            <select name="category" required>
                <option value="">Chọn loại sản phẩm cần thêm</option>
                <option value="acer" {{ old('category') == 'acer' ? 'selected' : '' }}>Nike</option>
                <option value="dell" {{ old('category') == 'dell' ? 'selected' : '' }}>Adidas</option>
                <option value="macbook" {{ old('category') == 'macbook' ? 'selected' : '' }}>MLB</option>
                <option value="hp" {{ old('category') == 'hp' ? 'selected' : '' }}>LV</option>
                <option value="lenovo" {{ old('category') == 'lenovo' ? 'selected' : '' }}>Gucci</option>
                <option value="asus" {{ old('category') == 'asus' ? 'selected' : '' }}>Jordan</option>
                <option value="hot" {{ old('category') == 'hot' ? 'selected' : '' }}>Hot</option>
                <option value="accessory" {{ old('category') == 'accessory' ? 'selected' : '' }}>Accessory</option>
            </select>

            <button type="submit" class="main-btn">Thêm sản phẩm</button>
        </div>

        <div class="admin-content-main-content-right">
            <div class="admin-content-main-content-right-imgage">
                <label for="file">Ảnh đại diện</label>
                <input id="file" type="file">
                <input type="hidden" name="image" id="input-file-img-hiden" value="{{ old('image') }}">
                <div class="image-show" id="input-file-img"></div>
            </div>
            <div class="admin-content-main-content-right-imgages">
                <label for="files">Ảnh sản phẩm</label>
                <input id="files" type="file" multiple>
                <div class="images-show" id="input-file-imgs"></div>
            </div>
        </div>
    </div>
    @csrf
</form>
@endsection

@section('footer')
@if(session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function () {
        Swal.fire({
            icon: 'success',
            title: 'Thành công',
            text: '{{ session('success') }}',
            timer: 2000,
            showConfirmButton: false
        });
    });
</script>
@endif
<script src="{{asset('backend/asset/js/product_ajax.js')}}"></script>
@endsection
