<?php

namespace App\Http\Controllers;

use App\Models\Book; // <--- IMPORTANT: Add this line
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // <--- IMPORTANT: Add this line

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::all();
        return view('books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('books.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'year' => 'required|integer|min:1000|max:' . date('Y'),
            'details' => 'nullable|string',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Max 2MB
        ]);
   
        $bookData = $request->except('picture');

        if ($request->hasFile('picture')) {
            $path = $request->file('picture')->store('public/book_pictures');
            $bookData['picture'] = str_replace('public/', '', $path);
        }

        Book::create($bookData);

        return redirect()->route('books.index')->with('success', 'Book added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book) // <--- Note the Book model type-hint
    {
        return view('books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book) // <--- Note the Book model type-hint
    {
        return view('books.edit', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book) // <--- Note the Book model type-hint
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'year' => 'required|integer|min:1000|max:' . date('Y'),
            'details' => 'nullable|string',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $bookData = $request->except('picture');

        if ($request->hasFile('picture')) {
            // Delete old picture if exists
            if ($book->picture) {
                Storage::disk('public')->delete($book->picture);
            }
            $path = $request->file('picture')->store('public/book_pictures');
            $bookData['picture'] = str_replace('public/', '', $path);
        }

        $book->update($bookData);

        return redirect()->route('books.index')->with('success', 'Book updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book) // <--- Note the Book model type-hint
    {
        if ($book->picture) {
            Storage::disk('public')->delete($book->picture);
        }
        $book->delete();

        return redirect()->route('books.index')->with('success', 'Book deleted successfully!');
    }
}