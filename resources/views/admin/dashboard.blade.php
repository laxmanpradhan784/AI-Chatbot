@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<h1>Admin Dashboard</h1>
<div class="row mt-4">
    <div class="col-md-4">
        <div class="card text-white bg-primary mb-3">
            <div class="card-body">
                <h5 class="card-title">Total Users</h5>
                <p class="card-text display-4">{{ $totalUsers }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-white bg-success mb-3">
            <div class="card-body">
                <h5 class="card-title">Total Chats</h5>
                <p class="card-text display-4">{{ $totalChats }}</p>
            </div>
        </div>
    </div>
</div>

<h3 class="mt-4">Recent Chats</h3>
<table class="table table-bordered">
    <thead>
        <tr><th>User</th><th>Message</th><th>AI Response</th><th>Time</th></tr>
    </thead>
    <tbody>
        @foreach($recentChats as $chat)
        <tr>
            <td>{{ $chat->user->name ?? 'Guest' }}</td>
            <td>{{ Str::limit($chat->user_message, 50) }}</td>
            <td>{{ Str::limit($chat->ai_response, 50) }}</td>
            <td>{{ $chat->created_at }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection