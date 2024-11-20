<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Panel de Administración</title>
    <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/png" />
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
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

    <main>
        <div class="container">
            <h1>Bienvenido al panel de administración</h1>
            <p>Seleccione la opción que desea gestionar:</p>

            <div class="list-group">
                <div class="list-group">
                    <a href="{{ route('spaces.index') }}" class="list-group-item">1. Espacios</a> 
                    <a href="{{ route('tables.create') }}" class="list-group-item">2. Mesas</a>
                    <a href="{{ route('reservations.create') }}" class="list-group-item">3. Reservas</a>
                    <a href="{{ route('admin.users.index') }}" class="list-group-item">4. Empleados</a>
                    
                    
                </div>
            </div>
        </div>
    </main>

    <footer>
        <p>&copy; 2024 Gesto-rest. Todos los derechos reservados.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
