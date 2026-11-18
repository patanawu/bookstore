<?php

use App\Models\Author;
use App\Models\Book;
use App\Models\Genre;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->admin = User::factory()->create([
        'role' => 'admin',
    ]);

    $this->customer = User::factory()->create([
        'role' => 'user',
    ]);

    $this->author = Author::create([
        'name' => 'Penulis Pengujian',
        'email' => 'penulis@test.com',
        'bio' => 'Penulis untuk kebutuhan pengujian.',
    ]);

    $this->genre = Genre::create([
        'name' => 'Genre Pengujian',
    ]);
});

test('admin dapat melihat daftar buku', function () {
    Book::create([
        'title' => 'Buku Pengujian',
        'description' => 'Deskripsi buku.',
        'price' => 50000,
        'stock' => 10,
        'author_id' => $this->author->id,
        'genre_id' => $this->genre->id,
    ]);

    $this->actingAs($this->admin)
        ->get(route('admin.books'))
        ->assertOk();
});

test('admin dapat menambahkan buku', function () {
    $response = $this->actingAs($this->admin)
        ->post(route('admin.books.store'), [
            'title' => 'Buku Baru',
            'description' => 'Deskripsi buku baru.',
            'price' => 75000,
            'stock' => 15,
            'author_id' => $this->author->id,
            'genre_id' => $this->genre->id,
        ]);

    $response->assertRedirect();

    $this->assertDatabaseHas('books', [
        'title' => 'Buku Baru',
        'price' => 75000,
        'stock' => 15,
        'author_id' => $this->author->id,
    ]);
});

test('admin dapat mengunggah cover saat menambahkan buku', function () {
    Storage::fake('public');

    $file = UploadedFile::fake()->create('cover-baru.jpg', 100, 'image/jpeg');

    $response = $this->actingAs($this->admin)
        ->post(route('admin.books.store'), [
            'title' => 'Buku dengan Cover',
            'description' => 'Buku untuk pengujian upload.',
            'price' => 85000,
            'stock' => 10,
            'author_id' => $this->author->id,
            'genre_id' => $this->genre->id,
            'cover_file' => $file,
        ]);

    $response->assertRedirect();

    $book = Book::where('title', 'Buku dengan Cover')->firstOrFail();

    expect($book->cover_photo)->toStartWith('books/');

    Storage::disk('public')->assertExists($book->cover_photo);
});

test('admin dapat memperbarui buku', function () {
    $book = Book::create([
        'title' => 'Judul Lama',
        'description' => 'Deskripsi lama.',
        'price' => 50000,
        'stock' => 5,
        'author_id' => $this->author->id,
        'genre_id' => $this->genre->id,
    ]);

    $response = $this->actingAs($this->admin)
        ->put(route('admin.books.update', $book->id), [
            'title' => 'Judul Baru',
            'description' => 'Deskripsi baru.',
            'price' => 90000,
            'stock' => 20,
            'author_id' => $this->author->id,
            'genre_id' => $this->genre->id,
        ]);

    $response->assertRedirect();

    $this->assertDatabaseHas('books', [
        'id' => $book->id,
        'title' => 'Judul Baru',
        'price' => 90000,
        'stock' => 20,
    ]);
});

test('admin dapat mengganti cover buku dan cover lama dibersihkan', function () {
    Storage::fake('public');

    Storage::disk('public')->put('books/cover-lama.jpg', 'cover lama');

    $book = Book::create([
        'title' => 'Buku Cover Lama',
        'description' => 'Pengujian penggantian cover.',
        'price' => 50000,
        'stock' => 5,
        'cover_photo' => 'books/cover-lama.jpg',
        'author_id' => $this->author->id,
        'genre_id' => $this->genre->id,
    ]);

    $file = UploadedFile::fake()->create('cover-baru.jpg', 100, 'image/jpeg');

    $response = $this->actingAs($this->admin)
        ->put(route('admin.books.update', $book->id), [
            'title' => 'Buku Cover Lama',
            'description' => 'Pengujian penggantian cover.',
            'price' => 50000,
            'stock' => 5,
            'author_id' => $this->author->id,
            'genre_id' => $this->genre->id,
            'cover_file' => $file,
        ]);

    $response->assertRedirect();

    $book->refresh();

    expect($book->cover_photo)->toStartWith('books/');

    Storage::disk('public')->assertExists($book->cover_photo);
    Storage::disk('public')->assertMissing('books/cover-lama.jpg');
});

