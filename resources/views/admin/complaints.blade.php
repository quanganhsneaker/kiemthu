@extends('admin.main')

@section('content')
<div class="user-statistics">

    <table class="abc123">
        <tr>
            <th>ID</th>
            <th>Họ và Tên</th>
            <th>Email</th>
            <th>Mã Sản Phẩm</th>
            <th>Điện thoại</th>
            <th>Giới tính</th>
            <th>Lý do</th>
            <th>Ghi chú</th>
            <th>Ngày gửi</th>
            <th>Trạng thái</th>
            <th>Hành động</th>
        </tr>
        @foreach($danhsachkhieunai as $laylen)
        <tr>
            <td>{{ $laylen->id }}</td>
            <td>{{ $laylen->name }}</td>
            <td>{{ $laylen->email }}</td>
            <td>{{ $laylen->product_id }}</td>
            <td>{{ $laylen->phone }}</td>
            <td>{{ $laylen->gender }}</td>
            <td>{{ $laylen->product }}</td>
            <td>{{ $laylen->complaint_message }}</td>
            <td>{{ $laylen->created_at }}</td>
            <td>{{ $laylen->status ? 'Đã xác nhận' : 'Chưa xác nhận' }}</td>
            <td>
                @if(!$laylen->status)
                <form action="{{ route('admin.complaints.confirm', $laylen->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="non-confirm-oder">Xác nhận</button>
                </form>
                @else
                <span>Đã xác nhận</span>
                @endif
            </td>
        </tr>
        @endforeach
    </table>
</div>
@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

@endsection
