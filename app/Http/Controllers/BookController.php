<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use Throwable;

class BookController extends Controller
{
    // Menampilkan semua buku
    public function index(): JsonResponse
    {
        $books = Book::with(['author', 'genre'])->get();

        return response()->json([
            'success' => true,
            'data' => $books,
        ]);
    }

    // Menampilkan detail satu buku
    public function show(string $id): JsonResponse
    {
        $book = Book::with(['author', 'genre'])->find($id);

        if (!$book) {
            return response()->json([
                'success' => false,
                'message' => 'Buku tidak ditemukan.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail buku berhasil ditemukan.',
            'data' => $book,
        ]);
    }

    // Menambahkan buku
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'genre_id' => 'nullable|exists:genres,id',
            'author_id' => 'required|exists:authors,id',
            'cover_photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $coverPath = null;

        if ($request->hasFile('cover_photo')) {
            $coverPath = $request->file('cover_photo')
                ->store('books', 'public');

            if (!$coverPath) {
                return response()->json([
                    'success' => false,
                    'message' => 'Cover buku gagal disimpan.',
                ], 500);
            }

            $validated['cover_photo'] = $coverPath;
        }

        try {
            $book = Book::create($validated);
        } catch (Throwable $exception) {
            if ($coverPath) {
                Storage::disk('public')->delete($coverPath);
            }

            throw $exception;
        }

        return response()->json([
            'success' => true,
            'message' => 'Buku berhasil ditambahkan.',
            'data' => $book->load(['author', 'genre']),
        ], 201);
    }

    // Mengubah buku
    public function update(Request $request, string $id): JsonResponse
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json([
                'success' => false,
                'message' => 'Buku tidak ditemukan.',
            ], 404);
        }

        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|nullable|string',
            'price' => 'sometimes|required|numeric|min:0',
            'stock' => 'sometimes|required|integer|min:0',
            'genre_id' => 'sometimes|nullable|exists:genres,id',
            'author_id' => 'sometimes|required|exists:authors,id',
            'cover_photo' => 'sometimes|nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $oldCoverPath = $book->cover_photo;
        $newCoverPath = null;

        if ($request->hasFile('cover_photo')) {
            $newCoverPath = $request->file('cover_photo')
                ->store('books', 'public');

            if (!$newCoverPath) {
                return response()->json([
                    'success' => false,
                    'message' => 'Cover baru gagal disimpan. Cover lama tetap dipertahankan.',
                ], 500);
            }

            $validated['cover_photo'] = $newCoverPath;
        }

        try {
            $updated = $book->update($validated);

            if (!$updated) {
                if ($newCoverPath) {
                    Storage::disk('public')->delete($newCoverPath);
                }

                return response()->json([
                    'success' => false,
                    'message' => 'Data buku gagal diperbarui.',
                ], 500);
            }
        } catch (Throwable $exception) {
            if ($newCoverPath) {
                Storage::disk('public')->delete($newCoverPath);
            }

            throw $exception;
        }

        // Hapus cover lama hanya setelah perubahan database berhasil.
        if (
            $newCoverPath &&
            $oldCoverPath &&
            $oldCoverPath !== $newCoverPath
        ) {
            Storage::disk('public')->delete($oldCoverPath);
        }

        return response()->json([
            'success' => true,
            'message' => 'Buku berhasil diperbarui.',
            'data' => $book->fresh()->load(['author', 'genre']),
        ]);
    }

    // Menghapus buku
    public function destroy(string $id): JsonResponse
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json([
                'success' => false,
                'message' => 'Buku tidak ditemukan.',
            ], 404);
        }

        if ($book->transactions()->exists()) {
            return response()->json([
                'success' => false,
                'message' => 'Buku tidak dapat dihapus karena sudah memiliki transaksi.',
            ], 409);
        }

        $coverPath = $book->cover_photo;

        // Hapus data buku terlebih dahulu.
        $book->delete();

        // File cover dihapus setelah data berhasil dihapus.
        if ($coverPath) {
            Storage::disk('public')->delete($coverPath);
        }

        return response()->json([
            'success' => true,
            'message' => 'Buku berhasil dihapus.',
        ]);
    }
}