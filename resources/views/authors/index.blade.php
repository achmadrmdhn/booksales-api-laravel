<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Daftar Penulis</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(135deg, #eef2f3, #d9e4f5);
      min-height: 100vh;
      font-family: 'Poppins', system-ui, -apple-system, Segoe UI, Roboto, "Helvetica Neue", Arial;
    }

    h1 {
      font-weight: 700;
      color: #198754;
    }

    .glass-card {
      border: 0;
      border-radius: 1rem;
      backdrop-filter: blur(12px);
      background: rgba(255, 255, 255, 0.75);
      box-shadow: 0 10px 24px rgba(0, 0, 0, 0.06);
    }

    .table-glass {
      overflow: hidden;
      border-radius: 0.8rem;
    }

    thead.table-success th {
      position: sticky;
      top: 0;
      z-index: 1;
    }

    .table-hover tbody tr {
      transition: transform .15s ease, background-color .15s ease, box-shadow .15s ease;
    }

    .table-hover tbody tr:hover {
      background-color: rgba(25, 135, 84, 0.06);
      transform: translateY(-1px);
      box-shadow: 0 6px 16px rgba(25, 135, 84, 0.12);
    }

    .avatar {
      width: 44px; height: 44px;
      border-radius: 50%;
      object-fit: cover;
      border: 2px solid #e9ecef;
      box-shadow: 0 2px 8px rgba(0,0,0,0.06);
    }

    .avatar-fallback {
      width: 44px; height: 44px;
      border-radius: 50%;
      display: inline-flex;
      align-items: center; justify-content: center;
      background: #e8f5ef;
      color: #198754; font-weight: 700;
      border: 2px solid #e9ecef;
      box-shadow: 0 2px 8px rgba(0,0,0,0.06);
      font-size: .9rem;
    }

    .name-cell strong {
      font-weight: 600;
      color: #198754;
    }

    .btn-modern {
      border-radius: 999px;
      padding: 10px 18px;
      transition: transform .2s ease;
    }

    .btn-modern:hover { transform: translateY(-2px); }
  </style>
</head>
<body>

  <div class="container py-5">

    <h1 class="mb-4 text-center border-bottom pb-3">✍️ Daftar Penulis Buku</h1>

    <div class="card glass-card">
      <div class="card-body p-0">
        <div class="table-responsive table-glass">
          <table class="table table-hover table-striped align-middle mb-0">
            <thead class="table-success">
              <tr>
                <th scope="col" style="width: 5%;">#</th>
                <th scope="col" style="width: 28%;">Penulis</th>
                <th scope="col">Biografi (Bio)</th>
                <th scope="col" style="width: 22%;">Foto</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($authors as $author)
                <tr>
                  <th scope="row">{{ $loop->iteration }}</th>
                  <td class="name-cell">
                    <div class="d-flex align-items-center gap-3">
                      @if($author->photo)
                        <img class="avatar" src="{{ asset('storage/'.$author->photo) }}" alt="{{ $author->name }}">
                      @else
                        <div class="avatar-fallback" title="Tidak ada foto">✍️</div>
                      @endif
                      <div>
                        <strong>{{ $author->name }}</strong>
                        @if(!empty($author->nationality))
                          <div class="small text-muted">{{ $author->nationality }}</div>
                        @endif
                      </div>
                    </div>
                  </td>
                  <td class="text-muted small">
                    {{ Str::limit($author->bio, 140) }}
                  </td>
                  <td>
                    @if($author->photo)
                      <span class="badge text-bg-secondary">{{ $author->photo }}</span>
                    @else
                      <span class="text-danger small">N/A</span>
                    @endif
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="4" class="text-center py-5 text-muted">Belum ada data penulis.</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <div class="mt-5 text-center">
      <a href="/books" class="btn btn-modern btn-primary me-2">📖 Lihat Buku</a>
      <a href="/genres" class="btn btn-modern btn-success">📚 Lihat Genre</a>
    </div>

  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
