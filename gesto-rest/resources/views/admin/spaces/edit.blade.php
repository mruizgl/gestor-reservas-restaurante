<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Espacio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <header class="bg-dark text-white p-3 text-center">
        <h1>Editar Espacio</h1>
        <a href="{{ route('spaces.index') }}" class="btn btn-secondary mt-3">← Volver a la Lista de Espacios</a>
    </header>

    <main class="container mt-4">
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
        <form action="{{ route('spaces.update', $space->id) }}" method="POST" class="form-limited">
            @csrf
            @method('PUT')

            <div class="form-group mb-3">
                <label for="name">Nombre del Espacio:</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ $space->name }}" required>
            </div>

            <div class="form-group mb-3">
                <label for="rows">Número de Filas:</label>
                <input type="number" id="rows" name="rows" class="form-control" value="{{ $space->rows }}" required min="1">
            </div>

            <div class="form-group mb-3">
                <label for="columns">Número de Columnas:</label>
                <input type="number" id="columns" name="columns" class="form-control" value="{{ $space->columns }}" required min="1">
            </div>

            <div class="form-group mb-3">
                <label for="description">Descripción:</label>
                <textarea id="description" name="description" class="form-control">{{ $space->description }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Actualizar Espacio</button>
        </form>
    </main>

    <footer class="bg-dark text-white text-center py-3 mt-4">
        <p>&copy; 2024 Gesto-rest. Todos los derechos reservados.</p>
    </footer>
</body>

</html>
