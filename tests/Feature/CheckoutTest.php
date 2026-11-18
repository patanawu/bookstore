<?php

use App\Models\Author;
use App\Models\Book;
use App\Models\Genre;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->customer = User::factory()->create([
        'role' => 'user',
    ]);

    $this->otherCustomer = User::factory()->create([
        'role' => 'user',
    ]);

    $this->author = Author::create([
        'name' => 'Penulis Checkout',
        'email' => 'checkout@test.com',
        'bio' => 'Penulis untuk pengujian checkout.',
    ]);

    $this->genre = Genre::create([
        'name' => 'Genre Checkout',
    ]);

    $this->book = Book::create([
        'title' => 'Buku Checkout',
        'description' => 'Buku untuk pengujian checkout.',
        'price' => 50000,
        'stock' => 10,
        'author_id' => $this->author->id,
        'genre_id' => $this->genre->id,
    ]);
});

test('customer dapat melihat halaman checkout jika keranjang terisi', function () {
    $this->actingAs($this->customer)
        ->withSession([
            'cart' => [
                $this->book->id => [
                    'quantity' => 2,
                ],
            ],
        ])
        ->get(route('checkout.index'))
        ->assertOk()
        ->assertViewHas('total', 100000);
});

test('customer berhasil checkout satu buku', function () {
    $response = $this->actingAs($this->customer)
        ->withSession([
            'cart' => [
                $this->book->id => [
                    'quantity' => 2,
                ],
            ],
        ])
        ->post(route('checkout.store'));

    $response->assertRedirect(route('checkout.success'));

    $this->assertDatabaseHas('transactions', [
        'customer_id' => $this->customer->id,
        'book_id' => $this->book->id,
        'quantity' => 2,
        'total_amount' => 100000,
    ]);

    $this->assertDatabaseHas('books', [
        'id' => $this->book->id,
        'stock' => 8,
    ]);

    $response->assertSessionHas('last_order_number');
    $response->assertSessionMissing('cart');
});

test('customer dapat checkout beberapa buku dengan satu nomor pesanan', function () {
    $secondBook = Book::create([
        'title' => 'Buku Kedua',
        'description' => 'Buku kedua untuk pengujian.',
        'price' => 75000,
        'stock' => 8,
        'author_id' => $this->author->id,
        'genre_id' => $this->genre->id,
    ]);

    $response = $this->actingAs($this->customer)
        ->withSession([
            'cart' => [
                $this->book->id => [
                    'quantity' => 2,
                ],
                $secondBook->id => [
                    'quantity' => 3,
                ],
            ],
        ])
        ->post(route('checkout.store'));

    $response->assertRedirect(route('checkout.success'));

    $transactions = Transaction::where(
        'customer_id',
        $this->customer->id
    )->get();

    $this->assertCount(2, $transactions);

    $this->assertEquals(
        1,
        $transactions->pluck('order_number')->unique()->count()
    );

    $this->assertDatabaseHas('transactions', [
        'book_id' => $this->book->id,
        'quantity' => 2,
        'total_amount' => 100000,
    ]);

    $this->assertDatabaseHas('transactions', [
        'book_id' => $secondBook->id,
        'quantity' => 3,
        'total_amount' => 225000,
    ]);

    $this->assertDatabaseHas('books', [
        'id' => $this->book->id,
        'stock' => 8,
    ]);

    $this->assertDatabaseHas('books', [
        'id' => $secondBook->id,
        'stock' => 5,
    ]);
});

test('checkout ditolak jika stok buku tidak mencukupi', function () {
    $response = $this->actingAs($this->customer)
        ->from(route('checkout.index'))
        ->withSession([
            'cart' => [
                $this->book->id => [
                    'quantity' => 15,
                ],
            ],
        ])
        ->post(route('checkout.store'));

    $response->assertRedirect(route('checkout.index'));
    $response->assertSessionHasErrors('checkout');

    $this->assertDatabaseHas('books', [
        'id' => $this->book->id,
        'stock' => 10,
    ]);

    $this->assertDatabaseMissing('transactions', [
        'customer_id' => $this->customer->id,
    ]);

    $response->assertSessionHas('cart');
});

test('checkout ditolak jika keranjang kosong', function () {
    $this->actingAs($this->customer)
        ->post(route('checkout.store'))
        ->assertRedirect(route('cart.index'));
});

test('customer hanya melihat riwayat pesanannya sendiri', function () {
    $ownTransaction = Transaction::create([
        'order_number' => 'OWN-ORDER-001',
        'customer_id' => $this->customer->id,
        'book_id' => $this->book->id,
        'quantity' => 1,
        'total_amount' => 50000,
    ]);

    Transaction::create([
        'order_number' => 'OTHER-ORDER-001',
        'customer_id' => $this->otherCustomer->id,
        'book_id' => $this->book->id,
        'quantity' => 1,
        'total_amount' => 50000,
    ]);

    $this->actingAs($this->customer)
        ->get(route('orders.index'))
        ->assertOk()
        ->assertViewHas('orders', function ($orders) {
            return $orders->has('OWN-ORDER-001')
                && !$orders->has('OTHER-ORDER-001');
        });
});

test('customer dapat melihat detail pesanannya sendiri', function () {
    Transaction::create([
        'order_number' => 'OWN-ORDER-002',
        'customer_id' => $this->customer->id,
        'book_id' => $this->book->id,
        'quantity' => 2,
        'total_amount' => 100000,
    ]);

    $this->actingAs($this->customer)
        ->get(route('orders.show', 'OWN-ORDER-002'))
        ->assertOk()
        ->assertViewHas('total', 100000);
});

test('customer tidak dapat melihat detail pesanan milik customer lain', function () {
    Transaction::create([
        'order_number' => 'OTHER-ORDER-002',
        'customer_id' => $this->otherCustomer->id,
        'book_id' => $this->book->id,
        'quantity' => 1,
        'total_amount' => 50000,
    ]);

    $this->actingAs($this->customer)
        ->get(route('orders.show', 'OTHER-ORDER-002'))
        ->assertNotFound();
});