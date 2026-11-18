<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Author;
use App\Models\Book;
use App\Models\User;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Throwable;

class AdminController extends Controller
{
    // =========================
    // GENRE
    // =========================

    public function genres()
    {
        $genres = Genre::latest()->get();

        return view('admin.genres.index', compact('genres'));
    }

    public function storeGenre(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:genres,name',
        ]);

        Genre::create($data);

        return back()->with('success', 'Genre berhasil ditambahkan!');
    }

    public function updateGenre(Request $request, Genre $genre)
    {
        $data = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('genres', 'name')->ignore($genre->id),
            ],
        ]);

        $genre->update($data);

        return back()->with('success', 'Genre berhasil diperbarui!');
    }

    public function destroyGenre(Genre $genre)
    {
        if ($genre->books()->exists()) {
            return back()->withErrors([
                'genre' => 'Genre masih digunakan oleh buku.',
            ]);
        }

        $genre->delete();

        return back()->with('success', 'Genre berhasil dihapus!');
    }

    // =========================
    // AUTHOR
    // =========================

    public function authors()
    {
        $authors = Author::withCount('books')->latest()->get();

        return view('admin.authors.index', compact('authors'));
    }

    public function storeAuthor(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:authors,email',
            'bio' => 'nullable|string',
        ]);

        Author::create($data);

        return back()->with('success', 'Author berhasil ditambahkan!');
    }

    public function updateAuthor(Request $request, Author $author)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('authors', 'email')->ignore($author->id),
            ],
            'bio' => 'nullable|string',
        ]);

        $author->update($data);

        return back()->with('success', 'Author berhasil diperbarui!');
    }

    public function destroyAuthor(Author $author)
    {
        if ($author->books()->exists()) {
            return back()->withErrors([
                'author' => 'Author masih memiliki buku.',
            ]);
        }

        $author->delete();

        return back()->with('success', 'Author berhasil dihapus!');
    }

    // =========================
    // BOOK
    // =========================

    public function books()
    {
        $books = Book::with(['genre', 'author'])
            ->withCount('transactions')
            ->latest()
            ->get();

        $genres = Genre::orderBy('name')->get();
        $authors = Author::orderBy('name')->get();

        return view('admin.books.index', compact(
            'books',
            'genres',
            'authors'
        ));
    }

    public function storeBook(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'cover_url' => 'nullable|url|max:255',
            'cover_file' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'genre_id' => 'nullable|exists:genres,id',
            'author_id' => 'required|exists:authors,id',
        ]);

        unset($data['cover_url'], $data['cover_file']);

        $newCover = null;

        if ($request->hasFile('cover_file')) {
            $newCover = $request->file('cover_file')->store('books', 'public');

            if (!$newCover) {
                return back()
                    ->withInput()
                    ->withErrors(['cover_file' => 'Gagal menyimpan gambar cover.']);
            }
        }

        $data['cover_photo'] = $newCover
            ?: ($request->input('cover_url') ?: null);

        try {
            Book::create($data);
        } catch (Throwable $exception) {
            if ($newCover) {
                Storage::disk('public')->delete($newCover);
            }

            throw $exception;
        }

        return back()->with('success', 'Buku berhasil ditambahkan!');
    }

    public function updateBook(Request $request, Book $book)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'cover_url' => 'nullable|url|max:255',
            'cover_file' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'genre_id' => 'nullable|exists:genres,id',
            'author_id' => 'required|exists:authors,id',
        ]);

        unset($data['cover_url'], $data['cover_file']);

        $oldCover = $book->cover_photo;
        $newCover = null;
        $coverChanged = false;

        if ($request->hasFile('cover_file')) {
            $newCover = $request->file('cover_file')->store('books', 'public');

            if (!$newCover) {
                return back()
                    ->withInput()
                    ->withErrors(['cover_file' => 'Gagal menyimpan gambar cover.']);
            }

            $data['cover_photo'] = $newCover;
            $coverChanged = true;
        } elseif ($request->filled('cover_url')) {
            $data['cover_photo'] = $request->input('cover_url');
            $coverChanged = true;
        }

        try {
            $book->update($data);
        } catch (Throwable $exception) {
            if ($newCover) {
                Storage::disk('public')->delete($newCover);
            }

            throw $exception;
        }

        if ($coverChanged && $this->isLocalCover($oldCover)) {
            Storage::disk('public')->delete($oldCover);
        }

        return back()->with('success', 'Buku berhasil diperbarui!');
    }

    public function destroyBook(Book $book)
    {
        if ($book->transactions()->exists()) {
            return back()->withErrors([
                'book' => 'Buku sudah memiliki transaksi dan tidak dapat dihapus.',
            ]);
        }

        $oldCover = $book->cover_photo;

        $book->delete();

        if ($this->isLocalCover($oldCover)) {
            Storage::disk('public')->delete($oldCover);
        }

        return back()->with('success', 'Buku berhasil dihapus!');
    }

    private function isLocalCover(?string $cover): bool
    {
        if (!$cover) {
            return false;
        }

        if (str_starts_with($cover, 'http://') || str_starts_with($cover, 'https://')) {
            return false;
        }

        return Storage::disk('public')->exists($cover);
    }

    // =========================
    // USERS
    // =========================

    public function users()
    {
        $users = User::where('role', 'user')
            ->latest()
            ->get();

        return view('admin.users.index', compact('users'));
    }

    // =========================
    // ORDERS
    // =========================

    public function orders()
    {
        $orders = Transaction::with(['customer', 'book'])
            ->orderByDesc('created_at')
            ->get()
            ->groupBy('order_number');

        return view('admin.orders.index', compact('orders'));
    }

    // =========================
    // CANCEL ORDER
    // =========================

    public function updatePaymentStatus(Request $request, string $orderNumber)
    {
        $validated = $request->validate([
            'payment_status' => ['required', 'in:paid,unpaid'],
        ]);

        $result = DB::transaction(function () use ($orderNumber, $validated) {
            $items = Transaction::where('order_number', $orderNumber)
                ->lockForUpdate()
                ->get();

            if ($items->isEmpty()) {
                abort(404);
            }

            $first = $items->first();

            if ($first->status === 'cancelled') {
                return 'cancelled';
            }

Transaction::where('order_number', $orderNumber)
                ->update(['payment_status' => $validated['payment_status']]);

            return 'updated';
        }, 3);

        if ($result === 'cancelled') {
            return back()->with('error', 'Pesanan yang dibatalkan tidak dapat diubah status pembayarannya.');
        }

        if ($result === 'invalid') {
            return back()->with('error', 'Fitur ini hanya berlaku untuk pembayaran transfer bank.');
        }

        return back()->with(
            'success',
            $validated['payment_status'] === 'paid'
                ? 'Pembayaran berhasil ditandai lunas.'
                : 'Status pembayaran berhasil diubah menjadi belum dibayar.'
        );
    }
    public function cancelOrder(string $orderNumber)
    {
        $cancelled = DB::transaction(function () use ($orderNumber) {
            $items = Transaction::where('order_number', $orderNumber)
                ->lockForUpdate()
                ->get();

            if ($items->isEmpty()) {
                abort(404);
            }

            if ($items->first()->status === 'cancelled') {
                return false;
            }

            foreach ($items as $item) {
                $book = Book::whereKey($item->book_id)
                    ->lockForUpdate()
                    ->first();

                if ($book) {
                    $book->increment('stock', $item->quantity);
                }
            }

            Transaction::where('order_number', $orderNumber)
                ->update(['status' => 'cancelled']);

            return true;
        }, 3);

        return back()->with(
            'success',
            $cancelled
                ? 'Pesanan berhasil dibatalkan dan stok dikembalikan.'
                : 'Pesanan ini sudah dibatalkan sebelumnya.'
        );
    }

    // =========================
    // DELETE ORDER
    // =========================

    public function destroyOrder(string $orderNumber)
    {
        DB::transaction(function () use ($orderNumber) {
            $items = Transaction::where('order_number', $orderNumber)
                ->lockForUpdate()
                ->get();

            if ($items->isEmpty()) {
                abort(404);
            }

            // Kembalikan stok hanya jika pesanan belum dibatalkan.
            if ($items->first()->status !== 'cancelled') {
                foreach ($items as $item) {
                    $book = Book::whereKey($item->book_id)
                        ->lockForUpdate()
                        ->first();

                    if ($book) {
                        $book->increment('stock', $item->quantity);
                    }
                }
            }

            // Hapus seluruh item dalam satu nomor pesanan.
            Transaction::where('order_number', $orderNumber)->delete();
        }, 3);

        return back()->with(
            'success',
            'Pesanan berhasil dihapus dari database.'
        );
    }
}