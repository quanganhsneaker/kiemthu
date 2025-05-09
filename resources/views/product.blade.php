@extends('main')
@section('content')
<style>
    .p-to-top {
        padding-top: 71px;
    }

    .review-section {
        margin-top: 50px;
        padding: 20px;
        border-top: 1px solid #ddd;
    }

    .review-item {
        margin-bottom: 20px;
    }

    .review-item h4 {
        margin: 0;
        font-weight: bold;
    }

    .review-item p {
        margin: 5px 0 0;
    }

    .review-form textarea {
        width: 100%;
        height: 100px;
        margin-bottom: 10px;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .hidden {
        display: none;
    }

    .main-btn {
        background-color: black;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .main-btn:hover {
        background-color: gray;
    }
</style>

<section class="product-detail p-to-top">
    <form action="/cart/add" method="post">
        <div class="container">
            <div class="row-flex row-flex-product-detail">
                <p>Sản Phẩm</p><i class="ri-arrow-right-line"></i>
                <p>{{ $product->name }}</p>
            </div>
            <div class="row-grid">
                <!-- Hình ảnh sản phẩm -->
                <div class="product-detail-left">
                    <img class="main-image" src="{{ asset($product->image) }}" alt="Sản phẩm">
                    <div class="product-images-items">
                        @php
                            $product_images = explode('*', $product->images);
                        @endphp
                        @foreach ($product_images as $product_image)
                            <img src="{{ asset($product_image) }}" alt="Hình ảnh sản phẩm">
                        @endforeach
                    </div>
                </div>

                <!-- Thông tin sản phẩm -->
                <div class="product-detail-right">
                    <div class="product-detail-right-infor">
                        <h1>{{ $product->name }}</h1>
                        <span>{{ $product->material }}</span>
                        <div class="product-item-price">
                            <p>{{ number_format($product->price_nomal) }} <sup>đ</sup>
                                <span>{{ number_format($product->price_sale) }}<sup>đ</sup></span>
                            </p>
                        </div>
                    </div>
                    <h2>Đặc điểm nổi bật</h2>
                    <div class="product-detail-right-des">
                        {!! nl2br(e($product->description)) !!}
                    </div>
                    <div class="product-detail-right-quantity">
                        <h2>Số Lượng</h2>
                        <div class="product-detail-right-quantity-input">
                            <i class="ri-subtract-line"></i>
                            <input onKeyDown="return false" class="quantity-input" name="product_qty" type="number" value="1">
                            <input type="hidden" value="{{ $product->id }}" name="product_id">
                            <i class="ri-add-line"></i>
                        </div>
                    </div>
                    <div class="product-detail-right-addcart">
                        <button type="submit" class="main-btn">Thêm vào giỏ hàng</button>
                    </div>
                </div>
            </div>

            <!-- Chi tiết sản phẩm -->
            <h2>Chi tiết sản phẩm</h2>
            <div class="row-flex">
                <div class="product-detail-content">
                    {!! nl2br(e($product->content)) !!}
                </div>
            </div>

        
        </div>
        @csrf
    </form>
    <div class="container">
        <!-- Đánh giá sản phẩm -->
        <div class="review-section">
            <h2>Đánh giá sản phẩm</h2>
            <div id="reviews-container">
                @foreach ($product->reviews as $index => $review)
                    <div class="review-item {{ $index >= 3 ? 'hidden' : '' }}">
                        <h4>{{ $review->user->name }} ({{ $review->rating }}/5)</h4>
    
                        <!-- Hiển thị sao dựa trên rating -->
                        <p>
                            @for ($i = 1; $i <= 5; $i++)
                                <span class="star" style="color: {{ $i <= $review->rating ? 'gold' : '#ccc' }};">&#9733;</span>
                            @endfor
                        </p>
                        
                        <p>{{ $review->comment }}</p>
                    </div>
                @endforeach
            </div>
            
            @if (count($product->reviews) > 3)
                <button id="show-more-btn" class="main-btn">Xem thêm</button>
            @endif
    
            @auth
                <!-- Nếu người dùng đã đăng nhập nhưng không cần form -->
            @else
                <p>Vui lòng <a href="{{ route('logins') }}">đăng nhập</a> để đánh giá sản phẩm.</p>
            @endauth
        </div>
    </div>
    
</section>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const showMoreBtn = document.getElementById('show-more-btn');
        const hiddenReviews = document.querySelectorAll('.review-item.hidden');

        showMoreBtn?.addEventListener('click', () => {
            hiddenReviews.forEach(review => review.classList.remove('hidden'));
            showMoreBtn.style.display = 'none';
        });
    });
</script>
@endsection
