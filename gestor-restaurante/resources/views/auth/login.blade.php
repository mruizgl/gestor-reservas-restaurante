<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Login. </title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <header class="bg-blue-800 text-white py-4">
        <h1> Iniciar Sesión. </h1>
    </header>

    <main class="container mx-auto my-10">
        <form method="POST" action="{{route('login')}}">
            @csrf
            <label for="email"> Correo Electrónico: </label>
            <input type="email" id="email" name="email" required>
            </br>
            <label for="password"> Contraseña: </label>
            <input type="password" id="password" name="password" required>
            </br>
            <button type="submit"> Iniciar Sesión. </button>
            </br>
            @if ($errors->any())
                <div>
                    <strong>Error:</strong> Las credenciales no son válidas.
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
