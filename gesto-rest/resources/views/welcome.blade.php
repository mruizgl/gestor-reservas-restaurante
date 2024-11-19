<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido - Gestor de Restaurante</title>
    <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/png"/>
    <link href="{{ asset('css/welcome.css') }}" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background: url('{{ asset('images/background.jpg') }}') no-repeat center center fixed;
            background-size: cover;
            color: #282C59;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        
    </style>
</head>

<body>
    <div class="welcome-container">
        <img src="{{ asset('images/logo.png') }}" alt="Logo del Restaurante" class="welcome-logo">
        <h1 class="welcome-title">¡Bienvenido/a a tu Gestor de Restaurante!</h1>
        <p class="welcome-text">Organiza y administra tu restaurante de manera fácil y rápida. Comienza a gestionar tus mesas, pedidos y clientes ahora.</p>
        <a href="{{ route('login') }}" class="welcome-button">Entrar</a>
    </div>
</body>
</html>
