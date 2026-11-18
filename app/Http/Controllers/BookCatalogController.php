<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Genre;
use Illuminate\Http\Request;

class BookCatalogController extends Controller
{
    // Menampilkan katalog buku
    public function index(Request $request)
    {
        $query = Book::with(['author', 'genre']);

        // Pencarian berdasarkan judul buku
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // Filter berdasarkan genre
        if ($request->filled('genre_id')) {
            $query->where('genre_id', $request->genre_id);
        }

        $books = $query->latest()->paginate(12)->withQueryString();

        $genres = Genre::orderBy('name')->get();

        return view('catalog.index', compact('books', 'genres'));
    }

    // Menampilkan detail buku
    public function show(Book $book)
    {
        $book->load(['author', 'genre']);

        return view('catalog.show', compact('book'));
    }
}