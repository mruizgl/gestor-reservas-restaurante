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

    <main>
        <div class="container">
            <h1 class="text-center mb-4">Reservar Mesa</h1>

            <div class="row">
                <div class="col-md-7">
 
                    <form method="GET" action="{{ route('admin.reservations.create') }}">
                        <label for="space">Selecciona el Espacio:</label>
                        <select name="space" id="space" onchange="this.form.submit()" class="form-select mb-3">
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
                                    $table = $tables->first(function ($table) use ($row, $col) {
                                        return $table->row == $row && $table->column == $col;
                                    });
                                @endphp
                                <div class="grid-item">
                                    @if($table)
                                        <input type="radio" name="table_id" id="table_{{ $table->id }}" value="{{ $table->id }}" required>
                                        <label for="table_{{ $table->id }}">
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

                    <form method="POST" action="{{ route('reservations.store') }}" class="mt-4">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="customer_name">Nombre del Cliente:</label>
                            <input type="text" id="customer_name" name="customer_name" class="form-control" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="customer_phone">Teléfono del Cliente:</label>
                            <input type="text" id="customer_phone" name="customer_phone" class="form-control" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="num_people">Número de Personas:</label>
                            <input type="number" id="num_people" name="num_people" class="form-control" min="1" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="reservation_time">Fecha y Hora de la Reserva:</label>
                            <input type="datetime-local" id="reservation_time" name="reservation_time" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Reservar</button>
                    </form>
                </div>

                <div class="col-md-5">
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
