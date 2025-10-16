<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Genre Buku</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(135deg, #eef2f3, #d9e4f5);
      min-height: 100vh;
      font-family: 'Poppins', sans-serif;
    }

    h1 {
      font-weight: 700;
      color: #0d6efd;
    }

    .card {
      border: none;
      border-radius: 1rem;
      backdrop-filter: blur(12px);
      background: rgba(255, 255, 255, 0.7);
      transition: all 0.3s ease;
    }

    .card:hover {
      transform: translateY(-6px);
      box-shadow: 0 10px 20px rgba(13, 110, 253, 0.15);
    }

    .card-title {
      font-weight: 600;
      color: #0d6efd;
    }

    .card-text {
      color: #6c757d;
      font-size: 0.9rem;
    }

    .btn-modern {
      border-radius: 50px;
      padding: 10px 24px;
      transition: all 0.3s ease;
    }

    .btn-modern:hover {
      transform: translateY(-2px);
    }

    .footer-links a {
      text-decoration: none;
      font-weight: 500;
      color: #0d6efd;
    }

    .footer-links a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>

  <div class="container py-5">
    <h1 class="mb-4 text-center border-bottom pb-3">📚 Daftar Genre Buku</h1>

    <div class="row row-cols-1 row-cols-md-3 g-4">
      @foreach ($genres as $genre)
        <div class="col">
          <div class="card h-100 p-3 shadow-sm">
            <div class="card-body">
              <h5 class="card-title">{{ $genre->name }}</h5>
              <p class="card-text">{{ $genre->description }}</p>
            </div>
          </div>
        </div>
      @endforeach
    </div>

    <div class="mt-5 text-center">
      <a href="/books" class="btn btn-modern btn-primary me-2">📖 Lihat Buku</a>
      <a href="/authors" class="btn btn-modern btn-success">✍️ Lihat Penulis</a>
    </div>

  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
