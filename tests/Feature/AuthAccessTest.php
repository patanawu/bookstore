<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('admin dapat mengakses dashboard admin', function () {
    $admin = User::factory()->create([
        'role' => 'admin',
    ]);

    $response = $this->actingAs($admin)
        ->get(route('admin.dashboard'));

    $response->assertOk();
});

test('customer tidak dapat mengakses dashboard admin', function () {
    $customer = User::factory()->create([
        'role' => 'user',
    ]);

    $response = $this->actingAs($customer)
        ->get(route('admin.dashboard'));

    $response->assertForbidden();
});

test('customer dapat mengakses halaman keranjang', function () {
    $customer = User::factory()->create([
        'role' => 'user',
    ]);

    $response = $this->actingAs($customer)
        ->get(route('cart.index'));

    $response->assertOk();
});

test('admin tidak dapat mengakses halaman keranjang', function () {
    $admin = User::factory()->create([
        'role' => 'admin',
    ]);

    $response = $this->actingAs($admin)
        ->get(route('cart.index'));

    $response->assertForbidden();
});

test('pengunjung yang belum login diarahkan ke halaman login', function () {
    $response = $this->get(route('cart.index'));

    $response->assertRedirect(route('login'));
});