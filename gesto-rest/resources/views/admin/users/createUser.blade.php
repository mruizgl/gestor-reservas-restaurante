<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Crear Nuevo Usuario</title>
    <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/png" />
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" type="text/css">
</head>

<body>
    <header>
        <nav>
            <a href="{{ route('home') }}">Inicio</a>
            <a href="{{ route('reservations.index') }}">Reservas</a>
        </nav>
    </header>
    <br>
    <br>

    <div style="text-align: center; margin-bottom: 20px;">
        <a href="{{ route('admin.dashboard') }}" class="btn-back">← Volver al Panel de Administración</a>
    </div>

    <main>
        <div class="container">
            <h1>Crear Nuevo Usuario</h1>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @elseif($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.storeUser') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="name">Nombre</label>
                    <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}" required>
                </div>

                <div class="form-group">
                    <label for="email">Correo Electrónico</label>
                    <input type="email" name="email" class="form-control" id="email" value="{{ old('email') }}" required>
                </div>

                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input type="password" name="password" class="form-control" id="password" required>
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Confirmar Contraseña</label>
                    <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" required>
                </div>

                <button type="submit" class="btn btn-primary">Crear Usuario</button>
            </form>
        </div>
    </main>

    <footer>
        <p>&copy; 2024 Gesto-rest. Todos los derechos reservados.</p>
    </footer>

    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background: url('{{ asset('images/background2.png') }}') no-repeat center center fixed;
            background-size: cover;
            color: #282C59;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .container {
            text-align: center;
            background: rgba(255, 255, 255, 0.95);
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            max-width: 500px;
            width: 90%;
            margin: 50px auto;
            flex-grow: 1;
        }

        h1 {
            font-size: 2rem;
            margin-bottom: 1rem;
            color: #B64C78;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .btn-primary {
            display: inline-block;
            padding: 10px 20px;
            background-color: #2488C1;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 1rem;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #B64C78;
        }

        .btn-back {
            display: inline-block;
            padding: 10px 20px;
            background-color: #2488C1;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 1rem;
            margin-bottom: 20px;
            transition: background-color 0.3s ease;
        }

        .btn-back:hover {
            background-color: #B64C78;
        }

        footer {
            background-color: #0D263F;
            color: #F7FAF9;
            text-align: center;
            padding: 10px 0;
            margin-top: auto;
        }

        .alert {
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            text-align: left;
        }
    </style>
</body>

</html>
