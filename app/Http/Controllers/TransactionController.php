<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class TransactionController extends Controller
{
    // Admin: melihat seluruh transaksi
    public function index()
    {
        $transactions = Transaction::with(['customer', 'book'])
            ->latest()
            ->get();

        return response()->json([
            'success' => true,
            'data' => $transactions,
        ]);
    }

    // Customer: membuat transaksi
    public function store(Request $request)
    {
        $validated = $request->validate([
            'book_id' => 'required|integer|exists:books,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $transaction = DB::transaction(function () use ($validated, $request) {
            $book = Book::whereKey($validated['book_id'])
                ->lockForUpdate()
                ->first();

            if (!$book) {
                throw ValidationException::withMessages([
                    'book_id' => 'Buku tidak ditemukan.',
                ]);
            }

            $quantity = (int) $validated['quantity'];

            if ($quantity > $book->stock) {
                throw ValidationException::withMessages([
                    'quantity' => 'Stok buku "' . $book->title . '" tidak mencukupi. Stok tersedia: ' . $book->stock,
                ]);
            }

            $orderNumber = 'ORD-' . now()->format('YmdHis')
                . '-' . strtoupper(Str::random(6));

            $transaction = Transaction::create([
                'order_number' => $orderNumber,
                'customer_id' => $request->user()->id,
                'book_id' => $book->id,
                'quantity' => $quantity,
                'total_amount' => $book->price * $quantity,
            ]);

            $book->decrement('stock', $quantity);

            return $transaction;
        });

        return response()->json([
            'success' => true,
            'message' => 'Transaksi berhasil dibuat.',
            'data' => $transaction->load(['customer', 'book']),
        ], 201);
    }

    // Customer: hanya melihat transaksi miliknya
    public function show(Request $request, string $id)
    {
        $transaction = Transaction::with(['customer', 'book'])
            ->where('customer_id', $request->user()->id)
            ->find($id);

        if (!$transaction) {
            return response()->json([
                'success' => false,
                'message' => 'Transaksi tidak ditemukan.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $transaction,
        ]);
    }
}