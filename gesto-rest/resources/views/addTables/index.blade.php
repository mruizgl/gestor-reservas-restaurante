<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title> Añadir mesa del día. </title>
        <link href="{{asset('css/app.css')}}" rel="stylesheet" type="text/css">
        <link rel="icon" href="{{asset('images/logo.png')}}" type="image/png" />
        <link rel="icon" href="{{asset('images/favicon.png')}}" type="image/png"/>
    </head>

    <body>
        @extends('layouts.app')

        @section('content')

            <form method="POST">
                @csrf

                <div class="form-container">
                    <h1> Añadir mesa del día. </h1>
                    <label for="zona"> Zona.
                        <select name="zona" id="zona">
                            <option value="interior"> Interior. </option>
                            <option value="terraza"> Terraza. </option>
                        </select>
                    </label>
                    </br>
                    <label for="dia"> Dia.
                        <input type="date" name="dia" id="dia" required>
                    </label>
                    </br>
                    <label for="tamanio_zona"> Tamaño de la zona.
                        <select name="capacidad" id="capacidad">
                            <option value="16">4x4</option>
                            <option value="25">5x5</option>
                            <option value="36">6x6</option>
                        </select>
                    </label>
                    <button type="submit" style="margin-top: 20px;"> Atras. </button>
                    <button type="submit" style="margin-top: 20px;"> Añadir. </button>
                </div>
            </form>
        @endsection

    </body>

</html>
