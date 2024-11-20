<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Crear Espacio</title>
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
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
            <h1>Crear Espacio</h1>

            <!-- Mensajes de validación -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('spaces.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="name">Nombre del Espacio:</label>
                    <input type="text" id="name" name="name" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="rows">Número de Filas:</label>
                    <input type="number" id="rows" name="rows" class="form-control" required min="1">
                </div>

                <div class="form-group">
                    <label for="columns">Número de Columnas:</label>
                    <input type="number" id="columns" name="columns" class="form-control" required min="1">
                </div>

                <div class="form-group">
                    <label for="description">Descripción (Opcional):</label>
                    <textarea id="description" name="description" class="form-control"></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Crear Espacio</button>
            </form>
        </div>
    </main>

    <footer>
        <p>&copy; 2024 Gesto-rest. Todos los derechos reservados.</p>
    </footer>
</body>

</html>
