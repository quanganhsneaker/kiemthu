@extends('main')
@section('content')
<section class="oder-confirm p-to-top">
        <div class="container">
            <div class="row-flex row-flex-product-detail">
                <p > Xác nhận đơn hàng:   <span style="font-weight: bold;" > Hà Minh Quang Anh#19</span></p>
             </div>
             <div class="row-flex">
                <div class="oder-confirm-content">
                    <p> Đơn hàng của bạn đã được gửi <span style="font-weight: bold;"> Thành Công</span>!
                    <br> 
                    <span style="font-size: small;">Vui lòng check <span style="font-weight: bold;">Email</span> đã đăng ký để xác nhận đơn hàng</span></p>
                       <br> <a href="/"><button class="main-btn">Tiếp tục mua hàng</button></a>
                </div>
             </div>
        </div>
     </section>

@endsection
