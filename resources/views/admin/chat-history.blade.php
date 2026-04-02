@extends('layouts.app')

@section('title', 'Chat History')

@section('content')
<h1>Chat History</h1>
<table class="table table-bordered">
    <thead>
        <tr><th>User</th><th>User Message</th><th>AI Response</th><th>Time</th></tr>
    </thead>
    <tbody>
        @foreach($chatHistory as $chat)
        <tr>
            <td>{{ $chat->user->name ?? 'Guest' }}</td>
            <td>{{ $chat->user_message }}</td>
            <td>{{ $chat->ai_response }}</td>
            <td>{{ $chat->created_at }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
{{ $chatHistory->links() }}
@endsection