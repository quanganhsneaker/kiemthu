@extends('main')
@section('content')
<form action="/producttype" method="get">
    <style>
        .hot-products{
            margin-top: 80px;
        }
  header{
    position: fixed; /* Cố định vị trí */
            top: 0; /* Ở đầu màn hình */
            left: 0;
            right: 0;
            z-index: 1000; /* Đảm bảo header nằm trên cùng */
  }
    </style>
     <!-- ============ Product Sections ============== -->
     <section class="hot-products">
        <div class="noel"> 
            <img src="https://cdnv2.tgdd.vn/webmwg/2024/ContentMwg/images/noel/2024/tgdd/label-left.png" alt="">
             <img src="https://cdnv2.tgdd.vn/webmwg/2024/ContentMwg/images/noel/2024/tgdd/label-right.png" alt="">
               </div>
        <div class="container">
            <form action="/producttype" method="get">
                <div class="filter-section">
                    <!-- Lọc theo danh mục -->
                    <label for="brand">Danh mục:</label>
                    <select name="brand" id="brand">
                        <option value="">Tất cả</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category }}" {{ request('brand') == $category ? 'selected' : '' }}>
                                {{ $category }}
                            </option>
                        @endforeach
                    </select>
            
                    <!-- Lọc theo giá -->
                    <label for="price">Khoảng giá:</label>
                    <select name="price" id="price">
                        <option value="">Tất cả</option>
                        <option value="0-5000000" {{ request('price') == '0-5000000' ? 'selected' : '' }}>Dưới 5 triệu</option>
                        <option value="5000000-10000000" {{ request('price') == '5000000-10000000' ? 'selected' : '' }}>5 - 10 triệu</option>
                        <option value="10000000-20000000" {{ request('price') == '10000000-20000000' ? 'selected' : '' }}>10 - 20 triệu</option>
                        <option value="20000000" {{ request('price') == '20000000' ? 'selected' : '' }}>Trên 20 triệu</option>
                    </select>
            
                    <button class="loc" type="submit">Lọc</button>
                </div>
            </form>
            
            
            <!-- Phần hiển thị sản phẩm theo danh mục -->
            @php
         $categories = ['hot' => 'Sản Phẩm Bán Chạy', 'dell' => 'DELL', 'macbook' => 'MACBOOK',  'acer' => 'ACER','accessory' => 'Phụ Kiện ', 'hp' => 'Hp','lenovo' => 'Lenovo','asus' => "Asus"];
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
        @csrf
    </section>

 

</form>

@endsection