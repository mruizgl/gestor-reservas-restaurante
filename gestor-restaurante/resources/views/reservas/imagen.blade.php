<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> Reservas. </title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <header class="bg-blue-800 text-white py-4">
        <h1> Reservas Mesas. </h1>
    </header>

    <main class="container mx-auto my-10">
        <form method="POST" action="{{route('home')}}">
            @csrf
            <textarea class="form-control" placeholder="imagenes"></textarea>
            </br>
            <label for="mesas"> Mesas disponibles: </label>
            <select id="mesas" name="mesas">
            </select>
            </br>
            <label for="fecha"> Hora de reservas disponibles: </label>
            <textarea type="time" placeholder="horasDisponibles"></textarea>
            </br>
            <button type="submit"> Enviar. </button>
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
