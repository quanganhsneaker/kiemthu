<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.parts.head')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}"> <!-- Link đến file CSS cho Dashboard -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!-- Thư viện biểu đồ -->
    <style>
        /* CSS để điều chỉnh kích thước và bố cục biểu đồ và widget */
        .chart-container {
            flex: 1;
            margin: 10px;
            max-width: 400px;
        }

        .chart-row {
            display: flex;
            justify-content: space-around;
        }

        canvas {
            width: 400px !important;
            height: 400px !important;
        }

        .dashboard-widgets {
            display: flex;
            justify-content: space-around;
            margin-bottom: 20px;
        }

        .widget {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 20px;
            text-align: center;
            flex: 1;
            margin: 0 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .table-container {
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f4f4f4;
        }
    </style>
</head>

<body>
    <section class="admin">
        <div class="row-grid">
            <div class="admin-sidebar">
                @include('admin.parts.sidebar')
            </div>
            <div class="admin-content">
                <div class="admin-content-top">
                    @include('admin.parts.header')
                </div>
                <div class="admin-content-main">
                    <div class="admin-content-main-title">
                        <h1>DASHBOARD</h1>
                    </div>
                    <div class="admin-content-main-content">
                        <div class="dashboard-widgets">
                            <div class="widget">
                                <h2>Users</h2>
                                <p>{{ $totalUsers }}</p> <!-- Số lượng người dùng -->
                            </div>
                            <div class="widget">
                                <h2>Doanh thu</h2>
                                <p>{{number_format( $totalRevenue )}} VNĐ</p> <!-- Hiển thị tổng doanh thu thực tế -->
                            </div>
                            <div class="widget">
                                <h2>Đơn hàng</h2>
                                <p>{{ $totalOrders }}</p> <!-- Doanh thu -->
                            </div>
                           
                        </div>

                        <div class="chart-row">
                            <div class="chart-container">
                                <h2>Revenue Statistics</h2>
                                <canvas id="revenueChart"></canvas>
                            </div>

                            <div class="chart-container">
                                <h2>User Statistics</h2>
                                <canvas id="userChart"></canvas>
                            </div>
                        </div>
                        <div class="user-statistics">
                        <div class="abc123">
                            <h2>Khách hàng thân thiết</h2>
                            <table>
                                <thead>
                                    <tr>
                                        <th> ID</th>
                                        <th>User</th>
                                        <th>Tổng chi tiêu</th>

                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>01</td>
                                        <td>Quang Anh</td>
                                        <td>200,000,000 VNĐ</td>
                                      
                                        <td>2024-11-01</td>
                                    </tr>
                                    <tr>
                                        <td>02</td>
                                        <td>Mguyễn Thị Diệu</td>
                                        <td>100,000,000 VNĐ</td>
                                      
                                        <td>2024-11-02</td>
                                    </tr>
                                    <tr>
                                        <td>03</td>
                                        <td>Nguyễn Thị Ngọc Khánh</td>
                                        <td>50,000,000 VNĐ</td>
                                  
                                        <td>2024-11-03</td>
                                    </tr>
                                    <tr>
                                        <td>04</td>
                                        <td>Phạm Thu Quỳnh</td>
                                        <td>80,000,000 VNĐ</td>
                                  
                                        <td>2024-11-03</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <footer>
        @include('admin.parts.footer')
    </footer>

    <script>
        const ctxRevenue = document.getElementById('revenueChart').getContext('2d');
        const revenueChart = new Chart(ctxRevenue, {
            type: 'line',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                datasets: [{
                    label: 'Revenue',
                    data: [12, 19, 3, 5, 2, 3, 7],
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        const ctxUser = document.getElementById('userChart').getContext('2d');
        const userChart = new Chart(ctxUser, {
            type: 'bar',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                datasets: [{
                    label: 'Users',
                    data: [10, 15, 7, 20, 25, 15, 30],
                    backgroundColor: 'rgba(153, 102, 255, 0.6)',
                    borderColor: 'rgba(153, 102, 255, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>

</html>
