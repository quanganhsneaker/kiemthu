<!DOCTYPE html>
<html lang="en">
<head>
  @include('parts.head')
</head>
<body>
    <!-- ========header================ -->
    @include('parts.header')

    <!-- =============slider================== -->
    @php
    $sliderImage1 = \App\Models\Setting::where('key', 'slider_image_1')->value('value');
    $sliderImage2 = \App\Models\Setting::where('key', 'slider_image_2')->value('value');
    $sliderImage3 = \App\Models\Setting::where('key', 'slider_image_3')->value('value');
@endphp

<section class="slider">
    <div class="slider-items">
        <div class="slider-item"><img src="{{ asset('storage/' . $sliderImage1) }}" alt=""></div>
        <div class="slider-item"><img src="{{ asset('storage/' . $sliderImage2) }}" alt=""></div>
        <div class="slider-item"><img src="{{ asset('storage/' . $sliderImage3) }}" alt=""></div>
    </div>
    <div class="slider-arrow">
        <i class="ri-arrow-right-line"></i>
        <i class="ri-arrow-left-line"></i>
    </div>
</section>

    <!-- ============ Product Sections ============== -->
    <section class="hot-products">
        <div class="container">

            <!-- Phần hiển thị sản phẩm theo danh mục -->
            @php
         $categories = ['hot' => 'Sản Phẩm Bán Chạy', 'dell' => 'DELL', 'macbook' => 'MACBOOK',  'acer' => 'ACER','accessory' => 'Phụ Kiện '];
            @endphp

            @foreach ($categories as $category => $title)
                <div class="row-grid">
                    <p class="heading-text">{{ $title }}</p>
                </div>
                <div class="row-grid row-grid-hot-product">
                    @foreach ($products as $product)
                        @if ($product->category == $category)
                            <!-- Include phần tử sản phẩm -->
                            <div class="hot-product-item">
                                <a href="/product/{{$product->id}}">
                                    <img src="{{ asset($product->image) }}" alt="{{ $product->name }}">
                                </a>
                                <div class="head">
                                    <div class="title">
                                        <p><a href="/product/{{$product->id}}">{{ $product->name }}</a></p>
                                    </div>
                                    <div class="rating">
                                        <img style="height: 17px; width: 18px;" src="{{ asset('fontend/asset/images/Star 6.svg') }}" alt="">
                                        <span style="color: orange;" class="value">4.9</span>
                                    </div>
                                </div>
                                <span>{{ $product->material }}</span>
                                <div class="product-item-price">
                                 
                                   
                               
                                    <p>{{ number_format($product->price_nomal) }} <sup>đ</sup>
                                        <span>{{ number_format($product->price_sale) }}<sup>đ</sup></span>
                                    </p>
                                </div>
                            </div>
                         
                        @endif
                    @endforeach
                </div>
            @endforeach

        </div>
    </section>


    <!-- Footer -->
    @include('parts.footer')

</body>
</html>
