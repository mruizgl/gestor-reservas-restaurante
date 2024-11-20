<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservar Mesa</title>
    <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/png" />
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ auth()->user()->role === 'admin' ? route('admin.dashboard') : route('reservations.create') }}">
                    <img src="{{ asset('images/looblanco2.png') }}" alt="Logo" height="40"> <small> Gesto-Rest</small>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('reservations.index') }}">Reservas</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <br>
    <br>

    <div><h1 class="text-center mb-4">Reservar Mesa</h1></div>

    <main class="container mt-4">
        

        <div class="row">
            <div class="col-md-8">
                <form method="GET" action="{{ route('admin.reservations.create') }}" class="mb-3">
                    <label for="space">Selecciona el Espacio:</label>
                    <select name="space" id="space" onchange="this.form.submit()" class="form-select">
                        @foreach ($spaces as $space)
                            <option value="{{ $space->name }}" {{ $selectedSpace == $space->name ? 'selected' : '' }}>
                                {{ $space->name }}
                            </option>
                        @endforeach
                    </select>
                </form>
                

                <div class="grid-container" style="grid-template-columns: repeat({{ $selectedSpaceObject->columns }}, 1fr);">
                    @for($row = 1; $row <= $selectedSpaceObject->rows; $row++)
                        @for($col = 1; $col <= $selectedSpaceObject->columns; $col++)
                            @php
                                $table = $tables->filter(function($table) use ($row, $col) {
                                    return $table->row == $row && $table->column == $col;
                                })->first();
                            @endphp
                            <div class="grid-item">
                                @if($table)
                                    <label>
                                        <input type="radio" name="table_id" value="{{ $table->id }}" 
                                               form="reservation-form" required>
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
                

                <form method="POST" action="{{ route('reservations.store') }}" id="reservation-form" class="mt-4">
                    @csrf
                    <div class="form-container">
                        <label for="customer_name">Nombre del Cliente:</label>
                        <input type="text" id="customer_name" name="customer_name" class="form-control" required>
                
                        <label for="customer_phone">Teléfono del Cliente:</label>
                        <input type="text" id="customer_phone" name="customer_phone" class="form-control" required>
                
                        <label for="num_people">Número de Personas:</label>
                        <input type="number" id="num_people" name="num_people" class="form-control" required min="1">
                
                        <label for="reservation_time">Fecha y Hora de la Reserva:</label>
                        <input type="datetime-local" id="reservation_time" name="reservation_time" class="form-control" required>
                
 
                        <button type="submit" class="btn btn-primary mt-3">Reservar</button>
                    </div>
                </form>
            </div>


            <div class="col-md-4">
                <div class="reservations-container">
                    <h2>Reservas del Día</h2>
                    @forelse ($reservations as $reservation)
                        <div class="reservation-item">
                            <h3>{{ $reservation->customer_name }}</h3>
                            <p>Teléfono: <span>{{ $reservation->customer_phone }}</span></p>
                            <p>Hora: {{ \Carbon\Carbon::parse($reservation->reservation_time)->format('H:i') }}</p>
                            <p>Personas: {{ $reservation->num_people }}</p>
                        </div>
                    @empty
                        <p>No hay reservas para el día de hoy.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </main>

    <footer class="text-center mt-4">
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

        .reservations-container {
            background-color: #F7FAF9;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            max-height: 400px;
            overflow-y: auto;
        }

        .reservation-item {
            background-color: #E8F0F2;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .form-container label {
            font-weight: bold;
        }

        .form-container input, .form-container button {
            width: 100%;
        }

        .btn-back {
            display: inline-block;
            padding: 10px 20px;
            background-color: #2488C1;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 1rem;
        }

        .btn-back:hover {
            background-color: #B64C78;
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
