
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Catalogue</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f4f7f6;
        }
        .container {
            max-width: 900px;
        }
        .btn {
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            font-weight: 600;
            transition: background-color 0.2s;
        }
        .btn-primary {
            background-color:  #3b82f6 ;
            color: white;
        }
        .btn-primary:hover {
            background-color:   #2563eb;
        }
        .btn-success {
            background-color: #22c55e; 
            color: white;
        }
        .btn-success:hover {
            background-color: #16a34a;
        }
        .btn-danger {
            background-color: #ef4444;
            color: white;
        }
        .btn-danger:hover {
            background-color: #dc2626;
        }
        .btn-warning {
            background-color: #f59e0b;
            color: white;
        }
        .btn-warning:hover {
            background-color: #d97706;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #e2e8f0;
        }
        th {
            background-color: #f1f5f9;
            color: #475569;
            font-weight: 700;
        }
        tr:hover {
            background-color: #f8fafc;
        }
        .card {
            background-color: white;
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            padding: 2rem;
        }
        .pagination nav {
            display: flex;
            justify-content: center;
            margin-top: 2rem;
        }
        .pagination a, .pagination span {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 2.5rem;
            height: 2.5rem;
            padding: 0 0.5rem;
            margin: 0 0.25rem;
            border-radius: 0.375rem;
            border: 1px solid #cbd5e0;
            color: #475569;
            text-decoration: none;
            transition: background-color 0.2s, border-color 0.2s, color 0.2s;
        }
        .pagination a:hover {
            background-color: #e2e8f0;
            border-color: #a0aec0;
        }
        .pagination span.current {
            background-color: #3b82f6;
            color: white;
            border-color: #3b82f6;
        }
        .pagination span.dots {
            background-color: transparent;
            border-color: transparent;
        }
        .flash-message {
            padding: 1rem;
            margin-bottom: 1rem;
            border-radius: 0.375rem;
            font-weight: 500;
        }
        .flash-message.success {
            background-color: #d1fae5; /* green-100 */
            color: #065f46; /* green-800 */
        }
        .flash-message.error {
            background-color: #fee2e2; /* red-100 */
            color: #991b1b; /* red-800 */
        }
    </style>
</head>
<body class="bg-gray-100 antialiased leading-normal tracking-wide">
    <div class="container mx-auto p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Book Catalogue</h1>
            <a href="{{ route('books.create') }}" class="btn btn-primary shadow-lg hover:shadow-xl transform hover:scale-105">Add New Book</a>
        </div>

        @if ($message = Session::get('success'))
            <div class="flash-message success">
                <p>{{ $message }}</p>
            </div>
        @endif

        {{-- Search Form --}}
        <div class="mb-6">
            <form action="{{ route('books.index') }}" method="GET" class="flex items-center space-x-2">
                     <input type="text" name="search"   placeholder="Search for books🔎..."
                       class="flex-grow p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                       value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary">Search</button>
                @if(request('search'))
                    <a href="{{ route('books.index') }}" class="btn btn-secondary">Clear</a>
                @endif
            </form>
        </div>
<!--Table  goes here-->
 <div class="card overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr>
                        <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                        <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                        <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Author</th>
                        <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Year</th>
                       <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider"></th>
                    <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center"> Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($books as $book)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $book->title }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $book->author }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $book->year }}</td>
                            <td class="px-6 py-4 text-gray-600 truncate max-w-xs" title="{{ $book->details}}">
                                {{ \Illuminate\Support\Str::limit($book->description, 50, '...') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <form action="{{ route('books.destroy', $book->id) }}" method="POST" class="inline-flex space-x-2">
                                    <a href="{{ route('books.show', $book->id) }}" class="btn btn-primary bg-green px-3 py-1 text-sm shadow-md hover:shadow-lg">View</a>
                                    <a href="{{ route('books.edit', $book->id) }}" class="btn btn-warning px-3 py-1 text-sm shadow-md hover:shadow-lg">Edit</a>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger px-3 py-1 text-sm shadow-md hover:shadow-lg" onclick="return confirm('Are you sure you want to delete this book?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 whitespace-nowrap text-center text-gray-500">No books found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="pagination">
        {!! $books->appends(request()->query())->links() !!} 
        </div>
    




    </div>
</body>
</html>