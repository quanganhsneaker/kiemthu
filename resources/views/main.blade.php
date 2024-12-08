<!DOCTYPE html>
<html lang="en">
<head>
  @include('parts.head')
</head>
<body>
    <!-- ========header================ -->
 @include('parts.header')

 <!-- content -->

@yield('content')

<!-- ============hotproduct============== -->
@include('parts.hotproduct')
<!-- ==============acer================ -->

 <!-- footer -->
@include('parts.footer')

  <!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>
</html>