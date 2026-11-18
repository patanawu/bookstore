<?php

use App\Models\Genre;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('admin dapat melihat daftar genre', function () {
    $admin = User::factory()->create([
        'role' => 'admin',
    ]);

    Genre::create([
        'name' => 'Fantasi',
    ]);

    $response = $this->actingAs($admin)
        ->get(route('admin.genres'));

    $response->assertOk();
    $response->assertSee('Fantasi');
});

test('admin dapat menambahkan genre', function () {
    $admin = User::factory()->create([
        'role' => 'admin',
    ]);

    $response = $this->actingAs($admin)
        ->post(route('admin.genres.store'), [
            'name' => 'Sejarah',
        ]);

    $response->assertRedirect();
    $this->assertDatabaseHas('genres', [
        'name' => 'Sejarah',
    ]);
});

test('admin dapat memperbarui genre', function () {
    $admin = User::factory()->create([
        'role' => 'admin',
    ]);

    $genre = Genre::create([
        'name' => 'Fantasi',
    ]);

    $response = $this->actingAs($admin)
        ->put(route('admin.genres.update', $genre->id), [
            'name' => 'Fantasi Modern',
        ]);

    $response->assertRedirect();
    $this->assertDatabaseHas('genres', [
        'id' => $genre->id,
        'name' => 'Fantasi Modern',
    ]);
});

test('admin dapat menghapus genre yang tidak memiliki buku', function () {
    $admin = User::factory()->create([
        'role' => 'admin',
    ]);

    $genre = Genre::create([
        'name' => 'Komedi',
    ]);

    $response = $this->actingAs($admin)
        ->delete(route('admin.genres.destroy', $genre->id));

    $response->assertRedirect();
    $this->assertDatabaseMissing('genres', [
        'id' => $genre->id,
    ]);
});

test('customer tidak dapat mengakses halaman genre admin', function () {
    $customer = User::factory()->create([
        'role' => 'user',
    ]);

    $response = $this->actingAs($customer)
        ->get(route('admin.genres'));

    $response->assertForbidden();
});

test('genre yang memiliki buku tidak dapat dihapus', function () {
    $admin = User::factory()->create([
        'role' => 'admin',
    ]);

    $author = \App\Models\Author::create([
        'name' => 'Penulis Testing',
        'email' => 'penulis.testing@example.com',
    ]);

    $genre = Genre::create([
        'name' => 'Drama',
    ]);

    \App\Models\Book::create([
        'title' => 'Buku Testing',
        'description' => 'Buku untuk pengujian',
        'price' => 50000,
        'stock' => 10,
        'author_id' => $author->id,
        'genre_id' => $genre->id,
    ]);

    $response = $this->actingAs($admin)
        ->delete(route('admin.genres.destroy', $genre->id));

    $response->assertRedirect();
    $this->assertDatabaseHas('genres', [
        'id' => $genre->id,
    ]);
});