test('admin dapat mengganti cover lokal dengan URL eksternal', function () {
    Storage::fake('public');

    Storage::disk('public')->put('books/cover-lama.jpg', 'cover lama');

    $book = Book::create([
        'title' => 'Buku Cover URL',
        'description' => 'Pengujian penggantian URL.',
        'price' => 50000,
        'stock' => 5,
        'cover_photo' => 'books/cover-lama.jpg',
        'author_id' => $this->author->id,
        'genre_id' => $this->genre->id,
    ]);

    $url = 'https://example.com/cover-baru.jpg';

    $response = $this->actingAs($this->admin)
        ->put(route('admin.books.update', $book->id), [
            'title' => 'Buku Cover URL',
            'description' => 'Pengujian penggantian URL.',
            'price' => 50000,
            'stock' => 5,
            'author_id' => $this->author->id,
            'genre_id' => $this->genre->id,
            'cover_url' => $url,
        ]);

    $response->assertRedirect();

    $this->assertDatabaseHas('books', [
        'id' => $book->id,
        'cover_photo' => $url,
    ]);

    Storage::disk('public')->assertMissing('books/cover-lama.jpg');
});

test('cover lama tetap tersimpan jika file pengganti tidak valid', function () {
    Storage::fake('public');

    Storage::disk('public')->put('books/cover-lama.jpg', 'cover lama');

    $book = Book::create([
        'title' => 'Buku Cover Aman',
        'description' => 'Pengujian validasi cover.',
        'price' => 50000,
        'stock' => 5,
        'cover_photo' => 'books/cover-lama.jpg',
        'author_id' => $this->author->id,
        'genre_id' => $this->genre->id,
    ]);

    $invalidFile = UploadedFile::fake()->create(
        'dokumen.txt',
        100,
        'text/plain'
    );

    $response = $this->actingAs($this->admin)
        ->put(route('admin.books.update', $book->id), [
            'title' => 'Buku Cover Aman',
            'description' => 'Pengujian validasi cover.',
            'price' => 50000,
            'stock' => 5,
            'author_id' => $this->author->id,
            'genre_id' => $this->genre->id,
            'cover_file' => $invalidFile,
        ]);

    $response->assertSessionHasErrors('cover_file');

    Storage::disk('public')->assertExists('books/cover-lama.jpg');

    $this->assertDatabaseHas('books', [
        'id' => $book->id,
        'cover_photo' => 'books/cover-lama.jpg',
    ]);
});

test('admin dapat menghapus buku yang belum memiliki transaksi', function () {
    $book = Book::create([
        'title' => 'Buku Tanpa Transaksi',
        'description' => 'Buku untuk pengujian hapus.',
        'price' => 40000,
        'stock' => 5,
        'author_id' => $this->author->id,
        'genre_id' => $this->genre->id,
    ]);

    $response = $this->actingAs($this->admin)
        ->delete(route('admin.books.destroy', $book->id));

    $response->assertRedirect();

    $this->assertDatabaseMissing('books', [
        'id' => $book->id,
    ]);
});

test('customer tidak dapat mengakses halaman buku admin', function () {
    $this->actingAs($this->customer)
        ->get(route('admin.books'))
        ->assertForbidden();
});

test('customer tidak dapat mengunggah buku melalui halaman admin', function () {
    Storage::fake('public');

    $response = $this->actingAs($this->customer)
        ->post(route('admin.books.store'), [
            'title' => 'Buku Customer',
            'price' => 50000,
            'stock' => 5,
            'author_id' => $this->author->id,
            'cover_file' => UploadedFile::fake()->create('cover.jpg', 100, 'image/jpeg'),
        ]);

    $response->assertForbidden();

    $this->assertDatabaseMissing('books', [
        'title' => 'Buku Customer',
    ]);
});

test('buku yang memiliki transaksi tidak dapat dihapus', function () {
    $book = Book::create([
        'title' => 'Buku dengan Transaksi',
        'description' => 'Buku yang sudah pernah dibeli.',
        'price' => 60000,
        'stock' => 5,
        'author_id' => $this->author->id,
        'genre_id' => $this->genre->id,
    ]);

    Transaction::create([
        'order_number' => 'TEST-ORDER-001',
        'customer_id' => $this->customer->id,
        'book_id' => $book->id,
        'total_amount' => 60000,
    ]);

    $response = $this->actingAs($this->admin)
        ->delete(route('admin.books.destroy', $book->id));

    $response->assertRedirect();

    $this->assertDatabaseHas('books', [
        'id' => $book->id,
        'title' => 'Buku dengan Transaksi',
    ]);

    $this->assertDatabaseHas('transactions', [
        'order_number' => 'TEST-ORDER-001',
        'book_id' => $book->id,
    ]);
});

test('admin tidak dapat menambahkan buku dengan data tidak valid', function () {
    $response = $this->actingAs($this->admin)
        ->post(route('admin.books.store'), [
            'title' => '',
            'description' => 'Data tidak valid.',
            'price' => -100,
            'stock' => -1,
            'author_id' => $this->author->id,
            'genre_id' => $this->genre->id,
        ]);

    $response->assertSessionHasErrors([
        'title',
        'price',
        'stock',
    ]);

    $this->assertDatabaseMissing('books', [
        'description' => 'Data tidak valid.',
    ]);
});