<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @extends('layouts.app') 

    @section('content')
        <div class="container">
            <h1>Bienvenido al panel de administración</h1>
            <p>Seleccione una opción para gestionar las reservas o crear nuevos usuarios.</p>

        <div class="list-group">
            <a href="{{ route('reservations.create') }}" class="list-group-item list-group-item-action">
                Gestionar Reservas
            </a>
            <a href="{{ route('admin.createUser') }}" class="list-group-item list-group-item-action">
                Crear Nuevo Usuario
            </a>
        </div>

        </div>
    @endsection
</body>
</html>