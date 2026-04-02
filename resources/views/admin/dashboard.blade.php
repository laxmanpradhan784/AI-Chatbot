@extends('layouts.app')

@section('title', 'Admin Dashboard')

@push('styles')
    <style>
        .admin-header {
            margin-bottom: 2rem;
            animation: fadeInDown 0.6s ease-out;
        }

        .admin-title {
            font-size: 2rem;
            font-weight: 700;
            background: linear-gradient(135deg, #ffffff, #c084fc, #60a5fa);
            background-clip: text;
            -webkit-background-clip: text;
            color: transparent;
            margin-bottom: 0.5rem;
        }

        .admin-subtitle {
            color: #9ca3af;
            font-size: 0.9rem;
        }

        /* Stats Cards */
        .stats-row {
            margin-bottom: 2rem;
        }

        .stat-card {
            background: linear-gradient(135deg, #1e1e2a, #18181f);
            border: 1px solid rgba(139, 92, 246, 0.2);
            border-radius: 24px;
            padding: 1.5rem;
            transition: all 0.3s ease;
            animation: fadeInUp 0.6s ease-out;
            animation-fill-mode: both;
        }

        .stat-card:nth-child(1) {
            animation-delay: 0.1s;
        }

        .stat-card:nth-child(2) {
            animation-delay: 0.2s;
        }

        .stat-card:nth-child(3) {
            animation-delay: 0.3s;
        }

        .stat-card:nth-child(4) {
            animation-delay: 0.4s;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            border-color: rgba(139, 92, 246, 0.4);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, rgba(139, 92, 246, 0.2), rgba(59, 130, 246, 0.1));
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
        }

        .stat-icon i {
            font-size: 1.5rem;
            background: linear-gradient(135deg, #c084fc, #60a5fa);
            background-clip: text;
            -webkit-background-clip: text;
            color: transparent;
        }

        .stat-title {
            color: #9ca3af;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 0.5rem;
        }

        .stat-value {
            font-size: 2.5rem;
            font-weight: 800;
            color: #ffffff;
            margin-bottom: 0.25rem;
        }

        .stat-trend {
            font-size: 0.75rem;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .stat-trend.up {
            color: #10b981;
        }

        .stat-trend.down {
            color: #ef4444;
        }

        /* Section Headers */
        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 2rem 0 1.5rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .section-title {
            font-size: 1.3rem;
            font-weight: 600;
            color: #ffffff;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .section-title i {
            color: #8b5cf6;
        }

        .refresh-btn {
            background: rgba(139, 92, 246, 0.1);
            border: 1px solid rgba(139, 92, 246, 0.3);
            border-radius: 40px;
            padding: 0.5rem 1rem;
            color: #c084fc;
            transition: all 0.3s ease;
        }

        .refresh-btn:hover {
            background: rgba(139, 92, 246, 0.2);
            transform: translateY(-2px);
        }

        /* Tables */
        .table-wrapper {
            background: linear-gradient(135deg, #1e1e2a, #18181f);
            border: 1px solid rgba(139, 92, 246, 0.2);
            border-radius: 24px;
            overflow: hidden;
            animation: fadeInUp 0.6s ease-out 0.5s;
            animation-fill-mode: both;
        }

        .table {
            margin-bottom: 0;
            color: #e5e5e5;
        }

        .table thead th {
            background: rgba(20, 20, 26, 0.8);
            color: #c084fc;
            border-bottom: 1px solid rgba(139, 92, 246, 0.2);
            padding: 1rem;
            font-weight: 600;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .table tbody td {
            padding: 1rem;
            border-bottom: 1px solid rgba(139, 92, 246, 0.1);
            vertical-align: middle;
        }

        .table tbody tr:hover {
            background: rgba(139, 92, 246, 0.05);
        }

        /* User Info */
        .user-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .user-avatar-small {
            width: 32px;
            height: 32px;
            background: linear-gradient(135deg, #8b5cf6, #3b82f6);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .user-avatar-small i {
            font-size: 0.9rem;
            color: white;
        }

        .user-name {
            font-weight: 500;
            color: #ffffff;
        }

        .user-role {
            font-size: 0.7rem;
            color: #c084fc;
        }

        /* Message Preview */
        .message-preview {
            max-width: 250px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            color: #9ca3af;
            font-size: 0.85rem;
        }

        /* Badge */
        .badge-custom {
            background: rgba(16, 185, 129, 0.2);
            color: #10b981;
            padding: 0.25rem 0.75rem;
            border-radius: 40px;
            font-size: 0.7rem;
            font-weight: 500;
        }

        /* Action Buttons */
        .action-btns {
            display: flex;
            gap: 8px;
        }

        .action-btn {
            background: transparent;
            border: none;
            color: #9ca3af;
            transition: all 0.3s ease;
            cursor: pointer;
            padding: 5px;
        }

        .action-btn.view:hover {
            color: #60a5fa;
        }

        .action-btn.delete:hover {
            color: #ef4444;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 3rem;
            color: #9ca3af;
        }

        .empty-state i {
            font-size: 3rem;
            margin-bottom: 1rem;
            opacity: 0.5;
        }

        /* Modal Styles */
        .modal-content {
            background: linear-gradient(135deg, #1e1e2a, #18181f);
            border: 1px solid rgba(139, 92, 246, 0.3);
            border-radius: 24px;
        }

        .modal-header {
            border-bottom: 1px solid rgba(139, 92, 246, 0.2);
        }

        .modal-footer {
            border-top: 1px solid rgba(139, 92, 246, 0.2);
        }

        .modal-title {
            color: #ffffff;
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
            .stat-value {
                font-size: 1.8rem;
            }

            .table-wrapper {
                overflow-x: auto;
            }

            .table {
                min-width: 600px;
            }

            .section-header {
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>
@endpush

@section('content')
    <div class="admin-header">
        <div class="admin-badge">
            <i class="fas fa-shield-alt me-1"></i> Admin Portal
        </div>
        <h1 class="admin-title">Dashboard</h1>
        <p class="admin-subtitle">Welcome back, {{ session('user_name') }}! Here's what's happening with your platform.</p>
    </div>

    <!-- Statistics Cards -->
    <div class="stats-row">
        <div class="row g-4">
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stat-title">Total Users</div>
                    <div class="stat-value">{{ $totalUsers }}</div>
                    <div class="stat-trend up">
                        <i class="fas fa-arrow-up"></i>
                        <span>+12% this month</span>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-comments"></i>
                    </div>
                    <div class="stat-title">Total Chats</div>
                    <div class="stat-value">{{ $totalChats }}</div>
                    <div class="stat-trend up">
                        <i class="fas fa-arrow-up"></i>
                        <span>+8% this week</span>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-user-plus"></i>
                    </div>
                    <div class="stat-title">New Users (30d)</div>
                    <div class="stat-value">{{ $newUsers ?? 0 }}</div>
                    <div class="stat-trend up">
                        <i class="fas fa-arrow-up"></i>
                        <span>+5% vs last month</span>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-calendar-week"></i>
                    </div>
                    <div class="stat-title">Chats Today</div>
                    <div class="stat-value">{{ $chatsToday ?? 0 }}</div>
                    <div class="stat-trend down">
                        <i class="fas fa-arrow-down"></i>
                        <span>-3% vs yesterday</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Chats Section -->
    <div class="section-header">
        <div class="section-title">
            <i class="fas fa-history"></i>
            <span>Recent Conversations</span>
        </div>
        <button class="refresh-btn" onclick="location.reload()">
            <i class="fas fa-sync-alt me-2"></i>Refresh
        </button>
    </div>

    <div class="table-wrapper">
        <table class="table">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Message</th>
                    <th>AI Response</th>
                    <th>Time</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentChats as $chat)
                    <tr>
                        <td>
                            <div class="user-info">
                                <div class="user-avatar-small">
                                    <i class="fas fa-user"></i>
                                </div>
                                <div>
                                    <div class="user-name">{{ $chat->user->name ?? 'Guest User' }}</div>
                                    <div class="user-role">{{ $chat->user->email ?? 'No email' }}</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="message-preview" title="{{ $chat->user_message }}">
                                {{ Str::limit($chat->user_message, 60) }}
                            </div>
                        </td>
                        <td>
                            <div class="message-preview" title="{{ $chat->ai_response }}">
                                {{ Str::limit($chat->ai_response, 60) }}
                            </div>
                        </td>
                        <td>
                            <span class="badge-custom">
                                <i class="far fa-clock me-1"></i>
                                {{ \Carbon\Carbon::parse($chat->created_at)->diffForHumans() }}
                            </span>
                            <div class="small text-muted mt-1">
                                {{ \Carbon\Carbon::parse($chat->created_at)->format('M d, H:i') }}</div>
                        </td>
                        <td>
                            <div class="action-btns">
                                <button class="action-btn view" onclick="viewChat({{ $chat->id }})"
                                    title="View Details">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="action-btn delete" onclick="deleteChat({{ $chat->id }})" title="Delete">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">
                            <div class="empty-state">
                                <i class="fas fa-comments"></i>
                                <p>No conversations yet</p>
                                <small>When users start chatting, their conversations will appear here</small>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if (isset($recentChats) && method_exists($recentChats, 'links'))
        <div class="d-flex justify-content-center mt-4">
            {{ $recentChats->links() }}
        </div>
    @endif

    <!-- View Chat Modal -->
    <div class="modal fade" id="viewChatModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-comment-dots me-2"></i>Conversation Details
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="chatDetails">
                    <!-- Chat details will be loaded here -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function viewChat(chatId) {
            // You can implement an AJAX call to fetch chat details
            // For now, just show a placeholder
            $('#chatDetails').html(`
        <div class="text-center p-4">
            <i class="fas fa-spinner fa-spin fa-2x" style="color: #8b5cf6;"></i>
            <p class="mt-2">Loading conversation details...</p>
        </div>
    `);
            $('#viewChatModal').modal('show');

            // Example AJAX call (uncomment when route is ready)
            /*
            $.ajax({
                url: '/admin/chat/' + chatId,
                method: 'GET',
                success: function(response) {
                    $('#chatDetails').html(`
                    <div class="message user-message mb-3">
                        <div class="message-bubble">${response.user_message}</div>
                    </div>
                    <div class="message ai-message">
                        <div class="message-bubble">${response.ai_response}</div>
                    </div>
                `);
                },
                error: function() {
                    $('#chatDetails').html('<div class="alert alert-danger">Error loading conversation</div>');
                }
            });
            */
        }

        function deleteChat(chatId) {
            if (confirm('Are you sure you want to delete this conversation?')) {
                // Implement delete functionality
                alert('Delete functionality will be implemented soon.');
            }
        }

        // Auto-refresh stats every 30 seconds (optional)
        setInterval(function() {
            location.reload();
        }, 30000);
    </script>
@endpush
