@extends('main')
@section('content')
<div class="chat-container">
    <div class="chat-header">
        <h3>Nhắn tin</h3>
    </div>
    <div class="chat-body" id="chatBody">
        @foreach($messages as $message)
            <div class="message {{ $message->is_admin ? 'received' : 'sent' }}">
                <p>{{ $message->message }}</p>
            </div>
        @endforeach
    </div>
    <div class="chat-footer">
        <form id="messageForm" action="{{ route('send.message') }}" method="POST" onsubmit="return sendMessage(event);">
            @csrf
            <input type="text" id="messageInput" name="message" placeholder="Nhập tin nhắn..." required>
            <button type="submit">Gửi</button>
        </form>

    </div>
</div>
<script>
    function sendMessage(event) {
        event.preventDefault();
        const messageInput = document.getElementById('messageInput');
        const message = messageInput.value.trim();

        if (message) {
            fetch("{{ route('send.message') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ message: message })
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
