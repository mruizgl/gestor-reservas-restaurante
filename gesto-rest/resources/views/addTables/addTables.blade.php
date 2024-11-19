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
                </br>
                <table>
                    <th>
                        @for ($i = 1; $i <= 10; $i++)
                            <label for="table_{{ $i }}"> Mesa {{ $i }}</label>
                            <select name="capacidad" id="capacidad">
                                <option value="2">2</option>
                                <option value="4">4</option>
                                <option value="6">6</option>
                                <option value="8">8</option>
                                <option value="10">10</option>
                            </select>
                        @endfor
                    </th>
            </table>
            <button type="submit" style="margin-top: 20px;"> Atras. </button>
            <button type="submit" style="margin-top: 20px;"> Añadir. </button>
            </div>
        </form>
        @endsection

    </body>

</html>
