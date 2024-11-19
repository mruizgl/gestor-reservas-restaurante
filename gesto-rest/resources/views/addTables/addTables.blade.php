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

            <form method="POST">
                @csrf

                <div class="form-container">
                <h1> Añadir mesa del día. </h1>
                <table>
                    <tr>
                        @if ($capacidad == 16)
                            @for ($i = 1; $i <= $capacidad/2; $i++)
                            <th>
                                <label for="table_{{ $i }}"> Mesa {{ $i }}</label>
                                <select name="capacidadMesa" id="capacidadMesa">
                                    <option value="2"> 2 </option>
                                    <option value="4"> 4 </option>
                                    <option value="6"> 6 </option>
                                    <option value="8"> 8 </option>
                                    <option value="10"> 10 </option>
                                </select>
                            </th>
                            @endfor
                        </tr>
                        <tr>
                            @for ($i = ($capacidad/2)+1; $i <= $capacidad; $i++)
                            <th>
                                <label for="table_{{ $i }}"> Mesa {{ $i }}</label>
                                <select name="capacidadMesa" id="capacidadMesa">
                                    <option value="2"> 2 </option>
                                    <option value="4"> 4 </option>
                                    <option value="6"> 6 </option>
                                    <option value="8"> 8 </option>
                                    <option value="10"> 10 </option>
                                </select>
                            </th>
                            @endfor
                        @elseif ($capacidad == 25)
                        @for ($i = 1; $i < $capacidad/2; $i++)
                        <th>
                            <label for="table_{{ $i }}"> Mesa {{ $i }}</label>
                            <select name="capacidadMesa" id="capacidadMesa">
                                <option value="2"> 2 </option>
                                <option value="4"> 4 </option>
                                <option value="6"> 6 </option>
                                <option value="8"> 8 </option>
                                <option value="10"> 10 </option>
                            </select>
                        </th>
                        @endfor
                    </tr>
                    <tr>
                        @for ($i = ($capacidad/2)+0.5; $i <= $capacidad; $i++)
                        <th>
                            <label for="table_{{ $i }}"> Mesa {{ $i }}</label>
                            <select name="capacidadMesa" id="capacidadMesa">
                                <option value="2"> 2 </option>
                                <option value="4"> 4 </option>
                                <option value="6"> 6 </option>
                                <option value="8"> 8 </option>
                                <option value="10"> 10 </option>
                            </select>
                        </th>
                        @endfor
                        @else
                        @for ($i = 1; $i < $capacidad/3; $i++)
                        <th>
                            <label for="table_{{ $i }}"> Mesa {{ $i }}</label>
                            <select name="capacidadMesa" id="capacidadMesa">
                                <option value="2"> 2 </option>
                                <option value="4"> 4 </option>
                                <option value="6"> 6 </option>
                                <option value="8"> 8 </option>
                                <option value="10"> 10 </option>
                            </select>
                        </th>
                        @endfor
                    </tr>
                    <tr>
                        @for ($i = $capacidad/3; $i < ($capacidad/3)+($capacidad/3); $i++)
                        <th>
                            <label for="table_{{ $i }}"> Mesa {{ $i }}</label>
                            <select name="capacidadMesa" id="capacidadMesa">
                                <option value="2"> 2 </option>
                                <option value="4"> 4 </option>
                                <option value="6"> 6 </option>
                                <option value="8"> 8 </option>
                                <option value="10"> 10 </option>
                            </select>
                        </th>
                        @endfor
                        <tr>
                            @for ($i = ($capacidad/3)+($capacidad/3); $i <= $capacidad; $i++)
                            <th>
                                <label for="table_{{ $i }}"> Mesa {{ $i }}</label>
                                <select name="capacidadMesa" id="capacidadMesa">
                                    <option value="2"> 2 </option>
                                    <option value="4"> 4 </option>
                                    <option value="6"> 6 </option>
                                    <option value="8"> 8 </option>
                                    <option value="10"> 10 </option>
                                </select>
                            </th>
                            @endfor
                        </tr>
                        @endif


                    </tr>
            </table>
            <button type="submit" style="margin-top: 20px;"> Atras. </button>
            <button type="submit" style="margin-top: 20px;"> Añadir. </button>
            </div>
        </form>
        @endsection

    </body>

</html>
