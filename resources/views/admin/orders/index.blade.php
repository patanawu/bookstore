<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Pesanan - BookStore</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/persona5.css') }}">

    <style>
        body.admin-orders-page {
            background: #090909 !important;
            color: #f8f6f2 !important;
            min-height: 100vh;
            padding: 35px 15px;
        }

        .orders-wrapper {
            max-width: 1200px;
            margin: auto;
        }

        .orders-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            flex-wrap: wrap;
            margin-bottom: 30px;
        }

        .orders-title {
            color: #ed1025 !important;
            font-family: 'Barlow Condensed', sans-serif;
            font-size: clamp(32px, 5vw, 48px);
            font-weight: 900;
            font-style: italic;
            text-transform: uppercase;
            margin: 0;
        }

        .orders-subtitle {
            color: #aaa;
            margin-top: 5px;
        }

        .orders-back {
            display: inline-block;
            padding: 11px 20px;
            color: #fff !important;
            border: 2px solid #ed1025;
            text-decoration: none;
            font-weight: 800;
            text-transform: uppercase;
        }

        .orders-back:hover {
            background: #ed1025;
        }

        .order-card {
            background: #181818;
            border: 1px solid #383838;
            border-left: 5px solid #ed1025;
            padding: 22px;
            margin-bottom: 22px;
            box-shadow: 5px 5px 0 #a90016;
        }

        .order-heading {
            display: flex;
            justify-content: space-between;
            gap: 15px;
            flex-wrap: wrap;
            border-bottom: 1px solid #444;
            padding-bottom: 15px;
            margin-bottom: 15px;
        }

        .order-number {
            color: #ed1025;
            font-weight: 900;
            font-size: 18px;
        }

        .order-date {
            color: #aaa;
            font-size: 13px;
        }

        .customer-name {
            color: #fff;
            font-weight: 800;
        }

        .customer-email {
            color: #aaa;
            font-size: 13px;
        }

        .order-items {
            width: 100%;
            border-collapse: collapse;
            min-width: 480px;
        }

        .order-items th {
            color: #ed1025;
            text-transform: uppercase;
            font-size: 12px;
            padding: 12px;
            border-bottom: 1px solid #444;
        }

        .order-items td {
            color: #eee;
            padding: 12px;
            border-bottom: 1px solid #333;
        }

        .order-total {
            display: flex;
            justify-content: flex-end;
            gap: 15px;
            margin-top: 18px;
            font-weight: 800;
        }

        .order-total strong {
            color: #ed1025;
            font-size: 20px;
        }

        .orders-empty {
            background: #181818;
            padding: 40px 20px;
            text-align: center;
            color: #aaa;
            border: 1px solid #383838;
        }

        .orders-summary {
            color: #aaa;
            margin-bottom: 20px;
        }

        .orders-summary strong {
            color: #ed1025;
            font-size: 22px;
        }

        @media(max-width: 600px) {
            body.admin-orders-page {
                padding: 22px 12px;
            }

            .order-card {
                padding: 15px;
            }

            .orders-back {
                width: 100%;
                text-align: center;
            }
        }

        .order-status {
            display: inline-block;
            padding: 5px 12px;
            margin-top: 8px;
            font-size: 11px;
            font-weight: 900;
            text-transform: uppercase;
            border: 1px solid #ed1025;
            color: #ff4757;
        }

        .order-status.cancelled {
            border-color: #777;
            color: #aaa;
        }

        .order-actions {
            display: flex;
            justify-content: flex-end;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 22px;
        }

        .order-actions button {
            padding: 9px 16px;
            font-weight: 800;
            text-transform: uppercase;
            font-size: 12px;
        }

        .btn-cancel-order {
            background: #ed1025;
            border: 1px solid #ed1025;
            color: white;
        }

        .btn-cancel-order:hover {
            background: #a90016;
        }

        .btn-delete-order {
            background: transparent;
            border: 1px solid #777;
            color: #ddd;
        }

        .btn-delete-order:hover {
            background: #444;
            color: white;
        }
    
/* PAYMENT ADMIN */
.payment-summary {
    display: flex;
    flex-wrap: wrap;
    gap: 25px;
    padding: 15px 18px;
    margin: 18px 0;
    background: #202020;
    border-left: 3px solid #ed1025;
}

.payment-summary div {
    display: flex;
    flex-direction: column;
    gap: 6px;
}

.payment-summary span {
    color: #aaa;
    font-size: 12px;
}

.payment-summary strong {
    color: #fff;
}

.payment-badge.paid {
    color: #58d68d;
}

.payment-badge.unpaid {
    color: #ffc857;
}

.btn-payment {
    padding: 9px 16px;
    background: #f0c419;
    border: 1px solid #f0c419;
    color: #171717;
    font-weight: 800;
    text-transform: uppercase;
    font-size: 12px;
    cursor: pointer;
}
</style>

<style>

/* PERSONA 5 ADMIN BACKGROUND ONLY */

body[data-persona-admin-bg="1"] {
    position: relative;
    isolation: isolate;
    background-image:
        radial-gradient(circle at 88% 16%, rgba(237,16,37,.17), transparent 28%),
        radial-gradient(circle at 8% 85%, rgba(237,16,37,.09), transparent 30%),
        repeating-linear-gradient(
            135deg,
            transparent 0,
            transparent 38px,
            rgba(255,255,255,.012) 39px,
            transparent 41px
        ) !important;
    background-attachment: fixed !important;
}

