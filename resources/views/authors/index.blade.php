<!DOCTYPE html>
<html>
<head>
    <title>Daftar Penulis</title>
</head>
<body>
    <h1>Daftar Penulis Buku</h1>
    <ul>
        @foreach ($authors as $author)
            <li>
                <strong>{{ $author['name'] }}</strong><br>
                {{ $author['bio'] }}
            </li>
        @endforeach
    </ul>
</body>
</html>