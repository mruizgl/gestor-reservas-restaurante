<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reservar mesa</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">
    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png" />
    <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/png"/>
</head>
<body>
    @extends('layouts.app')

    @section('content')
        <h1>Reservar Mesa</h1>
        <br>
        
        <form action="{{ route('reservations.store') }}" method="POST">
            @csrf
    
            <div class="grid-container">
                @for ($i = 1; $i <= 16; $i++) 
                    <div class="grid-item">
                        @php
                            $table = $tables->firstWhere('id', $i); 
                        @endphp
                        
                        @if ($table) 
                            <label>
                                <input type="radio" name="table_id" value="{{ $table->id }}" required>
                                <div class="table-info">
                                    <img src="{{ asset('images/' . $table->capacity . '.png') }}" 
                                         alt="Mesa de {{ $table->capacity }} personas">
                                    <p>Mesa {{ $table->id }}</p> 
                                </div>
                            </label>
                        @else 
                            <p>Sin mesa</p>
                        @endif
                    </div>
                @endfor
            </div>
            <br>
            
            <div class="form-container">
                <label for="customer_name">Nombre del Cliente:</label>
                <input type="text" name="customer_name" id="customer_name" required>
    
                <label for="customer_phone">Teléfono del Cliente:</label>
                <input type="text" name="customer_phone" id="customer_phone" required>
    
                <label for="num_people">Número de Personas:</label>
                <input type="number" name="num_people" id="num_people" required min="1">
                
                <label for="reservation_time">Fecha y Hora de la Reserva:</label>
                <input type="datetime-local" name="reservation_time" id="reservation_time" required>
                <button type="submit" style="margin-top: 20px;">Reservar</button>

            </div>
    
        </form>
    @endsection
</body>
</html>
