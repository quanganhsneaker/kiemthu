@extends('main')

@section('content')
@if (Auth::check())
<div class="complaint-container">
    <h1>Khiếu Nại Sản Phẩm</h1>
    <form action="/submit_complaint" method="post">
        <input type="text" name="name" placeholder="Họ và Tên" class="form-input" required>
        <input type="email" name="email" placeholder="Email" class="form-input" required>
        <input type="text" name="product_id" placeholder="Mã Sản Phẩm" class="form-input" required>
        <input type="number" name="phone" placeholder="Số điện thoại" class="form-input" required>
    
        <select id="gender" name="gender" class="form-input" required>
            <option value="">Chọn giới tính</option>
            <option value="male">Nam</option>
            <option value="female">Nữ</option>
            <option value="other">Khác</option>
        </select>
        <select id="product" name="product" class="form-input" required>
            <option value="">Chọn lý do</option>
            <option value="male">Hàng lỗi</option>
            <option value="female">Khác với mô tả/Không giống ảnh</option>
            <option value="other">Khác</option>
        </select>
        <textarea name="complaint_message" placeholder="Ghi chú thêm" class="form-textarea" rows="4" required></textarea>
        <button type="submit" class="form-button">Gửi Khiếu Nại</button>
        @csrf
    </form>
</div>
@endif

<style>
    

    .complaint-container {
        
        background-color:#F5F5F5; /* Màu nền cho container */
        padding: 20px; /* Padding bên trong container */
        border-radius: 8px; /* Bo góc cho container */
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5); /* Đổ bóng cho container */
        max-width: 600px; /* Chiều rộng tối đa cho container */
        margin: auto; /* Căn giữa container */
      margin-top: 130px;

    }

    h1 {
        text-align: center; /* Căn giữa tiêu đề */
        margin-bottom: 20px; /* Khoảng cách dưới tiêu đề */
        color: black; /* Màu chữ trắng */
    }

    .form-input, .form-textarea {
        width: 100%; /* Chiếm toàn bộ chiều rộng */
        padding: 10px; /* Padding cho input và textarea */
        margin-bottom: 15px; /* Khoảng cách giữa các trường */
        border: 1px solid silver; /* Viền tối */
        border-radius: 4px; /* Bo góc cho input và textarea */
        background-color: #F5F5F5; /* Nền tối cho input và textarea */
        color: black; /* Màu chữ trắng */
        font-size: 16px; /* Kích thước chữ */
    }

    .form-input:focus, .form-textarea:focus {
        border-color: #ffffff; /* Đổi màu viền khi focus */
        outline: none; /* Loại bỏ outline mặc định */
        color: black;
    }

    .form-button {
        background-color: black; /* Màu nền cho nút */
        color: white; /* Màu chữ trắng */
        padding: 10px; /* Padding cho nút */
        border: none; /* Không có viền */
        border-radius: 4px; /* Bo góc cho nút */
        cursor: pointer; /* Thay đổi con trỏ khi hover */
        font-size: 16px; /* Kích thước chữ */
        width: 100%; /* Chiếm toàn bộ chiều rộng */
        transition: background-color 0.3s; /* Hiệu ứng chuyển màu */
    }

    .form-button:hover {
        background-color: green; /* Đổi màu khi hover */
    }

    select {
        background-color: #333; /* Nền tối cho select */
        color: #ffffff; /* Màu chữ trắng */
    }
</style>
@endsection
