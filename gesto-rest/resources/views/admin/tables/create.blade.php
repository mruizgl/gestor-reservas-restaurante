<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir Mesas</title>
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" type="text/css">
</head>

<body>
    <header>
        <nav>
            <a href="{{ route('home') }}">Inicio</a>
            <a href="{{ route('reservations.index') }}">Reservas</a>
        </nav>
    </header>
    <br>
    <br>

    <div style="text-align: center; margin-bottom: 20px;">
        <a href="{{ route('admin.dashboard') }}" class="btn-back">← Volver al Panel de Administración</a>
    </div>

    <main>
        <div class="container">
            <h1>Añadir Mesas al Espacio</h1>

            <form method="GET" action="{{ route('tables.create') }}" style="text-align: center; margin-bottom: 20px;">
                <label for="space">Selecciona el Espacio:</label>
                <select name="space_id" id="space">
                    @foreach ($spaces as $space)
                        <option value="{{ $space->id }}" {{ request('space_id') == $space->id ? 'selected' : '' }}>
                            {{ $space->name }} ({{ $space->rows }}x{{ $space->columns }})
                        </option>
                    @endforeach
                </select>
                <button type="submit" class="btn-select">Seleccionar</button>
            </form>

            @if($selectedSpace)
                <form method="POST" action="{{ route('tables.store') }}">
                    @csrf
                    <input type="hidden" name="space_id" value="{{ $selectedSpace->id }}">

                    <div class="grid-container" style="grid-template-columns: repeat({{ $selectedSpace->columns }}, 1fr);">
                        @for($row = 1; $row <= $selectedSpace->rows; $row++)
                            @for($col = 1; $col <= $selectedSpace->columns; $col++)
                                <div class="grid-item">
                                    <label for="table_{{ $row }}_{{ $col }}">
                                        Mesa {{ $row }}-{{ $col }}
                                    </label>
                                    <input type="checkbox" id="table_{{ $row }}_{{ $col }}" name="tables[]" value="{{ $row }}-{{ $col }}">
                                    <select name="capacity[{{ $row }}-{{ $col }}]" disabled>
                                        <option value="" disabled selected>Capacidad</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="6">6</option>
                                        <option value="10">10</option>
                                    </select>
                                </div>
                            @endfor
                        @endfor
                    </div>

                    <button type="submit" class="btn btn-primary">Guardar Mesas</button>
                </form>
            @else
                <p>Por favor, selecciona un espacio para añadir mesas.</p>
            @endif
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

        select {
            width: 100%;
            margin-top: 5px;
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

        .btn-select {
            display: inline-block;
            padding: 10px 20px;
            background-color: #2488C1;
            color: white;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
            margin-left: 10px;
            transition: background-color 0.3s ease;
        }

        .btn-select:hover {
            background-color: #B64C78;
        }
    </style>

    <script>
        document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const select = this.closest('.grid-item').querySelector('select');
                select.disabled = !this.checked;
            });
        });
    </script>
</body>

</html>
