<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    // This line redirects the root URL to the 'books.index' named route
    return redirect()->route('books.index');
});

// This line registers all the resourceful routes for your BookController,
// including 'books.index', 'books.create', 'books.show', 'books.edit', 'books.update', 'books.destroy'.
Route::resource('books', BookController::class);