body[data-persona-admin-bg="1"]::before {
    content: "";
    position: fixed;
    inset: 0;
    z-index: -1;
    pointer-events: none;
    opacity: .16;
    background-image: radial-gradient(
        rgba(255,255,255,.4) .8px,
        transparent .8px
    );
    background-size: 22px 22px;
}

body[data-persona-admin-bg="1"]::after {
    content: "\265B";
    position: fixed;
    right: 3%;
    bottom: 1%;
    z-index: -1;
    pointer-events: none;
    color: rgba(237,16,37,.055);
    font-size: clamp(190px, 28vw, 400px);
    font-weight: 900;
    line-height: 1;
    transform: rotate(-12deg);
    text-shadow: 0 0 45px rgba(237,16,37,.2);
    animation: adminPersonaCrown 9s ease-in-out infinite;
}

@keyframes adminPersonaCrown {
    0%, 100% {
        transform: translateY(0) rotate(-12deg);
        opacity: .65;
    }
    50% {
        transform: translateY(-14px) rotate(-8deg);
        opacity: 1;
    }
}

@media (prefers-reduced-motion: reduce) {
    body[data-persona-admin-bg="1"]::after {
        animation: none;
    }
}

</style>
</head>

<body class="admin-orders-page" data-persona-admin-bg="1">
    <main class="orders-wrapper">
        <header class="orders-header">
            <div>
                <h1 class="orders-title">Order Management</h1>
                <p class="orders-subtitle">Daftar seluruh pesanan pelanggan BookStore.</p>
            </div>

            <a href="{{ route('admin.dashboard') }}" class="orders-back">←</a>
        </header>

        <p class="orders-summary">
            TOTAL PESANAN:
            <strong>{{ $orders->count() }}</strong>
        </p>

        @forelse($orders as $orderNumber => $items)
            @php
                $first = $items->first();
                $customer = $first->customer;
                $orderTotal = $items->sum('total_amount');
                $orderStatus = $first->status ?? 'pending';
                $paymentMethod = $first->payment_method ?? 'cod';
                $paymentStatus = $first->payment_status ?? 'unpaid';
            @endphp

            <section class="order-card">
                <div class="order-heading">
                    <div>
                        <div class="order-number">{{ $orderNumber }}</div>
                        <div class="order-date">
                            {{ $first->created_at?->format('d-m-Y H:i') ?? '-' }}
                        </div>
                        <span class="order-status {{ $orderStatus === 'cancelled' ? 'cancelled' : '' }}">
                            {{ $orderStatus === 'cancelled' ? 'Dibatalkan' : 'Menunggu' }}
                        </span>
                    </div>

                    <div>
                        <div class="customer-name">
                            {{ $customer?->name ?? 'User tidak tersedia' }}
                        </div>
                        <div class="customer-email">
                            {{ $customer?->email ?? '-' }}
                        </div>
                    </div>
</div>

                <div class="payment-summary">
                    <div>
                        <span>Metode Pembayaran</span>
                        <strong>{{ $paymentMethod === 'bank_transfer' ? 'Transfer Bank' : 'COD' }}</strong>
                    </div>
                    <div>
                        <span>Status Pembayaran</span>
                        <strong class="payment-badge {{ $paymentStatus === 'paid' ? 'paid' : 'unpaid' }}">
                            {{ $paymentStatus === 'paid' ? 'LUNAS' : 'BELUM DIBAYAR' }}
                        </strong>
                    </div>
                </div>
                <div class="table-responsive">

                    <table class="order-items">
                        <thead>
                            <tr>
                                <th>Buku</th>
                                <th>Jumlah</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($items as $item)
                                <tr>
                                    <td>{{ $item->book?->title ?? 'Buku tidak tersedia' }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>Rp {{ number_format($item->total_amount, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="order-total">
                    <span>Total Pesanan</span>
                    <strong>Rp {{ number_format($orderTotal, 0, ',', '.') }}</strong>
                </div>

                <div class="order-actions">
                    @if($orderStatus !== 'cancelled' && $paymentStatus !== 'paid')
                        <form action="{{ route('admin.orders.payment', $orderNumber) }}"
                              method="POST"
                              onsubmit="return confirm('Ubah status pembayaran pesanan ini?');">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="payment_status"
                                   value="{{ $paymentStatus === 'paid' ? 'unpaid' : 'paid' }}">
                            <button type="submit" class="btn-payment">
                                {{ $paymentStatus === 'paid' ? 'Tandai Belum Dibayar' : 'Tandai Lunas' }}
                            </button>
                        </form>
                    @endif

                    @if($orderStatus !== 'cancelled')
                        <form action="{{ route('admin.orders.cancel', $orderNumber) }}"
                              method="POST"
                              onsubmit="return confirm('Batalkan pesanan ini? Stok buku akan dikembalikan.');">
                            @csrf
                            <button type="submit" class="btn-cancel-order">
                                Batalkan Pesanan
                            </button>
                        </form>
                    @endif

                    <form action="{{ route('admin.orders.destroy', $orderNumber) }}"
                          method="POST"
                          onsubmit="return confirm('Hapus permanen seluruh data pesanan ini? Tindakan ini tidak dapat dibatalkan.');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-delete-order">
                            Hapus Pesanan
                        </button>
                    </form>
                </div>
            </section>
        @empty
            <div class="orders-empty">
                Belum ada pesanan yang masuk.
            </div>
        @endforelse
    </main>
</body>
</html>