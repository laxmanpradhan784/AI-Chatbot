@extends('layouts.app')

@section('title', 'AI Chatbot')

@push('styles')
<style>
    .chat-header {
        text-align: center;
        margin-bottom: 2rem;
        animation: fadeInDown 0.6s ease-out;
    }

    .chat-badge {
        display: inline-block;
        background: linear-gradient(135deg, rgba(139, 92, 246, 0.2), rgba(59, 130, 246, 0.1));
        border: 1px solid rgba(139, 92, 246, 0.3);
        border-radius: 100px;
        padding: 0.3rem 1rem;
        font-size: 0.75rem;
        font-weight: 500;
        color: #c084fc;
        margin-bottom: 1rem;
    }

    .chat-title {
        font-size: 2.5rem;
        font-weight: 800;
        background: linear-gradient(135deg, #ffffff, #c084fc, #60a5fa);
        background-clip: text;
        -webkit-background-clip: text;
        color: transparent;
        margin-bottom: 0.5rem;
    }

    .chat-subtitle {
        color: #9ca3af;
        font-size: 0.9rem;
    }

    /* Chat Container */
    .chat-wrapper {
        background: linear-gradient(135deg, #1e1e2a, #18181f);
        border-radius: 32px;
        border: 1px solid rgba(139, 92, 246, 0.2);
        overflow: hidden;
        animation: fadeInUp 0.6s ease-out;
    }

    .chat-container {
        height: 450px;
        overflow-y: auto;
        padding: 1.5rem;
        scroll-behavior: smooth;
    }

    /* Custom Scrollbar */
    .chat-container::-webkit-scrollbar {
        width: 6px;
    }

    .chat-container::-webkit-scrollbar-track {
        background: #2a2a36;
        border-radius: 10px;
    }

    .chat-container::-webkit-scrollbar-thumb {
        background: #8b5cf6;
        border-radius: 10px;
    }

    /* Message Styles */
    .message {
        margin-bottom: 1.2rem;
        display: flex;
        animation: messageSlideIn 0.3s ease-out;
    }

    @keyframes messageSlideIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .user-message {
        justify-content: flex-end;
    }

    .ai-message {
        justify-content: flex-start;
    }

    .message-bubble {
        max-width: 75%;
        padding: 0.9rem 1.2rem;
        border-radius: 20px;
        font-size: 0.9rem;
        line-height: 1.5;
        position: relative;
        word-wrap: break-word;
    }

    .user-message .message-bubble {
        background: linear-gradient(135deg, #8b5cf6, #3b82f6);
        color: white;
        border-bottom-right-radius: 5px;
        box-shadow: 0 2px 8px rgba(139, 92, 246, 0.3);
    }

    .ai-message .message-bubble {
        background: rgba(42, 42, 54, 0.95);
        color: #e5e5e5;
        border-bottom-left-radius: 5px;
        border: 1px solid rgba(139, 92, 246, 0.2);
    }

    /* Message Avatar */
    .message-avatar {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 10px;
        flex-shrink: 0;
    }

    .ai-message .message-avatar {
        background: linear-gradient(135deg, #8b5cf6, #3b82f6);
    }

    .ai-message .message-avatar i {
        font-size: 0.9rem;
        color: white;
    }

    .user-message .message-avatar {
        margin-left: 10px;
        margin-right: 0;
        background: #3a3a4a;
    }

    .user-message .message-avatar i {
        font-size: 0.9rem;
        color: #c084fc;
    }

    .message-content {
        display: flex;
        align-items: flex-start;
        max-width: 85%;
    }

    .user-message .message-content {
        flex-direction: row-reverse;
    }

    /* Typing Indicator */
    .typing-indicator {
        display: flex;
        align-items: center;
        gap: 4px;
        padding: 0.9rem 1.2rem;
        background: rgba(42, 42, 54, 0.95);
        border-radius: 20px;
        border-bottom-left-radius: 5px;
        border: 1px solid rgba(139, 92, 246, 0.2);
    }

    .typing-indicator span {
        width: 8px;
        height: 8px;
        background: #c084fc;
        border-radius: 50%;
        animation: typing 1.4s infinite;
    }

    .typing-indicator span:nth-child(2) {
        animation-delay: 0.2s;
    }

    .typing-indicator span:nth-child(3) {
        animation-delay: 0.4s;
    }

    @keyframes typing {
        0%, 60%, 100% {
            transform: translateY(0);
            opacity: 0.4;
        }
        30% {
            transform: translateY(-10px);
            opacity: 1;
        }
    }

    /* Chat Input Area */
    .chat-input-area {
        padding: 1rem 1.5rem 1.5rem;
        background: rgba(20, 20, 26, 0.8);
        border-top: 1px solid rgba(139, 92, 246, 0.15);
    }

    .input-wrapper {
        display: flex;
        gap: 12px;
        background: #2a2a36;
        border: 1.5px solid #3c3c48;
        border-radius: 60px;
        padding: 0.3rem 0.3rem 0.3rem 1.2rem;
        transition: all 0.3s ease;
    }

    .input-wrapper:focus-within {
        border-color: #8b5cf6;
        box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.2);
    }

    .input-wrapper input {
        flex: 1;
        background: transparent;
        border: none;
        color: #f0f0f5;
        padding: 0.8rem 0;
        font-size: 0.9rem;
    }

    .input-wrapper input:focus {
        outline: none;
    }

    .input-wrapper input::placeholder {
        color: #6b7280;
    }

    .send-btn {
        background: linear-gradient(135deg, #8b5cf6, #3b82f6);
        border: none;
        border-radius: 50%;
        width: 46px;
        height: 46px;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .send-btn:hover {
        transform: scale(1.05);
        box-shadow: 0 5px 15px rgba(139, 92, 246, 0.4);
    }

    .send-btn:active {
        transform: scale(0.95);
    }

    .send-btn:disabled {
        opacity: 0.5;
        cursor: not-allowed;
        transform: none;
    }

    /* Chat Info Bar */
    .chat-info {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.8rem 1.5rem;
        background: rgba(30, 30, 42, 0.6);
        border-bottom: 1px solid rgba(139, 92, 246, 0.15);
        font-size: 0.75rem;
    }

    .chat-status {
        display: flex;
        align-items: center;
        gap: 6px;
        color: #10b981;
    }

    .chat-status i {
        font-size: 0.7rem;
    }

    .chat-actions button {
        background: transparent;
        border: none;
        color: #9ca3af;
        transition: color 0.3s ease;
        cursor: pointer;
        padding: 5px;
    }

    .chat-actions button:hover {
        color: #c084fc;
    }

    /* Welcome Message */
    .welcome-message {
        text-align: center;
        padding: 2rem;
        color: #9ca3af;
    }

    .welcome-icon {
        font-size: 3rem;
        background: linear-gradient(135deg, #c084fc, #60a5fa);
        background-clip: text;
        -webkit-background-clip: text;
        color: transparent;
        margin-bottom: 1rem;
    }

    .suggestion-chips {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        justify-content: center;
        margin-top: 1rem;
    }

    .suggestion-chip {
        background: rgba(42, 42, 54, 0.8);
        border: 1px solid rgba(139, 92, 246, 0.3);
        border-radius: 40px;
        padding: 0.4rem 1rem;
        font-size: 0.75rem;
        color: #c084fc;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .suggestion-chip:hover {
        background: rgba(139, 92, 246, 0.2);
        transform: translateY(-2px);
    }

    /* Error Toast */
    .error-toast {
        position: fixed;
        bottom: 20px;
        right: 20px;
        background: rgba(239, 68, 68, 0.95);
        color: white;
        padding: 12px 20px;
        border-radius: 12px;
        font-size: 0.85rem;
        z-index: 1000;
        animation: slideInRight 0.3s ease-out;
        display: none;
    }

    @keyframes slideInRight {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    /* Animations */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Responsive */
    @media (max-width: 768px) {
        .chat-title {
            font-size: 1.8rem;
        }

        .chat-container {
            height: 380px;
            padding: 1rem;
        }

        .message-bubble {
            max-width: 85%;
            padding: 0.7rem 1rem;
            font-size: 0.85rem;
        }

        .message-avatar {
            width: 28px;
            height: 28px;
        }

        .input-wrapper {
            padding: 0.2rem 0.2rem 0.2rem 1rem;
        }

        .send-btn {
            width: 42px;
            height: 42px;
        }
    }
</style>
@endpush

@section('content')
<div class="row">
    <div class="col-lg-8 col-md-10 mx-auto">
        
        <div class="chat-header">
            <div class="chat-badge">
                <i class="fas fa-robot me-1"></i> Powered by Ollama AI
            </div>
            <h1 class="chat-title">DeepChat AI Assistant</h1>
            <p class="chat-subtitle">Your intelligent companion for any conversation</p>
        </div>

        <div class="chat-wrapper">
            <div class="chat-info">
                <div class="chat-status">
                    <i class="fas fa-circle"></i>
                    <span>AI is online and ready</span>
                </div>
                <div class="chat-actions">
                    <button id="clearChat" title="Clear conversation">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </div>
            </div>

            <div class="chat-container" id="chatContainer">
                @if(session('user_id') && isset($chatHistory) && count($chatHistory) > 0)
                    @foreach($chatHistory as $chat)
                        <div class="message user-message">
                            <div class="message-content">
                                <div class="message-avatar">
                                    <i class="fas fa-user"></i>
                                </div>
                                <div class="message-bubble">{{ $chat->user_message }}</div>
                            </div>
                        </div>
                        <div class="message ai-message">
                            <div class="message-content">
                                <div class="message-avatar">
                                    <i class="fas fa-robot"></i>
                                </div>
                                <div class="message-bubble">{{ $chat->ai_response }}</div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="welcome-message">
                        <div class="welcome-icon">
                            <i class="fas fa-comment-dots"></i>
                        </div>
                        <p>👋 Hello! I'm DeepChat AI. How can I help you today?</p>
                        <div class="suggestion-chips">
                            <span class="suggestion-chip" data-message="What is artificial intelligence?">🤖 What is AI?</span>
                            <span class="suggestion-chip" data-message="Tell me a fun fact">✨ Fun fact</span>
                            <span class="suggestion-chip" data-message="How does machine learning work?">📚 Machine learning</span>
                            <span class="suggestion-chip" data-message="Write a short poem about technology">📝 Write a poem</span>
                        </div>
                    </div>
                @endif
            </div>

            <div class="chat-input-area">
                <div class="input-wrapper">
                    <input type="text" id="messageInput" placeholder="Ask me anything..." autocomplete="off">
                    <button class="send-btn" id="sendBtn">
                        <i class="fas fa-paper-plane"></i>
                    </button>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- Error Toast -->
<div class="error-toast" id="errorToast">
    <i class="fas fa-exclamation-circle me-2"></i>
    <span id="errorMessage"></span>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    const chatContainer = $('#chatContainer');
    const messageInput = $('#messageInput');
    const sendBtn = $('#sendBtn');
    let isTyping = false;

    function scrollToBottom() {
        chatContainer.scrollTop(chatContainer[0].scrollHeight);
    }
    
    scrollToBottom();

    function showError(message) {
        $('#errorMessage').text(message);
        $('#errorToast').fadeIn(300);
        setTimeout(() => {
            $('#errorToast').fadeOut(300);
        }, 5000);
    }

    function addTypingIndicator() {
        if (isTyping) return;
        isTyping = true;
        
        const typingDiv = $('<div>').addClass('message ai-message').attr('id', 'typingIndicator');
        const contentDiv = $('<div>').addClass('message-content');
        const avatar = $('<div>').addClass('message-avatar').html('<i class="fas fa-robot"></i>');
        const typingBubble = $('<div>').addClass('typing-indicator').html('<span></span><span></span><span></span>');
        
        contentDiv.append(avatar);
        contentDiv.append(typingBubble);
        typingDiv.append(contentDiv);
        chatContainer.append(typingDiv);
        scrollToBottom();
    }

    function removeTypingIndicator() {
        $('#typingIndicator').remove();
        isTyping = false;
    }

    function addMessage(text, isUser, isError = false) {
        const messageDiv = $('<div>').addClass('message').addClass(isUser ? 'user-message' : 'ai-message');
        const contentDiv = $('<div>').addClass('message-content');
        
        if (isUser) {
            const avatar = $('<div>').addClass('message-avatar').html('<i class="fas fa-user"></i>');
            const bubble = $('<div>').addClass('message-bubble').text(text);
            contentDiv.append(avatar);
            contentDiv.append(bubble);
        } else {
            const avatar = $('<div>').addClass('message-avatar').html('<i class="fas fa-robot"></i>');
            const bubble = $('<div>').addClass('message-bubble').text(text);
            if (isError) {
                bubble.css('background', 'rgba(239, 68, 68, 0.2)');
                bubble.css('border-left', '3px solid #ef4444');
            }
            contentDiv.append(avatar);
            contentDiv.append(bubble);
        }
        
        messageDiv.append(contentDiv);
        chatContainer.append(messageDiv);
        scrollToBottom();
    }

    function sendMessage() {
        const message = messageInput.val().trim();
        if (!message || isTyping) return;

        // Remove welcome message if present
        if ($('.welcome-message').length) {
            $('.welcome-message').remove();
        }

        addMessage(message, true);
        messageInput.val('');
        
        addTypingIndicator();

        $.ajax({
            url: '{{ route("chatbot.send") }}',
            method: 'POST',
            data: {
                message: message,
                _token: '{{ csrf_token() }}'
            },
            timeout: 60000,
            success: function(response) {
                removeTypingIndicator();
                if (response.response) {
                    addMessage(response.response, false);
                } else if (response.error) {
                    addMessage('Sorry, I encountered an error: ' + response.error, false, true);
                }
            },
            error: function(xhr) {
                removeTypingIndicator();
                let errorMsg = 'Network error occurred. Please check your connection.';
                if (xhr.responseJSON && xhr.responseJSON.error) {
                    errorMsg = xhr.responseJSON.error;
                }
                addMessage(errorMsg, false, true);
                showError(errorMsg);
            }
        });
    }

    // Event listeners
    sendBtn.click(sendMessage);
    
    messageInput.keypress(function(e) {
        if (e.which == 13 && !e.shiftKey) {
            e.preventDefault();
            sendMessage();
        }
    });

    // Suggestion chips
    $(document).on('click', '.suggestion-chip', function() {
        const message = $(this).data('message');
        messageInput.val(message);
        sendMessage();
    });

    // Clear chat functionality
    $('#clearChat').click(function() {
        if (confirm('Are you sure you want to clear the conversation?')) {
            $.ajax({
                url: '{{ route("chatbot.clear") }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        chatContainer.html(`
                            <div class="welcome-message">
                                <div class="welcome-icon">
                                    <i class="fas fa-comment-dots"></i>
                                </div>
                                <p>👋 Conversation cleared! How can I help you today?</p>
                                <div class="suggestion-chips">
                                    <span class="suggestion-chip" data-message="What is artificial intelligence?">🤖 What is AI?</span>
                                    <span class="suggestion-chip" data-message="Tell me a fun fact">✨ Fun fact</span>
                                    <span class="suggestion-chip" data-message="How does machine learning work?">📚 Machine learning</span>
                                    <span class="suggestion-chip" data-message="Write a short poem about technology">📝 Write a poem</span>
                                </div>
                            </div>
                        `);
                        showError('Conversation cleared successfully!');
                    } else {
                        showError('Failed to clear conversation: ' + (response.error || 'Unknown error'));
                    }
                },
                error: function(xhr) {
                    showError('Error clearing conversation. Please try again.');
                }
            });
        }
    });

    // Auto-focus input
    messageInput.focus();
});
</script>
@endpush