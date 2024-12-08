@extends('admin.main')

@section('content')
<div class="chat-container">
    <div class="chat-header">
        <h3>Nhắn tin với {{ $user->name }}</h3>
    </div>
    <div class="chat-body" id="chatBody">
        @foreach($messages as $message)
            <div class="message {{ $message->is_admin ? 'sent' : 'received' }}">
                <p> {{ $message->message }}</p>
            </div>
        @endforeach
    </div>
    <div class="chat-footer">
        <form id="adminMessageForm" action="{{ route('send.admin.message') }}" method="POST" onsubmit="return sendAdminMessage(event);">
            @csrf
            <input type="hidden" name="user_id" value="{{ $user->id }}">
            <input type="text" id="adminMessageInput" name="message" placeholder="Nhập tin nhắn..." required>
            <button type="submit">Gửi</button>
        </form>
    </div>

</div>
<pre>     <a href="/admin/chat/list_users"><button class="main-btn"> Thoát </button></a></pre>
<script>
    function sendAdminMessage(event) {
        event.preventDefault();
        const messageInput = document.getElementById('adminMessageInput');
        const message = messageInput.value.trim();
        const userId = document.querySelector('input[name="user_id"]').value;

        if (message) {
            fetch("{{ route('send.admin.message') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ message: message, user_id: userId })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload(); // Reload lại trang để xem tin nhắn mới
                }
            });
        }
    }
</script>
@endsection
