<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mi Aplicación</title>
    
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">
    <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/png"/>
</head>
<body style="background-color: #CCDBAC; font-family: Arial, sans-serif;">
    <!-- Cabecera -->
    <header style="background-color: #0D263F; color: white; padding: 15px 0; text-align: center;">
        <nav>
            <a href="{{ route('home') }}" style="color: #2488C1; font-size: 18px; margin-right: 20px; text-decoration: none;">Inicio</a>
            
            <a href="{{ route('reservations.index') }}" style="color: #2488C1; font-size: 18px; text-decoration: none;">Reservas</a>
        </nav>
    </header>

    <!-- Contenido principal de la página -->
    <main style="padding: 20px;">
        @yield('content')
    </main>

    <!-- Pie de página -->
    <footer style="background-color: #0D263F; color: white; text-align: center; padding: 10px 0;">
        <p>&copy; 2024 Gesto-rest. Todos los derechos reservados.</p>
    </footer>

    <!-- Enlazamos el archivo JS de la aplicación -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
