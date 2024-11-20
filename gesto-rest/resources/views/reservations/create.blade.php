<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservar Mesa</title>
    <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/png" />
    <style>
        body {
            background: url('{{ asset('images/background2.png') }}') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
            color: #282C59;
        }

        header {
            width: 100%;
            background-color: #0D263F;
            padding: 10px 0;
            text-align: center;
            color: white;
        }

        header nav a {
            color: #F7FAF9;
            text-decoration: none;
            font-size: 18px;
            margin: 0 10px;
        }

        header nav a:hover {
            text-decoration: underline;
        }

        main {
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: flex-start;
            gap: 20px;
            padding: 20px;
            width: 100%;
            max-width: 1200px;
        }

        h1 {
            text-align: center;
            margin-top: 10px;
            margin-bottom: 20px;
        }

        .grid-container {
            display: grid;
            grid-template-columns: repeat(7, 1fr); 
            gap: 5px; 
            background-color: #F7FAF9;
            padding: 10px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            max-width: 600px; 
        }

        .grid-item {
            background-color: #E8F0F2;
            border: 1px solid #2488C1;
            border-radius: 5px;
            text-align: center;
            padding: 5px; 
            transition: transform 0.2s, background-color 0.3s;
            height: 60px; 
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .grid-item:hover {
            background-color: #B64C78;
            color: white;
            transform: translateY(-5px);
        }

        .grid-item input[type="radio"] {
            display: none;
        }

        .grid-item label {
            cursor: pointer;
        }

        .grid-item img {
            width: 30px; 
            height: auto;
            margin-bottom: 2px;
        }

        .reservations-container {
            background-color: #F7FAF9;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            max-height: 500px;
            overflow-y: auto;
        }

        .reservation-item {
            background-color: #E8F0F2;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .reservation-item h3 {
            margin: 0;
            font-size: 1rem;
            color: #282C59;
        }

        .reservation-item p {
            margin: 5px 0;
            font-size: 0.9rem;
            color: #555;
        }

        footer {
            width: 100%;
            background-color: #0D263F;
            color: #F7FAF9;
            text-align: center;
            padding: 10px 0;
            margin-top: auto;
        }

        /* Responsivo */
        @media (max-width: 768px) {
            main {
                flex-direction: column;
                align-items: center;
            }

            .reservations-container {
                width: 90%;
            }

            .grid-container {
                max-width: 100%; 
            }

            .grid-item {
                height: 50px;
            }
        }
    </style>
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

            <!-- Botón de Volver al Panel de Administración -->
            <div style="text-align: center; margin-bottom: 20px;">
                <a href="{{ route('admin.dashboard') }}" class="btn-back">← Volver al Panel de Administración</a>
            </div>

            <form method="POST" action="{{ route('reservations.store') }}">
                @csrf
                <div class="grid-container">
                    @for ($i = 1; $i <= 49; $i++)
                        <div class="grid-item">
                            @php
                                $table = $tables->firstWhere('id', $i);
                            @endphp

                            @if ($table)
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

    <!-- Estilos para el botón de volver -->
    <style>
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
