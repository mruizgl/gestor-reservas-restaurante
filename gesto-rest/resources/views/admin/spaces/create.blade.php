<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Crear Espacio</title>
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ auth()->user()->role === 'admin' ? route('admin.dashboard') : route('reservations.create') }}">
                    <img src="{{ asset('images/looblanco2.png') }}" alt="Logo" height="40"> <small> Gesto-Rest
                        
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
    <div style="text-align: center; margin-bottom: 20px;">
        <a href="{{ route('admin.dashboard') }}" >← Volver al Panel de Administración</a>
    </div>

    <main>
        <div class="container">
            <h1 class="text-center">Crear Espacio</h1>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('spaces.store') }}" method="POST" class="form-limited">
                @csrf

                <div class="form-group mb-3">
                    <label for="name">Nombre del Espacio:</label>
                    <input type="text" id="name" name="name" class="form-control" required>
                </div>

                <div class="form-group mb-3">
                    <label for="rows">Número de Filas:</label>
                    <input type="number" id="rows" name="rows" class="form-control" required min="1">
                </div>

                <div class="form-group mb-3">
                    <label for="columns">Número de Columnas:</label>
                    <input type="number" id="columns" name="columns" class="form-control" required min="1">
                </div>

                <div class="form-group mb-3">
                    <label for="description">Descripción (Opcional):</label>
                    <textarea id="description" name="description" class="form-control"></textarea>
                </div>

                <button type="submit" class="btn-back">Crear Espacio</button>
            </form>
        </div>
        
    </main>

    <buatton onclick="window.history.back()">← Volver</a>


    <footer class="wrapper">
        <p>&copy; 2024 Gesto-rest. Todos los derechos reservados.</p>
    </footer>

    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
