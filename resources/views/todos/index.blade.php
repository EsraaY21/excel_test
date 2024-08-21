@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Todos</h1>
        <a href="{{ route('todos.create') }}" class="btn btn-primary">Create Todo</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($todos->isEmpty())
        <p>No todos available.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Content</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($todos as $todo)
                    <tr>
                        <td>{{ $todo->name }}</td>
                        <td>{{ $todo->content }}</td>
                        <td class="d-flex">
                            <a href="{{ route('todos.show', $todo) }}" class="btn btn-info btn-sm me-2">View</a>
                            <a href="{{ route('todos.edit', $todo) }}" class="btn btn-warning btn-sm me-2">Edit</a>
                            <form action="{{ route('todos.destroy', $todo) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
