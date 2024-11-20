<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lista de Reservas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/index.css') }}" rel="stylesheet">
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="javascript:history.back()">Inicio</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('reservations.create') }}">Reservar</a>
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

    <main class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="text-center">Lista de Reservas</h1>
            <form method="GET" action="{{ route('reservations.list') }}" class="w-50">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Buscar por nombre o teléfono" value="{{ request('search') }}">
                    <button type="submit" class="btn btn-primary">Buscar</button>
                </div>
            </form>
        </div>

        <h3 class="mb-3">Reservas de Hoy</h3>
        @if ($todaysReservations->isNotEmpty())
            <ul class="list-group mb-4">
                @foreach ($todaysReservations as $reservation)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <strong>{{ $reservation->customer_name }}</strong>
                            <span class="text-muted" style="font-size: 0.9rem;">({{ $reservation->customer_phone }})</span>
                            <br>
                            Hora: {{ \Carbon\Carbon::parse($reservation->reservation_time)->format('H:i') }}
                            <br>
                            Mesa: {{ $reservation->table->id ?? 'N/A' }}
                        </div>
                        <span class="badge bg-secondary">{{ $reservation->num_people }} personas</span>
                    </li>
                @endforeach
            </ul>
        @else
            <div class="alert alert-info text-center">No hay reservas para hoy.</div>
        @endif

        @if($search)
            <h3 class="mt-4">Resultados de Búsqueda</h3>
            @if ($allReservations->isNotEmpty())
                <ul class="list-group">
                    @foreach ($allReservations as $reservation)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <strong>{{ $reservation->customer_name }}</strong>
                                <span class="text-muted" style="font-size: 0.9rem;">({{ $reservation->customer_phone }})</span>
                                <br>
                                Hora: {{ \Carbon\Carbon::parse($reservation->reservation_time)->format('d/m/Y H:i') }}
                                <br>
                                Mesa: {{ $reservation->table->id ?? 'N/A' }}
                            </div>
                            <span class="badge bg-secondary">{{ $reservation->num_people }} personas</span>
                        </li>
                    @endforeach
                </ul>
            @else
                <div class="alert alert-info text-center">No se encontraron resultados para "{{ $search }}".</div>
            @endif
        @endif
    </main>

    <footer class="mt-auto">
        <div class="footer-content text-center py-3 bg-dark text-white">
            <p>&copy; 2024 Gesto-rest. Todos los derechos reservados.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
