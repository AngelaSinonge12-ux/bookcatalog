<?php 

namespace App\Http\Controllers;

use App\Models\Book; 
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource (all books).
     */
    public function index(Request $request)
    {
        $query = Book::latest();
        $search = ''; 

        // search functionality
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search; 
            $query->where('title', 'like', '%' . $search . '%')
                  ->orWhere('author', 'like', '%' . $search . '%')
                  ->orWhere('details', 'like', '%' . $search . '%'); 
        }

        $books = $query->paginate(10); 

        
        return view('books.index', compact('books', 'search'));
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
            'description' => 'nullable|string',
        ]);

        
        Book::create($request->all());

        
        return redirect()->route('books.index')
                         ->with('success', 'Book created successfully.');
    }

    /**
     * Display the specified resource (single book).
     */
    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        return view('books.edit', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        // Validate the incoming request data
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'year' => 'required|integer|min:1000|max:' . date('Y'),
            'details' => 'nullable|string',
        ]);

        
        $book->update($request->all());

        
        return redirect()->route('books.index')
                         ->with('success', 'Book updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        
        $book->delete();

        
        return redirect()->route('books.index')
                         ->with('success', 'Book deleted successfully.');
    }
}
