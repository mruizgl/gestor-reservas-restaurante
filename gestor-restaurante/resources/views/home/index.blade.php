<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <title> Home. </title>
    <meta name="author" content="Melissa Ruiz González y Noelia Hernández Domínguez">
</head>

<body>

    <header class="bg-blue-800 text-white py-4">
        <h1> Home. </h1>
    </header>

    <main class="container mx-auto my-10">
        <form> <!--  method="post" action="{{route('home')}}" -->
            <div class="flex flex-col items-center space-y-6">
                <p class="text-xl text-gray-700"> Elige una opción para continuar: </p>
                </br>
                <div class="flex space-x-4">
                    <a href="{{route('crearEmpleados.index')}}" class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-lg">
                        Crear nuevos usuarios.
                    </a>
                    </br>
                    </br>
                    <a href="{{route('reservas.index')}}" class="bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded-lg">
                        Editar reservas.
                    </a>
                </div>
            </div>
        </form>
    </main>

    <footer class="bg-blue-800 text-white py-4">
        <div class="container mx-auto text-center">
            <p> &copy; {{date('Y')}}. Gestión de Restaurante. Todos los derechos reservados. </p>
        </div>
    </footer>

</body>

</html>
