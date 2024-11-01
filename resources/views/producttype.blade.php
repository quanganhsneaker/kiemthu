@extends('main')
@section('content')
<form action="/producttype" method="get">
    <style>
        .hot-products{
            margin-top: 100px;
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
        <div class="container">

            <!-- Phần hiển thị sản phẩm theo danh mục -->
            @php
         $categories = ['hot' => 'Sản Phẩm Bán Chạy','new' => 'Sản Phẩm Mới', 'dell' => 'DELL', 'macbook' => 'MACBOOK',  'acer' => 'ACER','accessory' => 'Phụ Kiện '];
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
        @csrf
    </section>

 

</form>

@endsection