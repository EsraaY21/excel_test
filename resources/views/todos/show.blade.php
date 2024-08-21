@extends('layouts.app')

@section('content')
    <h1>Todo Details</h1>

    <div class="mb-3">
        <label class="form-label"><strong>Name:</strong></label>
        <p>{{ $todo->name }}</p>
    </div>
    <div class="mb-3">
        <label class="form-label"><strong>Content:</strong></label>
        <p>{{ $todo->content }}</p>
    </div>

    <a href="{{ route('todos.index') }}" class="btn btn-secondary">Back</a>
@endsection
