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
                    @include('admin.parts.header')
                </div>
                <div class="admin-content-main">
                    <div class="admin-content-main-title">
                        <h1>DASHBOARD</h1>
                    </div>
                    <div class="admin-content-main-content">
                        <!-- nội dung nằm ở đây -->
                        <h1 style="text-align: center; font-size: xx-large">Chào mừng bạn đến với website dành cho Admin(quản trị viên)</h1>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <footer>
        @include('admin.parts.footer')
    </footer>

    </script>
</body>

</html>