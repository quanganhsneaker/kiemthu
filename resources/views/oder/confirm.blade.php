@extends('main')

@section('content')
<section class="oder-confirm p-to-top">
    <div class="container">
        <div class="row-flex row-flex-product-detail">
            <!-- Hiển thị tên khách hàng và mã đơn hàng -->
            <p> Xác nhận đơn hàng: <span style="font-weight: bold;"> #{{ $order->id }}</span></p>
        </div>
        <div class="row-flex">
            <div class="oder-confirm-content">
                <!-- Hiển thị thông báo đơn hàng đã được gửi thành công -->
                <p> Đơn hàng của {{ $order->name }} đã được gửi <span style="font-weight: bold;"> Thành Công</span>!</p>
                <br>
                <span style="font-size: small;">
                    Vui lòng kiểm tra <span style="font-weight: bold;">Email</span> đã đăng ký để xác nhận đơn hàng
                </span>
                <br><br>
                <!-- Hiển thị thông tin chi tiết đơn hàng -->
                <p><strong>Đơn hàng:</strong></p>
                <ul>
                    @foreach (json_decode($order->order_detail) as $product_id => $quantity)
                        <li>Sản phẩm ID: {{ $product_id }} - Số lượng: {{ $quantity }}</li>
                    @endforeach
                </ul>
                <br> 
                <a href="/"><button class="main-btn">Tiếp tục mua hàng</button></a>
            </div>
        </div>
    </div>
    @csrf
</section>
@endsection
