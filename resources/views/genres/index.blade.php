<!DOCTYPE html>
<html>
<head>
    <title>Daftar Genre</title>
</head>
<body>
    <h1>Daftar Genre Buku</h1>
    <ul>
        @foreach ($genres as $genre)
            <li>
                <strong>{{ $genre['name'] }}</strong><br>
                {{ $genre['description'] }}
            </li>
        @endforeach
    </ul>
</body>
</html>