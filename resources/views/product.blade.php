@extends('main')
@section('content')
<style>
        .p-to-top {
            padding-top: 71px;
        }
    </style>
<section class="product-detail p-to-top">
  <form action="/cart/add" method="post">
  <div class="container">
            <div class="row-flex row-flex-product-detail">
               <p >Sản Phẩm </p><i class="ri-arrow-right-line"></i>
               <p>{{$product -> name}}</p>
            </div>  
            <div class="row-grid">
                <div class="product-detail-left">
                    <img class="main-image" src="{{asset($product -> image)}}" alt="">
                    <div class="product-images-items">
                      @php
                        $product_images = explode('*',$product -> images)
                      @endphp
                      @foreach ( $product_images  as $product_image )
                      <img  src="{{asset($product_image)}}" alt="">
                      @endforeach
                   
                    </div>
                </div>
            <div class="product-detail-right">
              <div class="product-detail-right-infor">
                <h1>{{$product -> name}}</h1>
                <span>{{$product -> material}}</span>
                <div class="product-item-price">
                    <p>{{number_format($product -> price_nomal)}} <sup>đ</sup><span>{{number_format($product -> price_sale)}}<sup>đ</sub</span> </p>
                </div>
              </div>
              <h2>Đặc điểm nổi bật</h2>
              <div class="product-detail-right-des">
         
              {!!$product->description!!}
              </div>
              <div class="product-detail-right-quantity">
                <h2>Số Lượng</h2>
                <div class="product-detail-right-quantity-input">
                    <i class="ri-subtract-line"></i>
                    <input onKeyDown="return false" class="quantity-input" name="product_qty" type="number" value="1">
                    <input type="hidden" value="{{$product -> id}}" name="product_id"  >
                    <i class="ri-add-line"></i>
                </div>
              </div>
              <div class="product-detail-right-addcart">
                <button type="submit" class="main-btn">Thêm vào giỏ hàng</button>
              </div>
            </div>
           
             </div>
             <h2>Chi tiết sản phẩm</h2>
             <div class="row-flex">
            
                <div class="product-detail-content">
                {!!$product->content!!}

                </div>
             </div>
        </div>
       @csrf

  </form>


        
     </section>
@endsection
