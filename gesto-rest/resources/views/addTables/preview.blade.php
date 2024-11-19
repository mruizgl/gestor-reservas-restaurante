<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Añadir mesa del día.</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">
    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png" />
    <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/png"/>
</head>
<body>
        <div class="form-container">
            <h1> Añadir mesa del día. </h1>

             <label for="result">Resultado:</label>
            <br>

      <!--  <form action="{{ route('reservations.store') }}" method="POST">
            @csrf

            <div class="grid-container">
                @for ($i = 1; $i <= 16; $i++)
                    <div class="grid-item">
                        @php
                            $table = $tables->firstWhere('id', $i);
                        @endphp

                        @if ($table)
                            <label>
                                <input type="radio" name="table_id" value="{{ $table->id }}" required>
                                <div class="table-info">
                                    <img src="{{ asset('images/' . $table->capacity . '.png') }}"
                                         alt="Mesa de {{ $table->capacity }} personas">
                                    <p>Mesa {{ $table->id }}</p>
                                </div>
                            </label>
                        @else
                            <p>Sin mesa</p>
                        @endif
                    </div>
                @endfor
            </div>-->
      <!--  @for ($i = 1; $i <= 10; $i++)

            <div class="table-info">
                <img src="{{ asset('images/'. $i. '.png') }}" alt="Mesa {{ $i }}">
                <p>Capacidad: {{ $i }} personas</p>
                </div>
        @endfor-->

            </br>
            <button type="submit" style="margin-top: 20px;"> Guardar. </button>
            <br><br>
            <button type="submit" style="margin-top: 20px;"> Atras. </button>
        </div>
    </form>
</body>
</html>
