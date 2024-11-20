<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Panel de Administración</title>
    <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/png" />


    <style>
        body {
            background: url('{{ asset('images/background2.png') }}') no-repeat center center fixed;
            background-size: cover;
            color: #282C59;
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
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

        p {
            font-size: 1.1rem;
            color: #555;
            margin-bottom: 2rem;
        }

        .list-group {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .list-group a {
            text-decoration: none;
            display: block;
            background-color: #2488C1;
            color: white;
            font-size: 1.1rem;
            padding: 10px 20px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .list-group a:hover {
            background-color: #B64C78;
            transform: translateY(-3px);
        }

        header {
            background-color: rgba(13, 38, 63, 0.9);
            color: white;
            padding: 15px 0;
            text-align: center;
        }

        header nav a {
            color: #fff;
            font-size: 18px;
            margin: 0 10px;
            text-decoration: none;
            padding: 5px 10px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        header nav a:hover {
            background-color: #2488C1;
        }

        footer {
            background-color: #1A374D;
            color: #F7FAF9 !important; 
            text-align: center;
            padding: 10px 0;
            margin-top: auto;
        }

        @media (max-width: 768px) {
            .container {
                padding: 20px;
                max-width: 90%;
            }

            h1 {
                font-size: 1.8rem;
            }

            p {
                font-size: 1rem;
            }

            .list-group a {
                font-size: 1rem;
                padding: 10px;
            }

            header nav a {
                font-size: 16px;
            }
        }

        @media (max-width: 480px) {
            .container {
                padding: 15px;
            }

            h1 {
                font-size: 1.5rem;
            }

            p {
                font-size: 0.9rem;
            }

            .list-group a {
                font-size: 0.9rem;
                padding: 8px;
            }

            header nav a {
                font-size: 14px;
                margin: 0 5px;
            }
        }
    </style>
</head>

<body>
    <header>
        <nav>
            <a href="{{ route('home') }}">Inicio</a>
            <a href="{{ route('reservations.index') }}">Reservas</a>
        </nav>
    </header>

    <main>
        <div class="container">
            <h1>Bienvenido al panel de administración</h1>
            <p>Seleccione una opción para gestionar las reservas o crear nuevos usuarios.</p>

            <div class="list-group">
                <div class="list-group">
                    <a href="{{ route('reservations.create') }}" class="list-group-item">Gestionar Reservas</a>
                    <a href="{{ route('admin.createUser') }}" class="list-group-item">Crear Nuevo Usuario</a>
                    <a href="{{ route('tables.create') }}" class="list-group-item">Añadir Mesas</a>
                    <a href="{{ route('spaces.create') }}" class="list-group-item">Crear Espacio</a> 
                </div>
            </div>
        </div>
    </main>

    <footer>
        <p>&copy; 2024 Gesto-rest. Todos los derechos reservados.</p>
    </footer>
</body>

</html>
