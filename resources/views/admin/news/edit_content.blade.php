@extends('admin.main')

@section('content')
<div class="container">
    <h2 class="form-title">Cập Nhật Thông Tin</h2>

    <!-- Hiển thị thông báo thành công nếu có -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.updateContent') }}" method="POST" enctype="multipart/form-data" class="form-container">
        @csrf
        @method('PUT')

        {{-- ================================================================= --}}

        <div class="form-row">
            <!-- Tiêu đề khuyến mãi -->
            <div class="form-group">
                <label for="promotion_title">Tiêu Đề Khuyến Mãi</label>
                <input type="text" name="promotion_title" id="promotion_title" class="form-control" 
                    value="{{ old('promotion_title', $content->promotion_title ?? '') }}">
                @error('promotion_title')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Mô tả khuyến mãi -->
            <div class="form-group">
                <label for="promotion_description">Mô Tả Khuyến Mãi</label>
                <textarea name="promotion_description" id="promotion_description" rows="5" class="form-control">
                    {{ old('promotion_description', $content->promotion_description ?? '') }}
                </textarea>
                @error('promotion_description')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Số lượng còn lại -->
            <div class="form-group">
                <label for="remaining_quantity">Số Lượng Còn Lại</label>
                <input type="number" name="remaining_quantity" id="remaining_quantity" class="form-control" 
                    value="{{ old('remaining_quantity', $content->remaining_quantity ?? '') }}">
                @error('remaining_quantity')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Hình ảnh khuyến mãi 1 -->
            <div class="form-group">
                <label for="hpvenus_image">Hình ảnh khuyến mãi 1</label>
                <input type="file" name="hpvenus_image" id="hpvenus_image" class="form-control">
                @if($content && $content->hpvenus_image && Storage::exists('public/images/' . $content->hpvenus_image))
                    <img src="{{ asset('storage/images/' . $content->hpvenus_image) }}" alt="HP Venus" 
                        class="preview-image" style="width: 150px; height: auto;">
                @else
                    <p>Không có hình ảnh</p>
                @endif
                @error('hpvenus_image')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        {{-- ================================================================= --}}

        <div class="form-row">
            <!-- Hình ảnh khuyến mãi 2 -->
            <div class="form-group">
                <label for="asustuf_image">Hình ảnh khuyến mãi 2</label>
                <input type="file" name="asustuf_image" id="asustuf_image" class="form-control">
                @if($content && $content->asustuf_image && Storage::exists('public/images/' . $content->asustuf_image))
                    <img src="{{ asset('storage/images/' . $content->asustuf_image) }}" alt="Asus TUF" 
                        class="preview-image" style="width: 150px; height: auto;">
                @else
                    <p>Không có hình ảnh</p>
                @endif
                @error('asustuf_image')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        {{-- ================================================================= --}}

        <div class="ft1">
            <!-- Feature 1 -->
            <div class="form-group">
                <label for="company_title">Feature 1</label>
                <input type="text" name="company_title" id="company_title" class="form-control" 
                    value="{{ old('company_title', $content->company_title ?? '') }}">
                @error('company_title')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="company_description">Mô Tả Feature 1</label>
                <textarea name="company_description" id="company_description" rows="5" class="form-control">
                    {{ old('company_description', $content->company_description ?? '') }}
                </textarea>
                @error('company_description')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="company_image">Hình ảnh Feature 1</label>
                <input type="file" name="company_image" id="company_image" class="form-control">
                @if($content && $content->company_image && Storage::exists('public/images/' . $content->company_image))
                    <img src="{{ asset('storage/images/' . $content->company_image) }}" alt="Hình ảnh Công Ty" 
                        class="preview-image" style="width: 150px; height: auto;">
                @else
                    <p>Không có hình ảnh</p>
                @endif
                @error('company_image')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        {{-- ================================================================= --}}

        <div class="ft2">
            <!-- Feature 2 -->
            <div class="form-group">
                <label for="return_policy">Feature 2</label>
                <textarea name="return_policy" id="return_policy" rows="5" class="form-control">
                    {{ old('return_policy', $content->return_policy ?? '') }}
                </textarea>
                @error('return_policy')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="feature2_description">Mô Tả Feature 2</label>
                <textarea name="feature2_description" id="feature2_description" rows="5" class="form-control">
                    {{ old('feature2_description', $content->feature2_description ?? '') }}
                </textarea>
                @error('feature2_description')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="feature2_image">Hình ảnh Feature 2</label>
                <input type="file" name="feature2_image" id="feature2_image" class="form-control">
                @if($content && $content->feature2_image && Storage::exists('public/images/' . $content->feature2_image))
                    <img src="{{ asset('storage/images/' . $content->feature2_image) }}" alt="Feedback Image" 
                        class="preview-image" style="width: 150px; height: auto;">
                @else
                    <p>Không có hình ảnh</p>
                @endif
                @error('feature2_image')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        {{-- ================================================================= --}}

       <div class="ft3">
        <div class="form-group">
            <label for="feedback_image">Hình ảnh FeedBack</label>
            <input type="file" name="feedback_image" id="feedback_image" class="form-control">
            @if($content && $content->feedback_image && Storage::exists('public/images/' . $content->feedback_image))
                <img src="{{ asset('storage/images/' . $content->feedback_image) }}" alt="Feedback Image" 
                    class="preview-image" style="width: 150px; height: auto;">
            @else
                <p>Không có hình ảnh</p>
            @endif
            @error('feedback_image')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Text feedback -->
        <div class="form-group">
            <label for="feedback_text">Text Feedback</label>
            <textarea name="feedback_text" id="feedback_text" rows="5" class="form-control">
                {{ old('feedback_text', $content->feedback_text ?? '') }}
            </textarea>
            @error('feedback_text')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
       </div>

        <!-- Submit -->
        <button type="submit" class="btn btn-primary btn-submit">Cập nhật</button>
    </form>
</div>
@endsection
