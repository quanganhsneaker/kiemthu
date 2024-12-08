<header id="header">
    <div class="container">
        <div class="row-flex">
            <div class="header-bar-icon">
                <i class="ri-menu-line"></i>
            </div>
            <div class="header-logo">
                <a href="/"> <img src="{{asset('fontend/asset/images/logotron.png')}}" alt=""> </a>
            
            </div>
            <div class="header-logo-mobile">
                <img src="{{asset('fontend/asset/images/logotron.png')}}" alt=""> 
            </div>
            <div class="header-nav">
                <nav>
                    <ul>
                        <li><a href="/">Trang Chủ</a></li>
                        <li><a href="/producttype">Sản Phẩm</a></li>
                        <li><a href="/contact">Liên Hệ</a></li>
                        <li><a href="/info">Thông Tin</a></li>
                     
                    </ul>
                </nav>
            </div>
            <div class="header-search">
                <input type="text" id="search-query" placeholder="Tìm kiếm" onkeyup="searchProducts()" required>
                <div id="search-results" class="search-results"></div>
            </div>
            
            <!-- Hiển thị giỏ hàng -->
            @if (Auth::check())
            <div class="header-chat">
                <a href="{{ route('chatuser') }}">
                    <i class="ri-message-2-fill" style="font-size: 25px"></i>  
                </a>
            </div>
            <div class="header-cart">
                <a href="{{ route('show_cart') }}">
                    <i class="ri-shopping-cart-2-fill"></i><pre>   </pre>    
                    Giỏ Hàng
                    @if(Session::has('cart')) 
                    <span class="cart-quantity">{{ array_sum(Session::get('cart')) }}</span>
                @else 
                    <span class="cart-quantity">0</span>
                @endif
                
            </div>
            
            <div class="header-person">
                <a href="{{ route('my.orders') }}">
                    <i class="ri-user-2-fill" style="font-size: 25px"></i> {{ Auth::user()->name }}            
                </a>
            </div>
           
            <div class="header-logout">
                <a href="{{ route('logout') }}">
                    <i class="ri-logout-box-r-fill" style="font-size: 25px"></i>
                </a>
            </div>
            @else
            <div class="header-nav">
                <nav>
                    <ul>
                        <li><a href="{{ route('logins') }}">Đăng Nhập</a></li>
                        <li><a href="{{ route('register') }}">Đăng Ký</a></li>
                        
                    </ul>
                </nav>
            </div>
            @endif
        </div>
    </div>
</header>
