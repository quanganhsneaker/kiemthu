@extends('main')

@section('content')

    <!-- product-details -->
    <section class="cart-section p-to-top">
        <!-- Form cập nhật giỏ hàng -->
        @if (Auth::check())
        <form action="/cart/send" method="post">
            <div class="container">
                <div class="row-flex row-flex-product-detail">
                    <p style="font-size: x-large;">Giỏ Hàng</p>
                </div>

                <!-- Bảng sản phẩm trong giỏ hàng -->
                <div class="row-grid">
                    <div class="cart-section-left">
                        <h2 class="main-h2">Chi tiết đơn hàng</h2>
                        <div class="cart-section-left-detail">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Ảnh</th>
                                        <th>Sản Phẩm</th>
                                        <th>Thành Tiền</th>
                                        <th>Xoá</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $total = 0; @endphp
                                    @foreach ($products as $product)
                                        @php
                                        $price = $product->price_nomal * Session::get('cart')[$product->id];
                                        $total += $price;
                                        @endphp
                                        <tr>
                                            <td><img src="{{ asset($product->image) }}" alt=""></td>
                                            <td>
                                                <div class="product-detail-right-infor">
                                                    <h1>{{ $product->name }}</h1>
                                                    <div class="product-item-price">
                                                        <p>{{ number_format($product->price_nomal) }}<sup>đ</sup>
                                                            <span>{{ number_format($product->price_sale) }}<sup>đ</sup></span>
                                                        </p>
                                                    </div>
                                                </div>
                                                <!-- Input thay đổi số lượng -->
                                                <div class="product-detail-right-quantity-input">
                                                    <i class="ri-subtract-line"></i>
                                                    <input onKeyDown="return false" class="quantity-input" name="product_id[{{ $product->id }}]" type="number" value="{{ Session::get('cart')[$product->id] }}">
                                                    <i class="ri-add-line"></i>
                                                </div>
                                            </td>
                                            <td><p>{{ number_format($price) }} <sup>đ</sup></p></td>
                                            <td><a href="/cart/delete/{{ $product->id }}"><i class="ri-close-circle-fill"></i></a></td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="2" style="font-weight: bold;">Tổng tiền</td>
                                        <td style="font-weight: bold; text-align: center;">{{ number_format($total) }} <sup>đ</sup></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                            
                            <button formaction="/cart/update" class="main-btn">Cập Nhật Giỏ Hàng</button>
                            <a style="font-style: italic;" href="/">>>>>Tiếp tục mua hàng</a>
                        </div>
                    </div>
                    <div class="cart-section-right">
                        <h2 class="main-h2">Thông tin giao hàng</h2>
                        <div class="cart-section-right-input-name-phone">
                            <input type="text" placeholder="Tên" name="name" id="">
                            <input type="number" placeholder="Điện Thoại" name="phone" id="">
                        </div>
                        <div class="cart-section-right-input-email">
                            <input type="email" placeholder="Email" name="email" id="">
                        </div>
                        <div class="cart-section-right-select">
                            <select name="city" id="city">
                                <option value="">Tỉnh/Thành Phố</option>
                            </select>
                            <select name="district" id="district">
                                <option value="">Quận/Huyện</option>
                            </select>
                            <select name="ward" id="ward">
                                <option value="">Phường/Xã</option>
                            </select>
                        </div>
                        <div class="cart-section-right-input-adress">
                            <input type="text" placeholder="Địa Chỉ" name="address" id="">
                        </div>
                        <div class="cart-section-right-input-note">
                            <input type="text" placeholder="Ghi Chú " name="note" id="">
                        </div>

                        <!-- Thêm lựa chọn phương thức thanh toán -->
                        <div class="cart-section-right-payment">
                            <h3>Phương thức thanh toán</h3>
                            <label for="cod">
                                <input type="radio" name="payment_method" value="cod" id="cod" checked>
                                Thanh toán khi nhận hàng (COD)
                            </label>
                            <label for="vnpay">
                                <input type="radio" name="payment_method" value="vnpay" id="vnpay">
                                Thanh toán qua VNPay
                            </label>
                        </div>

                        <button type="submit" class="main-btn">Gửi Đơn Hàng</button>
                    </div>
                </div>
            </div>

            <!-- SweetAlert -->
            @if(session('success'))
                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        Swal.fire({
                            icon: 'success',
                            title: 'Thành công',
                            text: '{{ session('success') }}',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    });
                </script>
            @endif
            @endif

            @csrf
        </form>
    </section>
@endsection

@section('footer')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
    <script src="{{ asset('fontend/asset/js/apiprovince.js') }}"></script>
@endsection
