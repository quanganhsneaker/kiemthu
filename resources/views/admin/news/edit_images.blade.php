@extends('admin.main') <!-- Sử dụng layout admin.main -->

@section('content')
<div class="edit_img ">


    <form action="{{ route('admin.update.media') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="image1">Hình ảnh 1:</label>
            <input type="file" name="image1" id="image1" class="form-control">
            @if ($sliderImage1)
                <div class="mt-2">
                    <img src="{{ asset('storage/' . $sliderImage1) }}" alt="Hình ảnh 1" style="max-width: 200px; max-height: 200px;">
                </div>
            @endif
        </div>

        <div class="form-group">
            <label for="image2">Hình ảnh 2:</label>
            <input type="file" name="image2" id="image2" class="form-control">
            @if ($sliderImage2)
                <div class="mt-2">
                    <img src="{{ asset('storage/' . $sliderImage2) }}" alt="Hình ảnh 2" style="max-width: 200px; max-height: 200px;">
                </div>
            @endif
        </div>

        <div class="form-group">
            <label for="image3">Hình ảnh 3:</label>
            <input type="file" name="image3" id="image3" class="form-control">
            @if ($sliderImage3)
                <div class="mt-2">
                    <img src="{{ asset('storage/' . $sliderImage3) }}" alt="Hình ảnh 3" style="max-width: 200px; max-height: 200px;">
                </div>
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Cập Nhật Hình Ảnh</button>
    </form>
</div>
@endsection
