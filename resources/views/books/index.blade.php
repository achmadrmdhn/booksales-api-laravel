<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Koleksi Buku</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(135deg, #eef2f3, #d9e4f5);
      min-height: 100vh;
      font-family: 'Poppins', sans-serif;
    }
    h1 { font-weight: 700; color: #0d6efd; }
    .table {
      border-radius: 12px;
      overflow: hidden;
      background: rgba(255, 255, 255, 0.85);
      box-shadow: 0 8px 20px rgba(13,110,253,.1);
    }
    thead { background-color: #0d6efd; color: #fff; border-bottom: 2px solid #0a58ca; }
    tbody tr { transition: all .2s ease; }
    tbody tr:hover { background-color: rgba(13,110,253,.05); transform: translateY(-1px); }
    td, th { vertical-align: middle; }
    .badge { font-weight: 500; border-radius: 6px; }
    .description-cell { font-size: .9em; color: #6c757d; }
    .btn-modern { border-radius: 999px; padding: 10px 18px; transition: transform .2s ease; }
    .btn-modern:hover { transform: translateY(-2px); }
    .thumb {
      width: 56px; height: 56px; object-fit: cover;
      border-radius: 8px; border: 1px solid #e9ecef;
      background: #f8f9fa;
    }
    .path-text { max-width: 180px; display: inline-block; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; vertical-align: middle; }
  </style>
</head>
<body>

  <div class="container py-5">
    <h1 class="mb-4 text-center border-bottom pb-3">📖 Daftar Koleksi Buku</h1>

    <div class="table-responsive">
      <table class="table table-hover align-middle">
        <thead>
          <tr>
            <th scope="col" style="width: 5%;">#</th>
            <th scope="col" style="width: 18%;">Judul</th>
            <th scope="col" style="width: 28%;">Deskripsi</th>
            <th scope="col" style="width: 12%;">Harga</th>
            <th scope="col" style="width: 10%;">Stok</th>
            <th scope="col" style="width: 15%;">Penulis</th>
            <th scope="col" style="width: 12%;">Genre</th>
            <th scope="col" style="width: 20%;">Cover</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($books as $book)
            <tr>
              <th scope="row">{{ $loop->iteration }}</th>
              <td><strong>{{ $book->title }}</strong></td>
              <td class="description-cell">{{ Str::limit($book->description, 100) }}</td>
              <td>
                <span class="badge bg-success">Rp {{ number_format($book->price, 0, ',', '.') }}</span>
              </td>
              <td>
                @php
                  $stockClass = $book->stock > 10 ? 'bg-primary' : ($book->stock > 5 ? 'bg-warning text-dark' : 'bg-danger');
                @endphp
                <span class="badge {{ $stockClass }}">{{ $book->stock }} pcs</span>
              </td>
              <td>
                @if($book->author)
                  {{ $book->author->name }}
                @else
                  <span class="text-danger small">N/A</span>
                @endif
              </td>
              <td>
                @if($book->genre)
                  <span class="badge bg-secondary">{{ $book->genre->name }}</span>
                @else
                  <span class="text-danger small">N/A</span>
                @endif
              </td>
              <td>
                @if($book->cover_photo)
                  <div class="d-flex align-items-center gap-2">
                    <img
                      class="thumb"
                      src="{{ asset('storage/'.$book->cover_photo) }}"
                      alt="Cover {{ $book->title }}"
                      loading="lazy">
                    <span class="path-text text-muted" title="{{ $book->cover_photo }}">{{ $book->cover_photo }}</span>
                  </div>
                @else
                  <span class="text-danger small">N/A</span>
                @endif
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="8" class="text-center text-muted py-4">
                Belum ada koleksi buku.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <div class="mt-5 text-center">
      <a href="/authors" class="btn btn-modern btn-success me-2">✍️ Lihat Penulis</a>
      <a href="/genres" class="btn btn-modern btn-primary">📚 Lihat Genre</a>
    </div>

  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
