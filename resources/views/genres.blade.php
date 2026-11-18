
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Genre</title>

<link rel='stylesheet' href='{{ asset('css/persona5.css') }}'>
</head>
<body>
@include('partials.user-navbar')
    <h1>Daftar Genre</h1>

    <ul>
        @foreach ($genres as $genre)
            <li>{{ $genre['name'] }}</li>
        @endforeach
    </ul>
    @include('partials.music-player')
</body>
</html>


