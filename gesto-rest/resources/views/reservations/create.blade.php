<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @extends('layouts.app')

    @section('content')
        <h1>Reservar Mesa</h1>
        
        <form action="{{ route('reservations.store') }}" method="POST">
            @csrf
    
            <div class="grid-container" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 20px;">
                @foreach ($tables as $table)
                    <label>
                        <input type="radio" name="table_id" value="{{ $table->id }}" required>
                        <div style="border: 1px solid #ccc; padding: 10px; text-align: center;">
                            <img src="{{ asset('images/' . $table->capacity . '.png') }}" 
                                 alt="Mesa de {{ $table->capacity }} personas" 
                                 style="width: 100px; height: 100px;">
                            <p>Mesa {{ $table->id }}</p> 
                            <p>Capacidad: {{ $table->capacity }} personas</p>
                        </div>
                    </label>
                @endforeach
            </div>
    
            <div>
                <label for="customer_name">Nombre del Cliente:</label>
                <input type="text" name="customer_name" id="customer_name" required>
    
                <label for="customer_phone">Teléfono del Cliente:</label>
                <input type="text" name="customer_phone" id="customer_phone" required>
    
                <label for="num_people">Número de Personas:</label>
                <input type="number" name="num_people" id="num_people" required min="1">
                
                <label for="reservation_time">Fecha y Hora de la Reserva:</label>
                <input type="datetime-local" name="reservation_time" id="reservation_time" required>
            </div>
    
            <button type="submit" style="margin-top: 20px;">Reservar</button>
        </form>
    @endsection
</body>
</html>
