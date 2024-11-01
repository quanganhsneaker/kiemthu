@extends('admin.main')
 @section('content')
<form action="/admin/product/add" enctype="multipart/form-data" method="post">
<div class="admin-content-main-content-product-add">
                            <div class="admin-content-main-content-left">
                                <div class="admin-content-main-content-two-input">
                                    <input type="text" value="{{old('name')}}" required name="name" placeholder="Tên sản phẩm">
                                    <input type="text" value="{{old('material')}}" name="material" placeholder="Chất liệu">
                                </div>
                                <div class="admin-content-main-content-two-input">
                                    <input type="text"value="{{old('price_nomal')}}" name="price_nomal" placeholder="Giá bán">
                                    <input type="text"value="{{old('price_sale')}}"    name="price_sale" placeholder="Giá giảm">
                                </div>
                                <textarea   name="description"value="{{old('description')}}"  placeholder="Đặc điểm nổi bật"></textarea>
                                <textarea name="content" value="{{old('content')}}"id=""  placeholder="Mô tả sản phẩm"></textarea>
                               
                                <select name="category" required>
                                <option value="" >Chọn loại sản phẩm cần thêm</option>
                                    <option value="acer">Acer</option>
                                    <option value="dell">Dell</option>
                                    <option value="macbook">Macbook</option>
                                    <option value="hot">Hot</option>
                                    <option value="accessory">Accessory</option>
                                   </select>
              
                                <button type="submit" class="main-btn">Thêm sản phẩm</button>
                     
                                </div>
                               
    
                            <div class="admin-content-main-content-right">
                                <div class="admin-content-main-content-right-imgage">
                                    <label for="file">Ảnh đại diện  </label>
                                    <input id="file" type="file">
                                    <input type="hidden" name="image" id="input-file-img-hiden">
                                    <div class="image-show" id="input-file-img">

                                    </div>
                                    
                                </div>
                                <div class="admin-content-main-content-right-imgages">
                                    <label for="files">Ảnh sản phẩm </label>
                                    <input id="files" type="file" multiple>
                             
                                    <div class="images  -show" id="input-file-imgs">
                                        
                                    </div>
                                </div>
                            </div>
                         </div>
                         @csrf
</form>
 @endsection
 @section('footer')
 <script src="{{asset('backend/asset/js/product_ajax.js')}}"></script>
 @endsection