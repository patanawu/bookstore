<?php

use App\Models\Author;
use App\Models\Book;
use App\Models\Genre;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->customer = User::factory()->create([
        'role' => 'user',
    ]);

    $this->otherCustomer = User::factory()->create([
        'role' => 'user',
    ]);

    $this->admin = User::factory()->create([
        'role' => 'admin',
    ]);

    $author = Author::create([
        'name' => 'Penulis API',
        'email' => 'penulis-api@test.com',
        'bio' => 'Penulis untuk pengujian API.',
    ]);

    $genre = Genre::create([
        'name' => 'Genre API',
    ]);

    $this->book = Book::create([
        'title' => 'Buku API',
        'description' => 'Buku untuk pengujian transaksi API.',
        'price' => 50000,
        'stock' => 10,
        'author_id' => $author->id,
        'genre_id' => $genre->id,
    ]);
});

test('customer dapat membuat transaksi melalui API', function () {
    Sanctum::actingAs($this->customer);

    $response = $this->postJson('/api/transactions', [
        'book_id' => $this->book->id,
        'quantity' => 2,
    ]);

    $response->assertCreated()
        ->assertJsonPath('success', true)
        ->assertJsonPath('data.customer_id', $this->customer->id)
        ->assertJsonPath('data.book_id', $this->book->id)
        ->assertJsonPath('data.quantity', 2)
        ->assertJsonPath('data.total_amount', 100000);

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
});

test('customer dapat melihat transaksi miliknya melalui API', function () {
    $transaction = Transaction::create([
        'order_number' => 'API-OWN-001',
        'customer_id' => $this->customer->id,
        'book_id' => $this->book->id,
        'quantity' => 1,
        'total_amount' => 50000,
    ]);

    Sanctum::actingAs($this->customer);

    $this->getJson('/api/transactions/' . $transaction->id)
        ->assertOk()
        ->assertJsonPath('success', true)
        ->assertJsonPath('data.id', $transaction->id)
        ->assertJsonPath('data.customer_id', $this->customer->id);
});

test('customer tidak dapat melihat transaksi customer lain melalui API', function () {
    $transaction = Transaction::create([
        'order_number' => 'API-OTHER-001',
        'customer_id' => $this->otherCustomer->id,
        'book_id' => $this->book->id,
        'quantity' => 1,
        'total_amount' => 50000,
    ]);

    Sanctum::actingAs($this->customer);

    $this->getJson('/api/transactions/' . $transaction->id)
        ->assertNotFound()
        ->assertJsonPath('success', false);
});

test('customer tidak dapat melihat seluruh daftar transaksi API', function () {
    Sanctum::actingAs($this->customer);

    $this->getJson('/api/transactions')
        ->assertForbidden();
});

test('admin dapat melihat seluruh daftar transaksi API', function () {
    Transaction::create([
        'order_number' => 'API-ADMIN-001',
        'customer_id' => $this->customer->id,
        'book_id' => $this->book->id,
        'quantity' => 1,
        'total_amount' => 50000,
    ]);

    Sanctum::actingAs($this->admin);

    $this->getJson('/api/transactions')
        ->assertOk()
        ->assertJsonPath('success', true)
        ->assertJsonCount(1, 'data');
});

test('transaksi API ditolak jika stok buku tidak mencukupi', function () {
    Sanctum::actingAs($this->customer);

    $this->postJson('/api/transactions', [
        'book_id' => $this->book->id,
        'quantity' => 15,
    ])
        ->assertUnprocessable()
        ->assertJsonValidationErrors('quantity');

    $this->assertDatabaseHas('books', [
        'id' => $this->book->id,
        'stock' => 10,
    ]);

    $this->assertDatabaseMissing('transactions', [
        'customer_id' => $this->customer->id,
    ]);
});

test('pengunjung tanpa autentikasi tidak dapat mengakses API transaksi', function () {
    $this->postJson('/api/transactions', [
        'book_id' => $this->book->id,
        'quantity' => 1,
    ])->assertUnauthorized();

    $this->getJson('/api/transactions/1')
        ->assertUnauthorized();

    $this->getJson('/api/transactions')
        ->assertUnauthorized();
});