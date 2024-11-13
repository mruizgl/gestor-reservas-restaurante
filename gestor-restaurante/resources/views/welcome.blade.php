<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <title> Gestión de Restaurante. </title>
    <meta name="author" content="Melissa Ruiz González y Noelia Hernández Domínguez">
</head>

<body>

    <header class="bg-blue-800 text-white py-4">
        <div class="container mx-auto text-center">
            <h1 class="text-4xl font-bold"> Bienvenido a la Gestión del Restaurante. </h1>
        </div>
    </header>

    <main class="container mx-auto my-10">
        <div class="flex flex-col items-center space-y-6">
            <p class="text-xl text-gray-700"> Elige una opción para continuar: </p>
            </br>
            <div class="flex space-x-4">
                <a href="{{route('login')}}" class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-lg">
                    Iniciar Sesión.
                </a>
                </br>
                </br>
                <a href="{{route('reservas.index')}}" class="bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded-lg">
                    Ver reservas.
                </a>
            </div>
        </div>
    </main>

    <footer class="bg-blue-800 text-white py-4">
        <div class="container mx-auto text-center">
            <p> &copy; {{date('Y')}}. Gestión de Restaurante. Todos los derechos reservados. </p>
        </div>
    </footer>

</body>

</html>
