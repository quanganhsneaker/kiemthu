  @extends('main')
@section('content')
<form action="/infor" method="get">
   <!--===================================================================== features 1====================================== -->
   <div class="features">
        <div class="main-content">
          <div class="body">
            <div class="images">
              <img class="lower" src="{{asset('fontend/asset/images/hpvenus0.jpg')}}" alt="" />
              <img class="hight" src="{{asset('fontend/asset/images/asustuf0.jpg')}}" alt="" />
            </div>
            <div class="content">
              <h2 class="heading-lv2">
               Nhanh Tay, Nhanh Mắt - Bắt Trúng Quà To Cùng TeddyShop 
              </h2>
              <p class="desc">
                Khuyến mãi trị giá 1.090.000₫<br>
    
                Giá và khuyến mãi có thể kết thúc sớm hơn dự kiến <br>
                1.Tặng kèm Office bản quyền 1 năm Xem chi tiết <br>
    
    
                2.Tặng Phiếu mua hàng 100,000đ áp dụng mua balo, túi chống sốc <br>
    
                3.Cơ hội nhận ngay Phiếu mua hàng trị giá 1,000,000đ khi tham gia <br>
                4.Trả góp Duyệt qua điện thoại, giao hàng tận nhà
              </p>
              <p class="desc">Số lượng chỉ còn (20 máy)</p>
              <a href="./cart.html" class="btn main-btn">Mua Ngay</a>
            </div>
          </div>
        </div>
      </div>
      <!--===================================================================== features 2====================================== -->
      <div class="features features-2nd">
        <div class="main-content">
          <div class="body">
            <div class="images">
              <img style="width: 120%;" src="{{asset('fontend/asset/images/teddyshop.png')}}" alt="" />
            </div>
            <div class="content">
              <h2 class="heading-lv2">
                TEDDYSHOP Lần Thứ Hai Liên Tiếp Góp Mặt Trong Top 20 Doanh Nghiệp Có Chỉ Số Phát Triển Bền Vững VNSI Tốt Nhất Việt Nam
              </h2>
    
              <p class="desc">
                Ngày 15/07/2024, Sở Giao dịch Chứng khoán Thành phố Hồ Chí Minh (HOSE) đã công bố Danh mục cổ phiếu thành phần của chỉ số Phát triển bền vững VNSI (Vietnam Sustainability Index). MWG tiếp tục khẳng định vị thế khi lần thứ hai liên tiếp được vinh danh trong nhóm 20 doanh nghiệp có chỉ số phát triển bền vững tốt nhất thị trường.....
    
              </p>
              <a href="./info.html" class="btn main-btn">Xem Thêm</a>
            </div>
          </div>
        </div>
      </div>
      <!--===================================================================== features 3====================================== -->
      <div class="features features-2nd">
        <div class="main-content">
          <div class="body">
          
            <div class="content">
              <h2 class="heading-lv2">
                TEDDYSHOP Lần Thứ Hai Liên Tiếp Góp Mặt Trong Top 20 Doanh Nghiệp Có Chỉ Số Phát Triển Bền Vững VNSI Tốt Nhất Việt Nam
              </h2>
    
              <p class="desc">
                Ngày 15/07/2024, Sở Giao dịch Chứng khoán Thành phố Hồ Chí Minh (HOSE) đã công bố Danh mục cổ phiếu thành phần của chỉ số Phát triển bền vững VNSI (Vietnam Sustainability Index). MWG tiếp tục khẳng định vị thế khi lần thứ hai liên tiếp được vinh danh trong nhóm 20 doanh nghiệp có chỉ số phát triển bền vững tốt nhất thị trường.....
    
              </p>
              <a href="./info.html" class="btn main-btn">Xem Thêm</a>
            </div>
            <div class="images">
                <img style="width: 120%;" src="{{asset('fontend/asset/images/teddyshop.png')}}" alt="" />
              </div>
          </div>
        </div>
      </div>
       <!-- ======================================================================feedback=================================== -->
       <div class="feedback">
        <div class="container">
          <div class="feedback-list">
            <!-- ======================================item1==================================== -->
            <div class="feedback-item">
              <!-- khối bên trái -->
              <div class="info">
                <img
                  src="{{asset('fontend/asset/images/ảnh quang anh áo đoàn.jpg')}}"
                  alt="Peter Moor"
                  class="avatar"
                />
                <p class="member-name">Quang Anh</p>
                <p class="desc">Student of HUNRE</p>
               
              </div>
    
              <!-- khối bên phải -->
              <div class="content">
                <img
                  src=""
                  alt=""
                  class="open-qotes"
                />
                <pre>
                  "Con laptop xài sướng lắm, khởi động chừng 15s,
                   chơi game Cossack 3 the golden age rất mượt, Liên Quân Liên Minh gì đó 
                   chỉ là chuyện nhò thôi."
                </pre>
              </div>
            </div>
            
          </div>
        </div>
      </div>

</form>


@endsection