<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kelola Buku - BookSales</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f4f8fc;
        }

        .main-card {
            border: none;
            border-radius: 14px;
        }

        .page-title {
            color: #174a78;
        }

        .btn-primary {
            background: #3987d6;
            border: none;
        }

        .book-cover {
            width: 55px;
            height: 75px;
            object-fit: cover;
            border-radius: 5px;
        }

        .cover-preview {
            width: 90px;
            height: 125px;
            object-fit: cover;
            border-radius: 6px;
            border: 1px solid #dee2e6;
        }
    </style>

<link rel='stylesheet' href='{{ asset('css/persona5.css') }}'>

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

<body data-persona-admin-bg="1">
<div class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold page-title">Kelola Buku</h2>
            <p class="text-muted">Tambah, edit, dan hapus data buku.</p>
        </div>

        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-primary">←</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <!-- FORM TAMBAH BUKU -->
    <div class="card main-card shadow-sm p-4 mb-4">
        <h5 class="fw-bold mb-3">Tambah Buku</h5>

        <form action="{{ route('admin.books.store') }}"
              method="POST"
              enctype="multipart/form-data">
            @csrf

            <div class="row">

                <div class="col-md-6 mb-3">
                    <label class="form-label">Judul Buku</label>
                    <input type="text"
                           name="title"
                           class="form-control"
                           value="{{ old('title') }}"
                           required>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Author</label>
                    <select name="author_id" class="form-select" required>
                        <option value="">Pilih Author</option>

                        @foreach($authors as $author)
                            <option value="{{ $author->id }}"
                                {{ old('author_id') == $author->id ? 'selected' : '' }}>
                                {{ $author->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Genre</label>
                    <select name="genre_id" class="form-select">
                        <option value="">Pilih Genre</option>

                        @foreach($genres as $genre)
                            <option value="{{ $genre->id }}"
                                {{ old('genre_id') == $genre->id ? 'selected' : '' }}>
                                {{ $genre->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3 mb-3">
                    <label class="form-label">Harga (Rp)</label>
                    <input type="number"
                           name="price"
                           class="form-control"
                           min="0"
                           step="0.01"
                           value="{{ old('price') }}"
                           required>
                </div>

                <div class="col-md-3 mb-3">
                    <label class="form-label">Stok</label>
                    <input type="number"
                           name="stock"
                           class="form-control"
                           min="0"
                           value="{{ old('stock', 0) }}"
                           required>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Upload Cover Buku</label>
                    <input type="file"
                           name="cover_file"
                           class="form-control"
                           accept=".jpg,.jpeg,.png,.webp">
                    <small class="text-muted">Format JPG, JPEG, PNG, WEBP. Maksimal 2 MB.</small>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Atau URL Cover Buku</label>
                    <input type="url"
                           name="cover_url"
                           class="form-control"
                           value="{{ old('cover_url') }}"
                           placeholder="https://contoh.com/buku.jpg">
                    <small class="text-muted">Jika upload file dan URL diisi bersamaan, file akan digunakan.</small>
                </div>

                <div class="col-12 mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="description"
                              class="form-control"
                              rows="3">{{ old('description') }}</textarea>
                </div>

            </div>

            <button type="submit" class="btn btn-primary">
                Tambah Buku
            </button>
        </form>
    </div>

    <!-- DAFTAR BUKU -->
    <div class="card main-card shadow-sm p-4">
        <h5 class="fw-bold mb-3">Daftar Buku</h5>

        <div class="table-responsive">
            <table class="table table-hover align-middle">

                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Cover</th>
                        <th>Judul</th>
                        <th>Genre</th>
                        <th>Author</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Transaksi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                @forelse($books as $book)
                    <tr>
                        <td>{{ $loop->iteration }}</td>

                        <td>
                            @if($book->cover_photo)
                                <img
                                    src="{{ \Illuminate\Support\Str::startsWith($book->cover_photo, ['http://', 'https://']) ? $book->cover_photo : asset('storage/' . $book->cover_photo) }}"
                                    alt="Cover {{ $book->title }}"
                                    class="book-cover">
                            @else
                                -
                            @endif
                        </td>

                        <td>{{ $book->title }}</td>
                        <td>{{ $book->genre?->name ?? '-' }}</td>
                        <td>{{ $book->author?->name ?? '-' }}</td>

                        <td>
                            Rp {{ number_format($book->price, 0, ',', '.') }}
                        </td>

                        <td>{{ $book->stock }}</td>

                        <td>
                            @if($book->transactions_count > 0)
                                <span class="badge bg-warning text-dark">
                                    {{ $book->transactions_count }} transaksi
                                </span>
                            @else
                                <span class="badge bg-success">
                                    Belum ada
                                </span>
                            @endif
                        </td>

                        <td>
                            <button class="btn btn-warning btn-sm mb-1"
                                    data-bs-toggle="modal"
                                    data-bs-target="#edit{{ $book->id }}">
                                Edit
                            </button>

                            @if($book->transactions_count > 0)
                                <button type="button"
                                        class="btn btn-danger btn-sm mb-1"
                                        disabled
                                        title="Buku memiliki transaksi dan tidak dapat dihapus">
                                    Hapus
                                </button>
                            @else
                                <form action="{{ route('admin.books.destroy', $book->id) }}"
                                      method="POST"
                                      class="d-inline"
                                      onsubmit="return confirm('Hapus buku ini?')">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="btn btn-danger btn-sm mb-1">
                                        Hapus
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center text-muted">
                            Belum ada data buku.
                        </td>
                    </tr>
                @endforelse
                </tbody>

            </table>
        </div>

        <p class="text-muted mb-0">
            Total buku: {{ $books->count() }}
        </p>
    </div>

</div>

<!-- MODAL EDIT -->
@foreach($books as $book)
    <div class="modal fade"
         id="edit{{ $book->id }}"
         tabindex="-1"
         aria-hidden="true">

        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <form action="{{ route('admin.books.update', $book->id) }}"
                      method="POST"
                      enctype="multipart/form-data">

                    @csrf
                    @method('PUT')

                    <div class="modal-header">
                        <h5 class="modal-title">Edit Buku</h5>

                        <button type="button"
                                class="btn-close"
                                data-bs-dismiss="modal">
                        </button>
                    </div>

                    <div class="modal-body">

                        <div class="mb-3">
                            <label class="form-label">Judul</label>
                            <input name="title"
                                   class="form-control"
                                   value="{{ $book->title }}"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Author</label>
                            <select name="author_id" class="form-select" required>
                                @foreach($authors as $author)
                                    <option value="{{ $author->id }}"
                                        @selected($book->author_id == $author->id)>
                                        {{ $author->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Genre</label>
                            <select name="genre_id" class="form-select">
                                <option value="">Pilih Genre</option>

                                @foreach($genres as $genre)
                                    <option value="{{ $genre->id }}"
                                        @selected($book->genre_id == $genre->id)>
                                        {{ $genre->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Harga</label>
                                <input type="number"
                                       name="price"
                                       class="form-control"
                                       min="0"
                                       step="0.01"
                                       value="{{ $book->price }}"
                                       required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Stok</label>
                                <input type="number"
                                       name="stock"
                                       class="form-control"
                                       min="0"
                                       value="{{ $book->stock }}"
                                       required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Cover Saat Ini</label>
                            @if($book->cover_photo)
                                <div class="mb-2">
                                    <img
                                        src="{{ \Illuminate\Support\Str::startsWith($book->cover_photo, ['http://', 'https://']) ? $book->cover_photo : asset('storage/' . $book->cover_photo) }}"
                                        alt="Cover {{ $book->title }}"
                                        class="cover-preview">
                                </div>
                            @else
                                <p class="text-muted">Belum ada cover.</p>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Upload Cover Baru</label>
                            <input type="file"
                                   name="cover_file"
                                   class="form-control"
                                   accept=".jpg,.jpeg,.png,.webp">
                            <small class="text-muted">Kosongkan jika tidak ingin mengganti gambar. Maksimal 2 MB.</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Atau Ganti dengan URL Cover</label>
                            <input type="url"
                                   name="cover_url"
                                   class="form-control"
                                   value="{{ \Illuminate\Support\Str::startsWith($book->cover_photo ?? '', ['http://', 'https://']) ? $book->cover_photo : '' }}"
                                   placeholder="https://contoh.com/buku.jpg">
                            <small class="text-muted">Kosongkan jika ingin mempertahankan cover saat ini.</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea name="description"
                                      class="form-control"
                                      rows="3">{{ $book->description }}</textarea>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button"
                                class="btn btn-secondary"
                                data-bs-dismiss="modal">
                            Batal
                        </button>

                        <button type="submit" class="btn btn-primary">
                            Simpan Perubahan
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endforeach

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
