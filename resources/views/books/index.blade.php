@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Book Catalog</h1>
        <a href="{{ route('books.create') }}" class="btn btn-primary">Add New Book</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">
        @forelse ($books as $book)
            <div class="col-md-4">
                <div class="card">
                    @if ($book->picture)
                        <img src="{{ asset('storage/' . $book->picture) }}" class="card-img-top" alt="{{ $book->title }}" style="height: 200px; object-fit: cover;">
                    @else
                        <img src="{{ asset('images/placeholder.png') }}" class="card-img-top" alt="No Image" style="height: 200px; object-fit: cover;">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $book->title }}</h5>
                        <p class="card-text book-details"><strong>Author:</strong> {{ $book->author }}</p>
                        <p class="card-text book-details"><strong>Year:</strong> {{ $book->year }}</p>
                        <p class="card-text">{{ Str::limit($book->details, 100) }}</p>
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('books.show', $book->id) }}" class="btn btn-info btn-sm btn-action">View</a>
                            <a href="{{ route('books.edit', $book->id) }}" class="btn btn-warning btn-sm btn-action">Edit</a>
                            <form action="{{ route('books.destroy', $book->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this book?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm btn-action">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <p>No books found. Please add some!</p>
            </div>
        @endforelse
    </div>
@endsection