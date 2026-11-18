<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class OrderHistoryController extends Controller
{
    /**
     * Menampilkan riwayat transaksi pelanggan.
     */
    public function index(Request $request)
    {
        $orders = Transaction::with('book')
            ->where('customer_id', $request->user()->id)
            ->orderByDesc('created_at')
            ->get()
            ->groupBy('order_number');

        return view('orders.index', compact('orders'));
    }

    /**
     * Menampilkan detail satu pesanan.
     */
    public function show(Request $request, string $orderNumber)
    {
        $transactions = Transaction::with('book')
            ->where('customer_id', $request->user()->id)
            ->where('order_number', $orderNumber)
            ->get();

        if ($transactions->isEmpty()) {
            abort(404);
        }

        $total = $transactions->sum('total_amount');

        return view('orders.show', compact(
            'transactions',
            'orderNumber',
            'total'
        ));
    }
}
