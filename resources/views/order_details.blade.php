@extends('main')

@section('content')
<style>
    
    .container123 {
    max-width: 800px; /* Giới hạn chiều rộng */
    margin: 20px auto; /* Canh giữa */
    padding: 20px;
    border: 1px solid #ddd; /* Viền nhẹ xung quanh */
    border-radius: 8px; /* Bo tròn góc */
    background-color: #f9f9f9; /* Màu nền sáng */
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Đổ bóng nhẹ */
   
}

h2 {
    text-align: center; /* Căn giữa tiêu đề */
    color: #333; /* Màu chữ */
}

h3 {
    margin-top: 20px; /* Khoảng cách trên tiêu đề sản phẩm */
    color: #555; /* Màu chữ nhạt hơn */
}

ul {
    list-style-type: none; /* Bỏ kiểu đánh số */
    padding: 0; /* Bỏ padding */
}

li {
    padding: 10px; /* Khoảng cách giữa các mục */
    border-bottom: 1px solid #eee; /* Viền dưới giữa các sản phẩm */
}

li:last-child {
    border-bottom: none; /* Bỏ viền dưới cho mục cuối */
}

p {
    margin: 5px 0; /* Khoảng cách giữa các đoạn văn */
    color: #666; /* Màu chữ nhạt */
}

.sup {
    font-size: 0.8em; /* Kích thước chữ nhỏ cho ký hiệu */
    vertical-align: super; /* Căn chỉnh lên trên */
}

.total {
    font-weight: bold; /* Làm đậm tổng tiền */
    color: #d9534f; /* Màu chữ cho tổng tiền */
    font-size: 1.2em; /* Kích thước chữ lớn hơn */
}

</style>
    <div class="container123  ">
        <h2>Chi Tiết Đơn Hàng #{{ $order->id }}</h2>
        <p>Tên Người Nhận: {{ $order->name }}</p>
        <p>Điện Thoại: {{ $order->phone }}</p>
        <p>Email: {{ $order->email }}</p>
        <p>Địa Chỉ: {{ $order->city }}, {{ $order->district }}, {{ $order->ward }}</p>
        <h3>Sản Phẩm:</h3>
        <ul>
          
            @foreach ($order_detail as $product_id => $quantity)
            
                @php
                    // Tìm sản phẩm trong danh sách $products
                    $product = $products->firstWhere('id', $product_id);
                @endphp
                
                <li>
                    @if ($product)
                    <img style="width: 70px;" src="{{asset($product -> image)}}" alt=""style="width: 100px; height: auto;"> -Tên: {{ $product->name }} - Số lượng: {{ $quantity }} 
                        
                    @else
                        Sản phẩm không tìm thấy.
                    @endif
                </li>
            @endforeach
        </ul>
        <h3>Tổng Tiền: {{ number_format($product->price_nomal * $quantity) }} <sup>đ</sup></h3>
    </div>
@endsection
<div class="noel"> 
    <img src="https://cdnv2.tgdd.vn/webmwg/2024/ContentMwg/images/noel/2024/tgdd/label-left.png" alt="">
     <img src="https://cdnv2.tgdd.vn/webmwg/2024/ContentMwg/images/noel/2024/tgdd/label-right.png" alt="">
       </div>
