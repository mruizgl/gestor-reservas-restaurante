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
        <h1>Gestionar Reservas</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre Cliente</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reservas as $reserva)
                    <tr>
                        <td>{{ $reserva->id }}</td>
                        <td>{{ $reserva->cliente }}</td>
                        <td>{{ $reserva->fecha }}</td>
                        <td>{{ $reserva->hora }}</td>
                        <td>
                            <a href="#" class="btn btn-info">Ver</a>
                            <a href="#" class="btn btn-danger">Eliminar</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

</body>
</html>
