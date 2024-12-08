@extends('admin.main')

@section('content')

<div class="user-statistics">
    <!-- Hiển thị tổng số người dùng -->
  
    
    <!-- Thêm canvas cho biểu đồ -->
    <canvas id="userChart" width="400" height="400"></canvas>
    
    <!-- Tạo bảng để hiển thị danh sách người dùng -->
    <table class="abc123">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên người dùng</th>
                <th>Email</th>
                <th>Ngày tạo tài khoản</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->created_at }}</td>
                <td>
                    <!-- Nút xóa -->
                    <form action="{{ route('admin.user.delete', $user->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa người dùng này không?');">
                        @csrf
                        @method('DELETE') 
                        <button type="submit" class="delete-class">Xóa </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
</div>

<!-- Thêm script để vẽ biểu đồ -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Dữ liệu cho biểu đồ tròn
    const ctx = document.getElementById('userChart').getContext('2d');
    const userChart = new Chart(ctx, {
        type: 'pie', // Loại biểu đồ
        data: {
            labels: ['Người dùng hiện tại', 'Người dùng chưa xác minh'], // Tùy chỉnh nhãn nếu cần
            datasets: [{
                label: 'Tổng người dùng',
                data: [{{ $totalUsers }}, 100 - {{ $totalUsers }}], // Cập nhật số liệu cho phù hợp
                backgroundColor: [
                    'rgba(75, 192, 192, 0.2)', // Màu cho người dùng hiện tại
                    'rgba(255, 99, 132, 0.2)' // Màu cho người dùng chưa xác minh
                ],
                borderColor: [
                    'rgba(75, 192, 192, 1)', // Đường viền màu cho người dùng hiện tại
                    'rgba(255, 99, 132, 1)' // Đường viền màu cho người dùng chưa xác minh
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top', // Vị trí của legend
                },
                title: {
                    display: true,
                    text: 'Biểu đồ tỷ lệ người dùng' // Tiêu đề cho biểu đồ
                }
            }
        }
    });
</script>
<style>
    /* Đặt kích thước cho canvas */
    #userChart {
        max-width: 400px; /* Kích thước tối đa của biểu đồ */
        max-height: 400px; /* Kích thước tối đa của biểu đồ */
        width: 100%; /* Để biểu đồ tự động điều chỉnh chiều rộng */
        height: auto; /* Chiều cao tự động dựa trên chiều rộng */
     
       margin: 30px auto;
    }
</style>
@endsection
