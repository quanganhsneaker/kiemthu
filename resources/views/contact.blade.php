@extends('main')

@section('content')
@if (Auth::check())

<div class="complaint-container">
    <h1>Khiếu Nại Sản Phẩm</h1>
    @if (session('success'))
        <p class="success-message">{{ session('success') }}</p>
    @endif
    <form action="{{ route('complaint.store') }}" method="post">
        @csrf
        <input type="text" name="name" placeholder="Họ và Tên" class="form-input" required>
        <input type="email" name="email" placeholder="Email" class="form-input" required>
        <input type="text" name="product_id" placeholder="Mã Sản Phẩm" class="form-input" required>
        <input type="number" name="phone" placeholder="Số điện thoại" class="form-input" required>
        <select name="gender" class="form-input" required>
            <option value="">Chọn giới tính</option>
            <option value="male">Nam</option>
            <option value="female">Nữ</option>
            <option value="other">Khác</option>
        </select>
        <select name="product" class="form-input" required>
            <option value="">Chọn lý do</option>
            <option value="Hàng lỗi">Hàng lỗi</option>
            <option value="Không giống mô tả">Không giống mô tả</option>
            <option value="Khác">Khác</option>
        </select>
        <textarea name="complaint_message" placeholder="Ghi chú thêm" class="form-textarea" rows="4" required></textarea>
        <button type="submit" class="form-button">Gửi Khiếu Nại</button>
    </form>
</div>
<div class="noel"> 
    <img src="https://cdnv2.tgdd.vn/webmwg/2024/ContentMwg/images/noel/2024/tgdd/label-left.png" alt="">
     <img src="https://cdnv2.tgdd.vn/webmwg/2024/ContentMwg/images/noel/2024/tgdd/label-right.png" alt="">
       </div>
@endif
@endsection
