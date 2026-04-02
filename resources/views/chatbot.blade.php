@extends('layouts.app')

@section('title', 'AI Chatbot')

@push('styles')
<style>
    .chat-header {
        text-align: center;
        margin-bottom: 2rem;
        animation: fadeInDown 0.6s ease-out;
    }

    .chat-title {
        font-size: 2.5rem;
        font-weight: 800;
        background: linear-gradient(135deg, #ffffff, #c084fc, #60a5fa);
        -webkit-background-clip: text;
        color: transparent;
    }

    .chat-container {
        height: 500px;
        overflow-y: auto;
        border-radius: 24px;
        padding: 20px;
        background: linear-gradient(135deg, #1e1e2a, #18181f);
        border: 1px solid rgba(139, 92, 246, 0.2);
        animation: fadeInUp 0.6s ease-out;
    }

    .message {
        margin-bottom: 15px;
        display: flex;
    }

    .user-message {
        justify-content: flex-end;
    }

    .ai-message {
        justify-content: flex-start;
    }

    .message-bubble {
        max-width: 70%;
        padding: 12px 16px;
        border-radius: 18px;
        font-size: 0.9rem;
    }

    .user-message .message-bubble {
        background: linear-gradient(135deg, #8b5cf6, #3b82f6);
        color: white;
        border-bottom-right-radius: 5px;
    }

    .ai-message .message-bubble {
        background: rgba(42, 42, 54, 0.9);
        color: #e5e5e5;
        border-bottom-left-radius: 5px;
    }

    .loading {
        text-align: center;
        color: #9ca3af;
        display: none;
        margin-top: 10px;
    }

    .chat-input {
        margin-top: 1rem;
        background: rgba(30, 30, 42, 0.6);
        padding: 10px;
        border-radius: 20px;
        border: 1px solid rgba(139, 92, 246, 0.2);
        display: flex;
        gap: 10px;
    }

    .chat-input input {
        flex: 1;
        background: transparent;
        border: none;
        color: white;
        padding: 10px;
    }

    .chat-input input:focus {
        outline: none;
    }

    .send-btn {
        background: linear-gradient(135deg, #8b5cf6, #3b82f6);
        border: none;
        border-radius: 50%;
        width: 45px;
        height: 45px;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: 0.3s;
    }

    .send-btn:hover {
        transform: scale(1.1);
        box-shadow: 0 5px 15px rgba(139, 92, 246, 0.4);
    }

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @keyframes fadeInDown {
        from { opacity: 0; transform: translateY(-30px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endpush

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">

        <div class="chat-header">
            <h1 class="chat-title">AI Chatbot</h1>
            <p style="color:#9ca3af;">Chat intelligently with DeepChat AI</p>
        </div>

        <div class="chat-container" id="chatContainer">
            @if(session('user_id') && isset($chatHistory))
                @foreach($chatHistory as $chat)
                    <div class="message user-message">
                        <div class="message-bubble">{{ $chat->user_message }}</div>
                    </div>
                    <div class="message ai-message">
                        <div class="message-bubble">{{ $chat->ai_response }}</div>
                    </div>
                @endforeach
            @endif
        </div>

        <div class="loading" id="loading">
            <i class="fas fa-spinner fa-spin"></i> AI is thinking...
        </div>

        <div class="chat-input">
            <input type="text" id="messageInput" placeholder="Type your message...">
            <button class="send-btn" id="sendBtn">
                <i class="fas fa-paper-plane"></i>
            </button>
        </div>

    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    const chatContainer = $('#chatContainer');
    const messageInput = $('#messageInput');
    const sendBtn = $('#sendBtn');
    const loading = $('#loading');

    function scrollToBottom() {
        chatContainer.scrollTop(chatContainer[0].scrollHeight);
    }
    scrollToBottom();

    function addMessage(text, isUser) {
        const messageDiv = $('<div>').addClass('message').addClass(isUser ? 'user-message' : 'ai-message');
        const bubble = $('<div>').addClass('message-bubble').text(text);
        messageDiv.append(bubble);
        chatContainer.append(messageDiv);
        scrollToBottom();
    }

    function sendMessage() {
        const message = messageInput.val().trim();
        if (!message) return;

        addMessage(message, true);
        messageInput.val('');
        loading.show();

        $.ajax({
            url: '{{ route("chatbot.send") }}',
            method: 'POST',
            data: {
                message: message,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                loading.hide();
                addMessage(response.response, false);
            },
            error: function() {
                loading.hide();
                addMessage('Error occurred. Try again.', false);
            }
        });
    }

    sendBtn.click(sendMessage);
    messageInput.keypress(function(e) {
        if (e.which == 13) sendMessage();
    });
});
</script>
@endpush