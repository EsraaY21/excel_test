@extends('layouts.app')

@section('content')
    <h1>Import Todos</h1>

    <form action="{{ route('todos.importStore') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="file" class="form-label">Select File</label>
            <input type="file" name="file" id="file" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Import</button>
        <a href="{{ route('todos.index') }}" class="btn btn-secondary">Back</a>
    </form>
@endsection
