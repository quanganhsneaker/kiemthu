@extends('main')

@section('content')
@if (Auth::check())
<div class="complaint-container">
    <h1>Khiếu Nại Sản Phẩm</h1>
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
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form action="{{ route('complaint.store') }}" method="post">
        @csrf
        <div>
            <input type="text" name="name" placeholder="Họ và Tên" class="form-input" value="{{ old('name') }}" >
            @if ($errors->has('name'))
            <span class="text-danger">{{ $errors->first('name') }}</span>
            @endif
        </div>
        <div>
            <input type="email" name="email" placeholder="Email" class="form-input" value="{{ old('email') }}" >
            @if ($errors->has('email'))
            <span class="text-danger">{{ $errors->first('email') }}</span>
            @endif
        </div>
        <div>
            <input type="text" name="product_id" placeholder="Mã Sản Phẩm" class="form-input" value="{{ old('product_id') }}" >
            @if ($errors->has('product_id'))
            <span class="text-danger">{{ $errors->first('product_id') }}</span>
            @endif
        </div>
        <div>
            <input type="number" name="phone" placeholder="Số điện thoại" class="form-input" value="{{ old('phone') }}" >
            @if ($errors->has('phone'))
            <span class="text-danger">{{ $errors->first('phone') }}</span>
            @endif
        </div>
        <div>
            <select name="gender" class="form-input" >
                <option value="">Chọn giới tính</option>
                <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Nam</option>
                <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Nữ</option>
                <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Khác</option>
            </select>
            @if ($errors->has('gender'))
            <span class="text-danger">{{ $errors->first('gender') }}</span>
            @endif
        </div>
        <div>
            <select name="product" class="form-input" >
                <option value="">Chọn lý do</option>
                <option value="Hàng lỗi" {{ old('product') == 'Hàng lỗi' ? 'selected' : '' }}>Hàng lỗi</option>
                <option value="Không giống mô tả" {{ old('product') == 'Không giống mô tả' ? 'selected' : '' }}>Không giống mô tả</option>
                <option value="Khác" {{ old('product') == 'Khác' ? 'selected' : '' }}>Khác</option>
            </select>
            @if ($errors->has('product'))
            <span class="text-danger">{{ $errors->first('product') }}</span>
            @endif
        </div>
        <div>
            <textarea name="complaint_message" placeholder="Ghi chú thêm" class="form-textarea" rows="4" >{{ old('complaint_message') }}</textarea>
            @if ($errors->has('complaint_message'))
            <span class="text-danger">{{ $errors->first('complaint_message') }}</span>
            @endif
        </div>
        <button type="submit" class="form-button">Gửi Khiếu Nại</button>
    </form>
</div>
<div class="noel">
    <img src="https://cdnv2.tgdd.vn/webmwg/2024/ContentMwg/images/noel/2024/tgdd/label-left.png" alt="">
    <img src="https://cdnv2.tgdd.vn/webmwg/2024/ContentMwg/images/noel/2024/tgdd/label-right.png" alt="">
</div>
@endif
@endsection