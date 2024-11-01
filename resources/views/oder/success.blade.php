@extends('main')
@section('content')
<section class="oder-confirm p-to-top">
        <div class="container">
            <div class="row-flex row-flex-product-detail">
                <p > Xác nhận đơn hàng:   <span style="font-weight: bold;" > Thành Công</span></p>
             </div>
             <div class="row-flex">
                <div class="oder-confirm-content">
                    <p> Đơn hàng của bạn đã được gửi <span style="font-weight: bold;"> Thành Công</span>!
                    <br> 
                    <span style="font-size: small;">Chúng tôi sẽ <span style="font-weight: bold;">Giao Hàng</span> trong tối đa 3 ngày làm việc</span></p>
                       <br> <button class="main-btn">Tiếp tục mua hàng</button>
                </div>
             </div>
        </div>
     </section>

@csrf

@endsection
