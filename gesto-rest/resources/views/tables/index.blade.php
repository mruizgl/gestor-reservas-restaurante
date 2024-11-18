<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div class="grid grid-cols-4 gap-4">
        @foreach ($tables as $table)
            <div class="border p-4 text-center">
                <img src="/images/tables/{{ $table->id }}.jpg" alt="Mesa {{ $table->name }}" class="w-full h-32 object-cover">
                <h3>Mesa {{ $table->name }}</h3>
                <p>Capacidad: {{ $table->capacity }} personas</p>
                <a href="{{ route('reservations.create', ['table' => $table->id]) }}" class="btn btn-primary">Reservar</a>
            </div>
        @endforeach
    </div>    
</body>
</html>