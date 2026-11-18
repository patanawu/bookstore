<?php

use App\Models\Author;
use App\Models\Book;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('admin dapat melihat daftar author', function () {
    $admin = User::factory()->create([
        'role' => 'admin',
    ]);

    Author::create([
        'name' => 'Andrea Hirata',
        'email' => 'andrea.testing@example.com',
    ]);

    $response = $this->actingAs($admin)
        ->get(route('admin.authors'));

    $response->assertOk();
    $response->assertSee('Andrea Hirata');
});

test('admin dapat menambahkan author', function () {
    $admin = User::factory()->create([
        'role' => 'admin',
    ]);

    $response = $this->actingAs($admin)
        ->post(route('admin.authors.store'), [
            'name' => 'Tere Liye',
            'email' => 'tere.testing@example.com',
            'bio' => 'Penulis novel Indonesia.',
        ]);

    $response->assertRedirect();

    $this->assertDatabaseHas('authors', [
        'name' => 'Tere Liye',
        'email' => 'tere.testing@example.com',
    ]);
});

test('admin dapat memperbarui author', function () {
    $admin = User::factory()->create([
        'role' => 'admin',
    ]);

    $author = Author::create([
        'name' => 'Andrea Hirata',
        'email' => 'andrea.testing@example.com',
    ]);

    $response = $this->actingAs($admin)
        ->put(route('admin.authors.update', $author->id), [
            'name' => 'Andrea Hirata Updated',
            'email' => 'andrea.updated@example.com',
            'bio' => 'Penulis terkenal.',
        ]);

    $response->assertRedirect();

    $this->assertDatabaseHas('authors', [
        'id' => $author->id,
        'name' => 'Andrea Hirata Updated',
        'email' => 'andrea.updated@example.com',
    ]);
});

test('admin dapat menghapus author yang tidak memiliki buku', function () {
    $admin = User::factory()->create([
        'role' => 'admin',
    ]);

    $author = Author::create([
        'name' => 'Penulis Testing',
        'email' => 'hapus.testing@example.com',
    ]);

    $response = $this->actingAs($admin)
        ->delete(route('admin.authors.destroy', $author->id));

    $response->assertRedirect();

    $this->assertDatabaseMissing('authors', [
        'id' => $author->id,
    ]);
});

test('customer tidak dapat mengakses halaman author admin', function () {
    $customer = User::factory()->create([
        'role' => 'user',
    ]);

    $response = $this->actingAs($customer)
        ->get(route('admin.authors'));

    $response->assertForbidden();
});

test('author yang memiliki buku tidak dapat dihapus', function () {
    $admin = User::factory()->create([
        'role' => 'admin',
    ]);

    $author = Author::create([
        'name' => 'Penulis Testing',
        'email' => 'penulis.testing@example.com',
    ]);

    Book::create([
        'title' => 'Buku Testing',
        'description' => 'Buku untuk pengujian.',
        'price' => 50000,
        'stock' => 10,
        'author_id' => $author->id,
    ]);

    $response = $this->actingAs($admin)
        ->delete(route('admin.authors.destroy', $author->id));

    $response->assertRedirect();

    $this->assertDatabaseHas('authors', [
        'id' => $author->id,
    ]);
});