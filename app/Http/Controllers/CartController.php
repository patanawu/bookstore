<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // Menampilkan keranjang
    public function index()
    {
        $cart = session()->get('cart', []);

        $books = Book::whereIn('id', array_keys($cart))->get();

        $items = $books->map(function ($book) use ($cart) {
            $quantity = (int) $cart[$book->id]['quantity'];

            return [
                'book' => $book,
                'quantity' => $quantity,
                'subtotal' => $book->price * $quantity,
            ];
        });

        $total = $items->sum('subtotal');

        return view('cart.index', compact('items', 'total'));
    }

    // Menambahkan buku ke keranjang
    public function store(Request $request, Book $book)
    {
        $data = $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        if ($book->stock < $data['quantity']) {
            return back()->with('error', 'Stok buku tidak mencukupi.');
        }

        $cart = session()->get('cart', []);

        $currentQuantity = $cart[$book->id]['quantity'] ?? 0;
        $newQuantity = $currentQuantity + $data['quantity'];

        if ($newQuantity > $book->stock) {
            return back()->with('error', 'Jumlah melebihi stok yang tersedia.');
        }

        $cart[$book->id] = [
            'quantity' => $newQuantity,
        ];

        session()->put('cart', $cart);

        return redirect()->route('cart.index')
            ->with('success', 'Buku berhasil ditambahkan ke keranjang!');
    }

    // Mengubah jumlah buku
    public function update(Request $request, Book $book)
    {
        $data = $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = session()->get('cart', []);

        if (!isset($cart[$book->id])) {
            return back()->with('error', 'Buku tidak ditemukan di keranjang.');
        }

        if ($data['quantity'] > $book->stock) {
            return back()->with('error', 'Jumlah melebihi stok yang tersedia.');
        }

        $cart[$book->id]['quantity'] = $data['quantity'];

        session()->put('cart', $cart);

        return back()->with('success', 'Jumlah buku berhasil diperbarui.');
    }

    // Menghapus buku dari keranjang
    public function destroy(Book $book)
    {
        $cart = session()->get('cart', []);

        unset($cart[$book->id]);

        session()->put('cart', $cart);

        return back()->with('success', 'Buku berhasil dihapus dari keranjang.');
    }

    // Mengosongkan keranjang
    public function clear()
    {
        session()->forget('cart');

        return back()->with('success', 'Keranjang berhasil dikosongkan.');
    }
}
