<div class="container">
    <form action="/check_login" method="post" class="login-form">
        <h1>Đăng Nhập </h1>
        <input type="text" name="email" placeholder="Email" class="form-input">
        <input type="password" name="password" placeholder="Password" class="form-input">
        <button type="submit" class="form-button">Login</button>
        @csrf
    </form>
</div>

<style>
    /* CSS cho nền trang */
    body {
        background-color: #3C3C3C; /* Nền màu xám */
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100vh;
        margin: 0;
    }
    h1{
        color: white;
    }

    /* CSS căn giữa cho form đăng nhập */
    .container {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100%; /* Căn giữa theo chiều dọc */
    }

    .login-form {
        width: 100%;
        max-width: 400px;
        padding: 20px;
        background-color: black; /* Màu nền nhã nhặn cho form */
        border: 1px solid #ddd;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); /* Hiệu ứng đổ bóng */
        text-align: center;
    }

    .login-form .form-input {
        width: 100%;
        padding: 12px;
        margin-bottom: 15px;
        font-size: 16px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        transition: border-color 0.3s;
    }

    .login-form .form-input:focus {
        border-color: #4CAF50; /* Đổi màu viền khi focus */
        outline: none;
    }

    .login-form .form-button {
    width: 100%;
    padding: 12px;
    font-size: 16px;
    color: white;
    background-color: black; /* Màu nền nút */
    border: 2px solid white; /* Thay đổi đây để thêm viền trắng */
    border-radius: 4px; /* Sửa lại góc bo cho nút */
    cursor: pointer;
    transition: background-color 0.3s, border-color 0.3s; /* Thêm hiệu ứng chuyển màu cho viền */
}

.login-form .form-button:hover {
    background-color: #ddd; /* Đổi màu khi hover */
    border-color: #3C3C3C; /* Đổi màu viền khi hover (tuỳ chọn) */
}

</style>
