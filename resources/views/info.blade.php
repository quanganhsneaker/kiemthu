@extends('main')

@section('content')
   <!-- Feature 1 -->
   <div class="features">
      <div class="main-content">
         <div class="body">
            <div class="images">
               <img class="lower" src="{{ asset('storage/images/' . $content->hpvenus_image) }}"  />
               <img class="hight" src="{{ asset('storage/images/' . $content->asustuf_image) }}"  />
            </div>
            <div class="content">
               <h2 class="heading-lv2">{{ $content->promotion_title }}</h2>
               <p class="desc">
                  {{ $content->promotion_description }}<br>
                  Số lượng chỉ còn ({{ $content->remaining_quantity }}) máy
               </p>
               <a href="/producttype" class="btn main-btn">Mua Ngay</a>
            </div>  
         </div>
      </div>
   </div>
   <!-- Feature 2 -->
   <div class="features features-2nd">
      <div class="main-content">
         <div class="body">
            <div class="images">
               <img style="width: 120%;" src="{{ asset('storage/images/' . $content->company_image) }}"  />
            </div>
            <div class="content">
               <h2 class="heading-lv2">{{ $content->company_title }}</h2>
               <p class="desc">{{ $content->company_description }}</p>
               <a href="{{ route('teddyshopf1') }}" class="btn main-btn">Xem Thêm</a>
            </div>
         </div>
      </div>
   </div>
   <!-- Feature 3 -->
   <div class="features features-2nd">
      <div class="main-content">
         <div class="body">
            <div class="content">
               <h2 class="heading-lv2">{{ $content->return_policy }}</h2>
               <p class="desc">{{ $content->feature2_description }}</p>
               <a href="{{ route('teddyshopf2') }}" class="btn main-btn">Xem Thêm</a>
            </div>
            <div class="images">
               <img style="width: 120%;" src="{{ asset('storage/images/' . $content->feature2_image) }}"  />
            </div>
         </div>
      </div>
   </div>

   <!-- Feedback -->
   <div class="feedback">
      <div class="container">
         <div class="feedback-list">
            <div class="feedback-item">
               <div class="info">
                  <img src="{{ asset('storage/images/' . $content->feedback_image) }}" alt="Quang Anh" class="avatar" />
                  <p class="member-name">Quang Anh</p>
               
               </div>
               <div class="info">
                
                <p class="desc">Student of HUNRE</p>
               </div>
               <div class="content">
          
                  <pre>{{ $content->feedback_text }}</pre>
               </div>
            </div>
         </div>
      </div>
   </div>
@endsection
