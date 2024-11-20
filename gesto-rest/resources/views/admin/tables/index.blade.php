<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/png"/>
</head>
<body>
    <div class="grid grid-cols-4 gap-4">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @elseif (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @foreach ($tables as $table)
            <div class="border p-4 text-center">
                <img src="/images/tables/{{ $table->id }}.jpg" alt="Mesa {{ $table->ubication }}" class="w-full h-32 object-cover">
                <h3>Ubicacion: {{ $table->ubication }}</h3>
                <p>Capacidad: {{ $table->capacity }} personas</p>
                <a href="{{ route('reservations.create', ['table' => $table->id]) }}" class="btn btn-primary">Reservar</a>
            </div>
        @endforeach
    </div>    
</body>
</html>