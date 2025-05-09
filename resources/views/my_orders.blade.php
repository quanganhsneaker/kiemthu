@extends('main')

@section('content')
    <style>
        .container123 {
            max-width: 800px; /* Giới hạn chiều rộng của container */
            margin: 20px auto; /* Canh giữa */
            padding: 20px; /* Padding cho container */
            background-color: #f9f9f9; /* Màu nền sáng */
            border-radius: 8px; /* Bo tròn góc */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Đổ bóng nhẹ */
            margin-top: 100px;
        }

        h2 {
            text-align: center; /* Căn giữa tiêu đề */
            color: #333; /* Màu chữ */
            margin-bottom: 20px; /* Khoảng cách dưới tiêu đề */
        }

        table {
            width: 100%; /* Chiều rộng 100% cho bảng */
            border-collapse: collapse; /* Hợp nhất các viền bảng */
            margin-top: 10px; /* Khoảng cách trên bảng */
        }

        th, td {
            padding: 12px; /* Padding cho ô */
            text-align: left; /* Căn trái nội dung trong ô */
            border-bottom: 1px solid #ddd; /* Viền dưới cho ô */
        }

        th {
            background-color: black; /* Màu nền cho tiêu đề bảng */
            color: white; /* Màu chữ cho tiêu đề bảng */
        }

        tr:hover {
            background-color: #f1f1f1; /* Màu nền cho hàng khi hover */
        }

        a {
            color: black; /* Màu chữ cho liên kết */
            text-decoration: none; /* Bỏ gạch chân */
        }

       
    </style>

<section class="container123">
    <h2>Danh Sách Đơn Hàng</h2>
    <table>
        <thead>
            <tr>
                <th>ID Đơn Hàng</th>
                <th>Tên Người Nhận</th>
                <th>Ngày Đặt Hàng</th>
                <th>Tổng Tiền</th>
                <th>Chi Tiết</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->name }}</td>
                    <td>{{ $order->created_at->format('d/m/Y') }}</td>
                    <td>{{ number_format($order->total_price) }} <sup>đ</sup></td>
                    <td><a href="{{ route('order.details', $order->id) }}">Xem Chi Tiết</a></td>
                </tr>
                
            @endforeach
            <tr>
                <td style="font-weight: 800;text-align: center" colspan="3">Tổng tiền của tất cả Đơn Hàng bạn đã chi tiêu: </td>
                <td style="font-weight: 800;text-align: center" colspan="2">{{ number_format($grandTotal) }} <sup>đ</sup></td>
            </tr>
        </tbody>
    </table>
  
    
</section>
<div class="noel"> 
    <img src="https://cdnv2.tgdd.vn/webmwg/2024/ContentMwg/images/noel/2024/tgdd/label-left.png" alt="">
     <img src="https://cdnv2.tgdd.vn/webmwg/2024/ContentMwg/images/noel/2024/tgdd/label-right.png" alt="">
       </div>
@endsection
