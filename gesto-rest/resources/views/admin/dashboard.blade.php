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
</head>

<body>
    <header>
        <nav>
            <a href="{{ route('home') }}">Inicio</a>
            <a href="{{ route('reservations.index') }}">Reservas</a>
        </nav>
    </header>

    <main>
        <div class="container">
            <h1>Bienvenido al panel de administración</h1>
            <p>Seleccione una opción para gestionar las reservas o crear nuevos usuarios.</p>

            <div class="list-group">
                <div class="list-group">
                    <a href="{{ route('spaces.create') }}" class="list-group-item">1. Crear Espacio</a> 
                    <a href="{{ route('tables.create') }}" class="list-group-item">2. Añadir Mesas</a>
                    <a href="{{ route('reservations.create') }}" class="list-group-item">3. Gestionar Reservas</a>
                    <a href="{{ route('admin.createUser') }}" class="list-group-item">4. Crear Nuevo Empleado</a>
                    
                    
                </div>
            </div>
        </div>
    </main>

    <footer>
        <p>&copy; 2024 Gesto-rest. Todos los derechos reservados.</p>
    </footer>
</body>

</html>
