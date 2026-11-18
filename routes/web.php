<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerAuthController;
use App\Http\Controllers\BookCatalogController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderHistoryController;
use App\Http\Controllers\ContactController;


// CONTACT ADMIN
Route::get('/contact', [ContactController::class, 'create'])->name('contact.create');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// ABOUT US
Route::view('/about', 'about')->name('about');
// HALAMAN UTAMA
Route::get('/', function () {
    return view('welcome');
})->name('home');

// KATALOG BUKU
Route::get('/books', [BookCatalogController::class, 'index'])
    ->name('catalog.index');

Route::get('/books/{book}', [BookCatalogController::class, 'show'])
    ->name('catalog.show');

// CUSTOMER REGISTER DAN LOGIN
Route::middleware('guest')->group(function () {
    Route::get('/register', [CustomerAuthController::class, 'showRegister'])
        ->name('register');

    Route::post('/register', [CustomerAuthController::class, 'register'])
        ->name('register.submit');

    Route::get('/login', [CustomerAuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [CustomerAuthController::class, 'login'])
        ->middleware('throttle:5,1')
        ->name('login.submit');
});

// CUSTOMER LOGOUT
Route::post('/logout', [CustomerAuthController::class, 'logout'])
    ->middleware(['auth', 'customer'])
    ->name('logout');

// SHOPPING CART
Route::middleware(['auth', 'customer'])
    ->prefix('cart')
    ->name('cart.')
    ->group(function () {
        Route::get('/', [CartController::class, 'index'])->name('index');
        Route::post('/add/{book}', [CartController::class, 'store'])->name('store');
        Route::patch('/update/{book}', [CartController::class, 'update'])->name('update');
        Route::delete('/remove/{book}', [CartController::class, 'destroy'])->name('destroy');
        Route::delete('/clear', [CartController::class, 'clear'])->name('clear');
    });

// CHECKOUT
Route::middleware(['auth', 'customer'])->group(function () {
    Route::get('/checkout', [CheckoutController::class, 'index'])
        ->name('checkout.index');

    Route::post('/checkout', [CheckoutController::class, 'store'])
        ->name('checkout.store');

    Route::get('/checkout/success', [CheckoutController::class, 'success'])
        ->name('checkout.success');
});

// RIWAYAT TRANSAKSI CUSTOMER
Route::middleware(['auth', 'customer'])
    ->prefix('orders')
    ->name('orders.')
    ->group(function () {
        Route::get('/', [OrderHistoryController::class, 'index'])->name('index');
        Route::get('/{orderNumber}', [OrderHistoryController::class, 'show'])->name('show');
    });

// ADMIN LOGIN LAMA DIARAHKAN KE LOGIN BERSAMA
Route::get('/admin/login', function () {
    return redirect()->route('login');
})->name('admin.login');

Route::post('/admin/login', function () {
    return redirect()->route('login');
})->name('admin.login.submit');

// ADMIN DASHBOARD, CRUD, DAN LOGOUT
Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        // Genre
        Route::get('/genres', [AdminController::class, 'genres'])->name('genres');
        Route::post('/genres', [AdminController::class, 'storeGenre'])->name('genres.store');
        Route::put('/genres/{genre}', [AdminController::class, 'updateGenre'])->name('genres.update');
        Route::delete('/genres/{genre}', [AdminController::class, 'destroyGenre'])->name('genres.destroy');

        // Author
        Route::get('/authors', [AdminController::class, 'authors'])->name('authors');
        Route::post('/authors', [AdminController::class, 'storeAuthor'])->name('authors.store');
        Route::put('/authors/{author}', [AdminController::class, 'updateAuthor'])->name('authors.update');
        Route::delete('/authors/{author}', [AdminController::class, 'destroyAuthor'])->name('authors.destroy');

        // Book
        Route::get('/books', [AdminController::class, 'books'])->name('books');
        Route::post('/books', [AdminController::class, 'storeBook'])->name('books.store');
        Route::put('/books/{book}', [AdminController::class, 'updateBook'])->name('books.update');
        Route::delete('/books/{book}', [AdminController::class, 'destroyBook'])->name('books.destroy');

        // Users
        Route::get('/users', [AdminController::class, 'users'])->name('users');
        Route::get('/orders', [AdminController::class, 'orders'])->name('orders');
        Route::patch('/orders/{orderNumber}/payment', [AdminController::class, 'updatePaymentStatus'])->name('orders.payment');
        Route::post('/orders/{orderNumber}/cancel', [AdminController::class, 'cancelOrder'])->name('orders.cancel');
        Route::delete('/orders/{orderNumber}', [AdminController::class, 'destroyOrder'])->name('orders.destroy');

        // Contact Messages
        Route::get('/contact-messages', [ContactController::class, 'index'])->name('contact-messages.index');
        Route::delete('/contact-messages/{contactMessage}', [ContactController::class, 'destroy'])->name('contact-messages.destroy');

        // Logout
        Route::post('/logout', [AdminAuthController::class, 'logout'])
            ->name('logout');
    });
