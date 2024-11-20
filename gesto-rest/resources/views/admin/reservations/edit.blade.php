<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Reserva</title>
    <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/png" />
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
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

    <div><h1 class="text-center mb-4">Editar Reserva</h1></div>

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

    <main class="container mt-4">
        <div class="form-limited">
            <form  method="POST" action="{{ route('reservations.update', $reservation->id) }}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="customer_name" class="form-label">Nombre del Cliente:</label>
                    <input type="text" id="customer_name" name="customer_name" class="form-control" value="{{ $reservation->customer_name }}" required>
                </div>

                <div class="mb-3">
                    <label for="customer_phone" class="form-label">Teléfono del Cliente:</label>
                    <input type="text" id="customer_phone" name="customer_phone" class="form-control" value="{{ $reservation->customer_phone }}" required>
                </div>

                <div class="mb-3">
                    <label for="num_people" class="form-label">Número de Personas:</label>
                    <input type="number" id="num_people" name="num_people" class="form-control" value="{{ $reservation->num_people }}" required min="1">
                </div>

                <div class="mb-3">
                    <label for="reservation_time" class="form-label">Fecha y Hora de la Reserva:</label>
                    <input type="datetime-local" id="reservation_time" name="reservation_time" class="form-control" value="{{ \Carbon\Carbon::parse($reservation->reservation_time)->format('Y-m-d\TH:i') }}" required>
                </div>

                <div class="mb-3">
                    <label for="table_id" class="form-label">Mesa:</label>
                    <select id="table_id" name="table_id" class="form-select" required>
                        @foreach ($tables as $table)
                            <option value="{{ $table->id }}" {{ $reservation->table_id == $table->id ? 'selected' : '' }}>Mesa {{ $table->id }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-primary w-100">Actualizar Reserva</button>
                <a onclick="window.history.back()" class="btn btn-secondary w-100 mt-2">Cancelar</a>
            </form>
        </div>
    </main>

    <footer class="text-center mt-4">
        <p>&copy; 2024 Gesto-rest. Todos los derechos reservados.</p>
    </footer>

    <style>
        .form-limited {
            max-width: 500px;
            margin: 0 auto;
            background-color: #f7f7f7;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .btn-primary {
            background-color: #2488C1;
            border-color: #2488C1;
        }

        .btn-primary:hover {
            background-color: #B64C78;
            border-color: #B64C78;
        }

        footer {
            width: 100%;
            background-color: #0D263F;
            color: #F7FAF9;
            text-align: center;
            padding: 10px 0;
            margin-top: auto;
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
