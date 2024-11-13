<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <title> Reservas. </title>
    <meta name="author" content="Melissa Ruiz González y Noelia Hernández Domínguez">
</head>

<body>

    <header class="bg-blue-800 text-white py-4">
        <h1> Reservas. </h1>
    </header>

    <main class="container mx-auto my-10">
        <form method="POST" action="{{route('imagen')}}">
            @csrf
            <label for="fecha"> Fecha reserva: </label>
            <input type="date" id="fecha" name="fecha" required>
            </br>
            <label for="numeroOcupantes"> Numero ocupantes: </label>
            <input type="number" id="numeroOcupantes" name="numeroOcupantes" min="1" max="6" required>
            </br>
            <label for="nombre"> Nombre: </label>
            <input type="text" id="nombre" name="nombre" required>
            </br>
            <label for="telefono"> Telefono: </label>
            <input type="text" id="telefono" name="telefono" required>
            </br>
            <label for="zona"> Zona: </label>
            <select name="zona" id="zona">
                <option> Interior </option>
                <option> Terraza </option>
            </select>
            </br>
            <button type="submit"> Pagina Canvas. </button>
            </br>
            @if ($errors->any())
                <div>
                    <strong> Error. </strong>
                </div>
            @endif
        </form>
    </main>

    <footer class="bg-blue-800 text-white py-4">
        <div class="container mx-auto text-center">
            <p>&copy; {{date('Y')}}. Gestión de Restaurante. Todos los derechos reservados.</p>
        </div>
    </footer>

</body>

</html>
