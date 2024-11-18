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
    <h1>Agregar Mesa</h1>
    
    <form action="{{ route('tables.store') }}" method="POST">
        @csrf
        
        <label for="capacity">Capacidad:</label>
        <select name="capacity" id="capacity" required>
            <option value="2">2 personas</option>
            <option value="4">4 personas</option>
            <option value="6">6 personas</option>
            <option value="8">8 personas</option>
        </select>

        <button type="submit" style="margin-top: 20px;">Agregar Mesa</button>
    </form>
@endsection

</body>
</html>