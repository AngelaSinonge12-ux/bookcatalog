@extends('layouts.app')

@section('content')
    <h1>Edit Book</h1>

    <form action="{{ route('books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
       <!--Cross site request forgery,for security purpose (csrf)-->
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $book->title) }}" required>
        </div>
        <div class="mb-3">
            <label for="author" class="form-label">Author</label>
            <input type="text" class="form-control" id="author" name="author" value="{{ old('author', $book->author) }}" required>
        </div>
        <div class="mb-3">
            <label for="year" class="form-label">Year</label>
            <input type="number" class="form-control" id="year" name="year" value="{{ old('year', $book->year) }}" required>
        </div>
        <div class="mb-3">
            <label for="details" class="form-label">Details</label>
            <textarea class="form-control" id="details" name="details" rows="3">{{ old('details', $book->details) }}</textarea>
        </div>
        <div class="mb-3">
            <label for="picture" class="form-label">Book Picture</label>
            <input type="file" class="form-control" id="picture" name="picture" accept="image/*">
            @if ($book->picture)
                <img src="{{ asset('storage/' . $book->picture) }}" alt="{{ $book->title }}" class="img-thumbnail mt-2" width="150">
                <p class="mt-1">Current picture</p>
            @endif
        </div>
        <button type="submit" class="btn btn-success">Update Book</button>
        <a href="{{ route('books.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection