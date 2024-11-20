<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservar Mesa</title>
    <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/png" />
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" type="text/css">
</head>

<body>
    <header>
        <nav>
            <a href="{{ route('home') }}">Inicio</a>
            <a href="{{ route('reservations.index') }}">Reservas</a>
        </nav>
    </header>

    <main>
        <div>
            <h1>Reservar Mesa</h1>

            <div style="text-align: center; margin-bottom: 20px;">
                <a href="{{ route('admin.dashboard') }}" class="btn-back">← Volver al Panel de Administración</a>
            </div>

            <form method="GET" action="{{ route('reservations.create') }}">
                <label for="space">Selecciona el Espacio:</label>
                <select name="space" id="space" onchange="this.form.submit()">
                    @foreach ($spaces as $space)
                        <option value="{{ $space->name }}" {{ $selectedSpace == $space->name ? 'selected' : '' }}>
                            {{ $space->name }}
                        </option>
                    @endforeach
                </select>
            </form>

            <form method="POST" action="{{ route('reservations.store') }}">
                @csrf
                <div class="grid-container" style="grid-template-columns: repeat({{ $selectedSpaceObject->columns }}, 1fr);">
                    @for($row = 1; $row <= $selectedSpaceObject->rows; $row++)
                        @for($col = 1; $col <= $selectedSpaceObject->columns; $col++)
                            @php
                                $table = $tables->firstWhere('row', $row)?->firstWhere('column', $col);
                            @endphp
                            <div class="grid-item">
                                @if($table)
                                    <label>
                                        <input type="radio" name="table_id" value="{{ $table->id }}" required>
                                        <img src="{{ asset('images/' . $table->capacity . '.png') }}" alt="Mesa">
                                        <p>Mesa {{ $table->id }}</p>
                                    </label>
                                @else
                                    <p>Vacío</p>
                                @endif
                            </div>
                        @endfor
                    @endfor
                </div>
                

                <div class="form-container">
                    <label for="customer_name">Nombre del Cliente:</label>
                    <input type="text" id="customer_name" name="customer_name" required>

                    <label for="customer_phone">Teléfono del Cliente:</label>
                    <input type="text" id="customer_phone" name="customer_phone" required>

                    <label for="num_people">Número de Personas:</label>
                    <input type="number" id="num_people" name="num_people" required min="1">

                    <label for="reservation_time">Fecha y Hora de la Reserva:</label>
                    <input type="datetime-local" id="reservation_time" name="reservation_time" required>

                    <button type="submit">Reservar</button>
                </div>
            </form>
        </div>

        <div class="reservations-container">
            <h2>Reservas del Día</h2>
            @foreach ($reservations as $reservation)
                <div class="reservation-item">
                    <h3>{{ $reservation->customer_name }}</h3>
                    <p>Hora: {{ $reservation->reservation_time }}</p>
                    <p>Personas: {{ $reservation->num_people }}</p>
                </div>
            @endforeach
        </div>
    </main>

    <footer>
        <p>&copy; 2024 Gesto-rest. Todos los derechos reservados.</p>
    </footer>

    <style>
        .grid-container {
            display: grid;
            gap: 10px;
            background-color: #f7f7f7;
            padding: 10px;
            border-radius: 10px;
        }

        .grid-item {
            background-color: #e8e8e8;
            border: 1px solid #ccc;
            padding: 10px;
            text-align: center;
            border-radius: 5px;
        }

        .btn-back {
            display: inline-block;
            padding: 10px 20px;
            background-color: #2488C1;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 1rem;
            transition: background-color 0.3s ease;
        }

        .btn-back:hover {
            background-color: #B64C78;
        }
    </style>
</body>

</html>
