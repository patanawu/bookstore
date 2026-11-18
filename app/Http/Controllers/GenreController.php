<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    // Menampilkan semua genre
    public function index()
    {
        return response()->json([
            'success' => true,
            'data' => Genre::with('books')->get(),
        ]);
    }

    // Menambahkan genre
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $genre = Genre::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Genre berhasil ditambahkan.',
            'data' => $genre,
        ], 201);
    }

    // Menampilkan detail genre
    public function show(string $id)
    {
        $genre = Genre::with('books')->find($id);

        if (!$genre) {
            return response()->json([
                'success' => false,
                'message' => 'Genre tidak ditemukan.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $genre,
        ]);
    }

    // Mengubah genre
    public function update(Request $request, string $id)
    {
        $genre = Genre::find($id);

        if (!$genre) {
            return response()->json([
                'success' => false,
                'message' => 'Genre tidak ditemukan.',
            ], 404);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $genre->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Genre berhasil diperbarui.',
            'data' => $genre->fresh(),
        ]);
    }

    // Menghapus genre dengan pemeriksaan relasi buku
    public function destroy(string $id)
    {
        $genre = Genre::find($id);

        if (!$genre) {
            return response()->json([
                'success' => false,
                'message' => 'Genre tidak ditemukan.',
            ], 404);
        }

        if ($genre->books()->exists()) {
            return response()->json([
                'success' => false,
                'message' => 'Genre tidak dapat dihapus karena masih digunakan oleh buku.',
            ], 409);
        }

        $genre->delete();

        return response()->json([
            'success' => true,
            'message' => 'Genre berhasil dihapus.',
        ]);
    }
}