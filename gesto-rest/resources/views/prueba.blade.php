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
            <label for="zona"> Zona. </label>
            <select name="zona" id="zona">
                <option> Interior. </option>
                <option> Terraza. </option>
            </select>
            </br>
            <label for="dia"> Dia. </label>
            <input type="date" name="dia" id="dia" required>
            </br></br>
            <label for="tamanio_zona"> Tamaño de la zona. </label>
            <input type="number" name="tamanio_zona" id="tamanio_zona" required>
            </br>
            <label for="tamanio_zona"> Tamaño de la zona. </label>
            <select name="capacidad" id="capacidad">
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
            </select>
            </br>
            <button type="submit" style="margin-top: 20px;"> Añadir. </button>
            <br><br>
            <button type="submit" style="margin-top: 20px;"> Atras. </button>
        </div>
</body>
</html>
