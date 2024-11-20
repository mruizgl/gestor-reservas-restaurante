<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Espacios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ auth()->user()->role === 'admin' ? route('admin.dashboard') : route('reservations.create') }}">
                    <img src="{{ asset('images/looblanco2.png') }}" alt="Logo" height="40"> <small>Gesto-Rest</small>
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

    <h1 class="text-center">Gestión de Espacios</h1>
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

    <div style="text-align: center; margin-bottom: 20px;">
        <a href="{{ route('admin.dashboard') }}" >← Volver al Panel de Administración</a>
    </div>

    

    <main class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            
            <a href="{{ route('spaces.create') }}" class="btn btn-primary">Crear Espacio</a>
        </div>


        @if ($spaces->isEmpty())
            <div class="alert alert-info text-center">No hay espacios registrados.</div>
        @else
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Filas</th>
                        <th>Columnas</th>
                        <th>Descripción</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($spaces as $space)
                        <tr>
                            <td>{{ $space->id }}</td>
                            <td>{{ $space->name }}</td>
                            <td>{{ $space->rows }}</td>
                            <td>{{ $space->columns }}</td>
                            <td>{{ $space->description }}</td>
                            <td>
                                <a href="{{ route('spaces.edit', $space->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                <form action="{{ route('spaces.destroy', $space->id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Está seguro que desea eliminar este espacio? Esto eliminará las mesas asociadas en cascada');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </main>
    

    <footer class="bg-dark text-white text-center py-3 mt-4">
        <p>&copy; 2024 Gesto-Rest. Todos los derechos reservados.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
