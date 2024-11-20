<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Gestor de Restaurante</title>
    <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/png" />
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
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

        .login-container {
            text-align: center;
            background: rgba(255, 255, 255, 0.8); /* Fondo translúcido */
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2); /* Sombra más ligera */
            max-width: 400px;
            width: 90%;
        }

        .login-logo {
            width: 100px;
            margin-bottom: 20px;
        }

        .login-title {
            font-size: 2rem;
            margin-bottom: 1rem;
            font-weight: bold;
            color: #B64C78; /* Consistente con la página de bienvenida */
        }

        .login-form {
            text-align: left;
        }

        .login-form label {
            display: block;
            font-size: 14px;
            color: #0D263F; /* Consistente con los labels de la bienvenida */
            margin-bottom: 5px;
            font-weight: bold;
        }

        .login-form input {
            width: calc(100% - 10px);
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1em;
        }

        .login-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #282C59; /* Color consistente con la bienvenida */
            color: #FEFEFD;
            text-decoration: none;
            border-radius: 5px;
            font-size: 1rem;
            transition: background-color 0.3s;
            cursor: pointer;
            width: 100%;
        }

        .login-button:hover {
            background-color: #B64C78; /* Color del hover de bienvenida */
        }
    </style>
</head>

<body>
    <div class="login-container">
        <img src="{{ asset('images/logo.png') }}" alt="Logo del Restaurante" class="login-logo">
        <h3 class="login-title">Inicia Sesión</h3>
        <form method="POST" action="{{ route('login') }}" class="login-form">
            @csrf
            <div>
                <label for="email">Correo Electrónico</label>
                <input id="email" type="email" name="email" required autocomplete="email" autofocus>
            </div>
            <div>
                <label for="password">Contraseña</label>
                <input id="password" type="password" name="password" required>
            </div>
            <button type="submit" class="login-button">Entrar</button>
        </form>
    </div>
</body>

</html>
