<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')
                ->with('error', 'Keranjang belanja masih kosong.');
        }

        $books = Book::whereIn('id', array_keys($cart))->get();

        if ($books->count() !== count($cart)) {
            return redirect()->route('cart.index')
                ->with('error', 'Ada buku di keranjang yang sudah tidak tersedia.');
        }

        $items = $books->map(function ($book) use ($cart) {
            $quantity = (int) $cart[$book->id]['quantity'];

            return [
                'book' => $book,
                'quantity' => $quantity,
                'subtotal' => $book->price * $quantity,
            ];
        });

        $total = $items->sum('subtotal');

        return view('checkout.index', compact('items', 'total'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'payment_method' => ['required', 'in:cod,bank_transfer'],
        ]);

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')
                ->with('error', 'Keranjang belanja masih kosong.');
        }

        $orderNumber = 'ORD-' . now()->format('YmdHis')
            . '-' . strtoupper(Str::random(5));

        $paymentMethod = $validated['payment_method'];

        DB::transaction(function () use (
            $cart,
            $request,
            $orderNumber,
            $paymentMethod
        ) {
            foreach ($cart as $bookId => $item) {
                $book = Book::whereKey($bookId)
                    ->lockForUpdate()
                    ->first();

                if (!$book) {
                    throw ValidationException::withMessages([
                        'checkout' => 'Ada buku yang sudah tidak tersedia.',
                    ]);
                }

                $quantity = (int) $item['quantity'];

                if ($quantity < 1 || $book->stock < $quantity) {
                    throw ValidationException::withMessages([
                        'checkout' => 'Stok buku "' . $book->title
                            . '" tidak mencukupi.',
                    ]);
                }

                Transaction::create([
                    'order_number' => $orderNumber,
                    'customer_id' => $request->user()->id,
                    'book_id' => $book->id,
                    'quantity' => $quantity,
                    'total_amount' => $book->price * $quantity,
                    'payment_method' => $paymentMethod,
                    'payment_status' => 'unpaid',
                ]);

                $book->decrement('stock', $quantity);
            }
        });

        session()->put('last_order_number', $orderNumber);
        session()->forget('cart');

        return redirect()->route('checkout.success')
            ->with('success', 'Checkout berhasil! Pesanan kamu sudah tersimpan.');
    }

    public function success()
    {
        $orderNumber = session()->get('last_order_number');

        return view('checkout.success', compact('orderNumber'));
    }
}