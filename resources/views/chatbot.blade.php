@extends('layouts.app')

@section('title', 'AI Chatbot')

@push('styles')
<style>
    .chat-container {
        height: 500px;
        overflow-y: auto;
        border: 1px solid #ddd;
        border-radius: 10px;
        padding: 20px;
        background: #f9f9f9;
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
        padding: 10px 15px;
        border-radius: 20px;
    }
    .user-message .message-bubble {
        background: #007bff;
        color: white;
    }
    .ai-message .message-bubble {
        background: #e9ecef;
        color: #333;
    }
    .loading {
        text-align: center;
        color: #666;
        display: none;
    }
</style>
@endpush

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <h1>AI Chatbot</h1>
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
        
        <div class="loading" id="loading">AI is thinking...</div>
        
        <div class="input-group mt-3">
            <input type="text" id="messageInput" class="form-control" placeholder="Type your message here...">
            <button class="btn btn-primary" id="sendBtn">Send</button>
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
    
    // Scroll to bottom
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
            error: function(xhr) {
                loading.hide();
                addMessage('Sorry, an error occurred. Please try again.', false);
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