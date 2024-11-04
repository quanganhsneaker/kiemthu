@extends('admin.main')
@section('content')
<div class="user-statistics">
                            <table class="abc123">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Tên</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Địa Chỉ</th>
                                        <th>Ghi chú</th>
                                        <th>Chi tiết </th>
                                        <th>Ngày</th>
                                        <th>Trạng thái</th>
                                        <th>Tuỳ biến</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order )
                                    <tr>
                                        <td>{{$order -> id}}</td>
                                        <td>{{$order -> name}}</td>
                                        <td>{{$order -> phone}}</td>
                                        <td>{{$order -> email}}</td>
                                        <td>{{$order -> address}},{{$order -> city}}, {{$order -> district}},{{$order -> ward}}</td>
                                        <td>{{$order -> note}}</td>
                                        
                                        <td> <a class="edit-class" href="/admin/oder/details/{{$order -> order_detail}}">Details</a></td>
                                        <td>{{$order -> created_at}}</td>
                                        <td>
    @if($order->status === 'Đã xác nhận')
        <span class="confirmed-status">Đã xác nhận</span>
    @else
        <form action="{{ route('order.confirm', $order->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xác nhận đơn hàng này?');">
            @csrf
            <button type="submit" class="non-confirm-oder">Chưa xác nhận</button>
        </form>
    @endif
</td>

                                        <td>
                                        <form action="{{ route('order.delete', $order->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa đơn hàng này?');">
    @csrf
    @method('DELETE')
    <button type="submit" class="delete-class">Xóa</button>
</form>

                                            
                                        </td>
                                    </tr>
                             
                                    @endforeach
                                    
                                </tbody>
                             </table>
                         </div>
@endsection