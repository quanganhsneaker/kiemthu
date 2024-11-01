@extends('main')

@section('content')
<div class="complaint-container">
    <h1>Khiếu Nại Sản Phẩm</h1>
    <form action="/submit_complaint" method="post">
        <input type="text" name="name" placeholder="Họ và Tên" class="form-input" required>
        <input type="email" name="email" placeholder="Email" class="form-input" required>
        <input type="text" name="product_id" placeholder="Mã Sản Phẩm" class="form-input" required>
        <input type="number" name="phone" placeholder="Phone" class="form-input" required>
    
        
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

<style>
    /* CSS cho nền trang và căn giữa */
    body {
        background-color: #f3f3f3; /* Màu nền xám nhạt */
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: space-between;
        min-height: 100vh;
        margin: 0;
        font-family: Arial, sans-serif;
    }

    /* CSS cho container khiếu nại */
    .complaint-container {
 
        width: 100%;
        max-width: 600px;
        padding: 20px;
        background-color: white;
        border: 1px solid #ddd;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        margin-top: 120px;
        text-align: center;
       
    }

    /* CSS cho tiêu đề */
    .complaint-container h1 {
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 20px;
        color: #333;
    }

    /* CSS cho các trường input và textarea */
    .form-input, .form-textarea {
        width: 100%;
        padding: 12px;
        margin-bottom: 15px;
        font-size: 16px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        transition: border-color 0.3s;
    }

    .form-input:focus, .form-textarea:focus {
        border-color: #4CAF50; /* Đổi màu viền khi focus */
        outline: none;
    }

    /* CSS cho nút gửi */
    .form-button {
        width: 100%;
        padding: 12px;
        font-size: 16px;
        color: white;
        background-color: black; /* Màu nền nút */
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .form-button:hover {
        background-color: #ddd; /* Đổi màu khi hover */
    }
</style>
@endsection
