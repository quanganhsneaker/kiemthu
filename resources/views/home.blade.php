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
          <img src="{{asset('backend/asset/images/nike1.png')}}" alt="">
         <img src="{{asset('backend/asset/images/adidas3.png')}}" alt="">   
         <img src="{{asset('backend/asset/images/lv.jpg')}}" alt="">
         <img src="{{asset('backend/asset/images/van.png')}}" alt="">
         <img src="{{asset('backend/asset/images/puma.png')}}" alt="">
         <img src="{{asset('backend/asset/images/mlb1.png')}}" alt="">
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
         $categories = ['hot' => 'Sản Phẩm Bán Chạy', 'dell' => 'Adidas', 'macbook' => 'Nike',  'acer' => 'mlb','accessory' => 'Phụ Kiện ','asus' => "Jodan",'hp' => 'LV','lenovo' => 'Gucci'];
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
                                        <!-- Hiển thị các sao sáng dựa trên điểm trung bình của sản phẩm -->
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= floor($product->averageRating)) 
                                                <!-- Hiển thị sao sáng nếu chỉ số sao nhỏ hơn hoặc bằng điểm trung bình -->
                                                <img src="{{ asset('fontend/asset/images/Star 6.svg') }}" alt="star" 
                                                    style="height: 17px; width: 18px; filter: brightness(1.5);"/>
                                            @elseif ($i == ceil($product->averageRating) && $product->averageRating > floor($product->averageRating)) 
                                                <!-- Hiển thị sao sáng một phần nếu có phần thập phân trong điểm trung bình -->
                                                <img src="{{ asset('fontend/asset/images/Star 6.svg') }}" alt="star" 
                                                    style="height: 17px; width: 18px; filter: brightness(1.2);"/>
                                            @else
                                                <!-- Không hiển thị sao nếu điểm trung bình không đủ -->
                                                <span style="display: none;"></span>
                                            @endif
                                        @endfor
                                    
                                        <!-- Hiển thị số điểm trung bình của sản phẩm -->
                                        <span style="color: orange;" class="value">{{ number_format($product->averageRating, 1) }}</span>
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
