@extends('admin.main')

@section('content')
<div class="list_user">
    <h3>Danh sách tin nhắn</h3>
    <ul>
        @foreach($users as $user)
            <li>
                <a href="{{ route('admin.chat.user', $user->id) }}">
                    <span class="user-name">{{ $user->name }}</span>
                </a>
                <p class="latest-message">
                    @if($user->latest_message)
                        @if($user->latest_message->is_admin)
                            <strong>Bạn:</strong> {{ $user->latest_message->message }}
                        @else
                            <strong>{{ $user->name }}:</strong> {{ $user->latest_message->message }}
                        @endif
                    @else
                        Chưa có tin nhắn nào.
                    @endif
                </p>
            </li>
        @endforeach
    </ul>
</div>
@endsection
