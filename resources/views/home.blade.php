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
    <div class="container1">
        <a href="/producttype">
          <img src="https://cdnv2.tgdd.vn/mwg-static/common/Category/66/cf/66cfa8d199a3a2f0757941d8149971d8.png" alt="">
         <img src="https://cdnv2.tgdd.vn/mwg-static/common/Category/93/b6/93b61bcd1237eb7871ba30a003e2352e.png" alt="">
         <img src="https://cdnv2.tgdd.vn/mwg-static/common/Category/5e/8e/5e8e0225b7f45864fb8c4dbf7b151533.png" alt="">
         <img src="https://cdnv2.tgdd.vn/mwg-static/common/Category/7b/25/7b256aa49ccc53d2fafc71aeff1da981.png" alt="">
         <img src="https://cdnv2.tgdd.vn/mwg-static/common/Category/44/10/4410b95393b8e2be4065f181932cf3b9.png" alt="">
         <img src="https://cdnv2.tgdd.vn/mwg-static/common/Category/16/20/1620a7d46f9bd765e33d9e291567e90a.png" alt="">
         </a>
         
      </div>
      
    <section class="hot-products">
        <div class="noel"> 
     <img src="https://cdnv2.tgdd.vn/webmwg/2024/ContentMwg/images/noel/2024/tgdd/label-left.png" alt="">
      <img src="https://cdnv2.tgdd.vn/webmwg/2024/ContentMwg/images/noel/2024/tgdd/label-right.png" alt="">
        </div>
        <div class="container">
            <!-- Phần hiển thị sản phẩm theo danh mục -->
            @php
         $categories = ['hot' => 'Sản Phẩm Bán Chạy', 'dell' => 'DELL', 'macbook' => 'MACBOOK',  'acer' => 'ACER','accessory' => 'Phụ Kiện ','asus' => "Asus",'hp' => 'Hp','lenovo' => 'Lenovo'];
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
