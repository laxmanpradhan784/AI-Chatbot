@extends('layouts.app')

@section('title', 'Manage Users')

@section('content')
<h1>Manage Users</h1>
<table class="table table-bordered">
    <thead>
        <tr><th>ID</th><th>Name</th><th>Email</th><th>Registered Date</th><th>Action</th></tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->created_at }}</td>
            <td>
                <form action="{{ route('admin.delete-user', $user->id) }}" method="POST" onsubmit="return confirm('Delete this user?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection