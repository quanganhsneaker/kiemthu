<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.parts.head')
</head> 
<body>
    <section class="admin">
        <div class="row-grid">
            <div class="admin-sidebar">
                @include('admin.parts.sidebar')

            </div>
            <div class="admin-content">
                <div class="admin-content-top ">

                </div>
                <div class="admin-content-main">
                    <div class="admin-content-main-title">
                        <h1>{{isset($title)? $title : 'Dashboard'}}</h1>
                    </div>
                    <div class="admin-content-main-content">
                        <!-- nội dung nằm ở đây -->
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </section>
    <footer>
        @include('admin.parts.footer')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </footer>
    </script>
</body>
</html>