@extends('layouts.app')

@section('content')
    <h1>{{ $book->title }}</h1>

    <div class="card mb-3">
        <div class="row g-0">
            <div class="col-md-4">
                @if ($book->picture)
                    <img src="{{ asset('storage/' . $book->picture) }}" class="img-fluid rounded-start" alt="{{ $book->title }}">
                @else
                    <img src="{{ asset('images/placeholder.png') }}" class="img-fluid rounded-start" alt="No Image">
                @endif
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title">{{ $book->title }}</h5>
                    <p class="card-text"><strong>Author:</strong> {{ $book->author }}</p>
                    <p class="card-text"><strong>Year:</strong> {{ $book->year }}</p>
                    <p class="card-text"><strong>Details:</strong> {{ $book->details }}</p>
                    <p class="card-text"><small class="text-muted">Last updated: {{ $book->updated_at->diffForHumans() }}</small></p>
                    <div class="mt-3">
                        <a href="{{ route('books.edit', $book->id) }}" class="btn btn-warning btn-action">Edit</a>
                        <form action="{{ route('books.destroy', $book->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this book?');" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-action">Delete</button>
                        </form>
                        <a href="{{ route('books.index') }}" class="btn btn-secondary">Back to Catalog</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection