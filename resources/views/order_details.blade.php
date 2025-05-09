@extends('main')

@section('content')
<style>
    h2 {
        text-align: center;
        color: #333;
    }
    .top{
        margin-top: 100px;
    }
/* Căn chỉnh chung cho form */
form {
    display: flex;
    flex-direction: column;
    gap: 20px; /* Khoảng cách giữa các phần tử */
    width: 100%;
    max-width: 600px;
  
}
    .product-review {
        margin-top: 10px;
    }

    .product-review p {
        font-weight: bold;
        margin: 5px 0;
    }
</style>

<div class="container123 top">
    <h2>Chi Tiết Đơn Hàng #{{ $order->id }}</h2>
    <p>Tên Người Nhận: {{ $order->name }}</p>
    <p>Điện Thoại: {{ $order->phone }}</p>
    <p>Email: {{ $order->email }}</p>
    <p>Địa Chỉ: {{ $order->city }}, {{ $order->district }}, {{ $order->ward }}</p>
    
    <h3>Sản Phẩm:</h3>
    <ul>
        @foreach ($order_detail as $product_id => $quantity)
            @php
                $product = $products->firstWhere('id', $product_id);
                $product_reviews = $reviews[$product_id] ?? collect();
            @endphp
            <li>
                @if ($product)
                    <img style="width: 70px;" src="{{ asset($product->image) }}" alt="">
                    Tên: {{ $product->name }} - Số lượng: {{ $quantity }}
                    {{-- @auth
                        @php
                            // Tìm đánh giá của người dùng hiện tại cho sản phẩm này trong đơn hàng
                            $user_review = $product_reviews->firstWhere('user_id', auth()->id());
                        @endphp
                        
                        @if (!$user_review)
                           
                            <form method="POST" action="{{ route('reviews.store') }}">
                                @csrf
                                <input type="hidden" name="order_id" value="{{ $order->id }}">
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                
                                <div class="rating-container">
                                    <label for="rating" class="rating-label">Đánh giá:</label>
                                    <div class="star-rating">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}">
                                            <label for="star{{ $i }}">&#9733;</label>
                                        @endfor
                                    </div>
                                </div>
                            
                                <div class="comment-container">
                                    <label for="comment" class="comment-label">Nhận xét:</label>
                                    <textarea name="comment" id="comment" rows="2"></textarea>
                                </div>
                            
                                <div class="submit-button">
                                    <button class="main-btn" type="submit">Gửi đánh giá</button>
                                </div>
                            </form>
                            
                        @else
                       
                            <p>Bạn đã đánh giá sản phẩm này trong đơn hàng này. Cảm ơn bạn!</p>
                        @endif
                    @endauth --}}
                @else
                    Sản phẩm không tìm thấy.
                @endif
            </li>
        @endforeach
    </ul>

    {{-- <h3>Tổng Tiền: {{ number_format(array_sum(array_map(fn($id, $quantity) => $products->firstWhere('id', $id)->price_nomal * $quantity, array_keys($order_detail), $order_detail))) }} <sup>đ</sup></h3> --}}
    <a href="/my-orders"><button class="thoat">Thoát</button></a>
</div>

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
@endsection

