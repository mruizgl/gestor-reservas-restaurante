<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title> Formulario. </title>
    <meta name="author" content="Melissa Ruiz González y Noelia Hernández Domínguez">
</head>

<body>

    <header class="bg-blue-800 text-white py-4">
        <h1> Formulario de Registro. </h1>
    </header>

    <main class="container mx-auto my-10">
        <form method="POST" action="{{route('formulario')}}">
            @csrf
            <label for="name"> Nombre: </label>
            <input type="text" id="name" name="name" required>
            </br>
            <label for="email"> Correo Electrónico: </label>
            <input type="email" id="email" name="email" required>
            </br>
            <label for="password"> Contraseña: </label>
            <input type="password" id="password" name="password" required>
            </br>
            <label for="role"> Rol: </label>
            <select name="role" id="role">
                <option> Admin </option>
                <option> Empleado </option>
            </select>
            </br>
            <button type="submit"> Añadir. </button>
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
