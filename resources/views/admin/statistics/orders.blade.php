@extends('admin.main')

@section('content')

<div class="revenue-info">
    

    <!-- Thêm canvas cho biểu đồ -->
    <canvas id="orderChart" width="400" height="200"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById('orderChart').getContext('2d');
    var orderChart = new Chart(ctx, {
        type: 'bar', // Loại biểu đồ (có thể thay đổi thành 'line', 'pie', v.v.)
        data: {
            labels: ['Tổng số đơn hàng', 'Đơn hàng đã xác nhận', 'Đơn hàng đang chờ xác nhận'], // Nhãn cho các cột
            datasets: [{
                label: 'Số lượng đơn hàng',
                data: [{{ $tong }}, {{ $daxacnhan }}, {{ $chuaxacnhan }}], // Dữ liệu từ controller
                backgroundColor: [
                    'rgba(75, 192, 192, 0.2)', // Màu nền cho cột tổng số đơn hàng
                    'rgba(153, 102, 255, 0.2)', // Màu nền cho cột đơn hàng đã xác nhận
                    'rgba(255, 99, 132, 0.2)' // Màu nền cho cột đơn hàng đang chờ xác nhận
                ],
                borderColor: [
                    'rgba(75, 192, 192, 1)', // Màu viền cho cột tổng số đơn hàng
                    'rgba(153, 102, 255, 1)', // Màu viền cho cột đơn hàng đã xác nhận
                    'rgba(255, 99, 132, 1)' // Màu viền cho cột đơn hàng đang chờ xác nhận
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true // Bắt đầu trục y từ 0
                }
            }
        }
    });
</script>
<div class="revenue-info">
    <p>Tổng số đơn hàng: <strong>{{ $tong }}</strong></p>
    <p>Đơn hàng đã xác nhận: <strong>{{ $daxacnhan }}</strong></p>
    <p>Đơn hàng đang chờ xác nhận: <strong>{{ $chuaxacnhan }}</strong></p>
</div>
@endsection
