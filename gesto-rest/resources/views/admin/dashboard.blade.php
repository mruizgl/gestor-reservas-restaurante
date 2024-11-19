<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> Home. </title>
    <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/png"/>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background: url('{{ asset('images/background2.png') }}') no-repeat center center fixed;
            background-size: cover;
            color: #282C59;
            display:grid;
            align-items: center;
            justify-content: center;
        }
    </style>
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
                <br/><br/>
                <a href="{{ route('admin.createUser') }}" class="list-group-item list-group-item-action">
                    Crear Nuevo Usuario
                </a>
                <br/><br/>
                <a href="{{ route('addTables.index')}}" class="list-group-item list-group-item-action">
                    Añadir Mesas
                </a>
            </div>

        </div>
    @endsection
</body>
</html>
