<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Eventify</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/styles.css">
    <style>
       body {
            height: 100vh; /* Altura completa de la ventana */
            margin: 0; /* Elimina el margen por defecto */
            position: relative; /* Posicionamiento relativo para el pseudo-elemento */
            overflow: hidden; /* Evita que se desborde la imagen */
        }

        /* Pseudo-elemento para el fondo desenfocado */
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url('../../imagenes/paysandu.jpg'); /* Cambia esta ruta por la de tu imagen */
            background-size: cover;
            background-position: center;
            filter: blur(10px); /* Ajusta el nivel de desenfoque */
            z-index: 1; /* Asegúrate de que esté detrás del contenido */
        }

        .login-container {
            background-color: rgba(255, 255, 255, 0.9); /* Fondo blanco semitranslúcido */
            border-radius: 25px; /* Bordes redondeados */
            padding: 30px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3); /* Sombra del contenedor */
            width: 90%; /* Ancho máximo del contenedor */
            max-width: 400px; /* Ancho máximo del contenedor */
            position: absolute; /* Posicionamiento absoluto */
            top: 50%; /* 50% desde la parte superior */
            left: 50%; /* 50% desde la izquierda */
            transform: translate(-50%, -50%); /* Moverse hacia arriba y a la izquierda */
            z-index: 2; /* Asegúrate de que esté por encima del fondo */
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
        <div class="container-fluid">
            <img src="../../icono/Logo.png" alt="Logo" width="60" height="60" class="d-inline-block align-text-top">
            <a class="navbar-brand" href="../../index.php">Eventify</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="../../index.php">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="../eventos/eventos.php">Eventos</a></li>
                    <?php if (isset($_SESSION['usuario'])): ?>
                        <?php if ($_SESSION['tipo_usuario'] == 'organizador'): ?>
                            <li class="nav-item"><a class="nav-link" href="crear_evento.php">Crear Evento</a></li>
                        <?php endif; ?>
                        <li class="nav-item"><a class="nav-link" href="../eventos/mis_eventos.php">Mis Eventos</a></li>
                        <li class="nav-item"><a class="nav-link" href="perfil.php">Mi Perfil</a></li>
                        <li class="nav-item"><a class="nav-link" href="cerrar_sesion.php">Cerrar Sesión</a></li>
                    <?php else: ?>
                        <li class="nav-item"><a class="nav-link" href="login.php">Iniciar Sesión</a></li>
                        <li class="nav-item"><a class="nav-link" href="register.php">Registrarse</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6 login-container"> <!-- Contenedor de inicio de sesión -->
                <h2 class="mb-4">Iniciar Sesión</h2>
                <?php if (!empty($error)): ?>
                    <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
                <?php endif; ?>
                <form method="POST" action="login.php" class="needs-validation" novalidate>
                    <div class="mb-3">
                        <label for="correo" class="form-label">Correo Electrónico:</label>
                        <input type="email" class="form-control" id="correo" name="correo" required>
                    </div>

                    <div class="mb-3">
                        <label for="contrasenia" class="form-label">Contraseña:</label>
                        <input type="password" class="form-control" id="contrasenia" name="contrasenia" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
                </form>
            </div>
        </div>
    </main>

    <footer style="background-color: #007BFF; color: #fff; text-align: center; padding: 1rem 0;">  
        <div class="d-flex justify-content-around d-block d-md-none">
            <div class="p-2">
                <button class="btn btn-primary" type="button" aria-label="Perfil" onclick="window.location.href='funciones/usuario/perfil.php'">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                        <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z"/>
                    </svg>
                </button>
            </div>
            <div class="p-2">
                <button class="btn btn-primary" type="button" aria-label="Buscar" onclick="window.location.href='funciones/eventos/buscar.php'">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                    </svg>
                </button>
            </div>
            <div class="p-2">
                <button class="btn btn-primary" type="button" aria-label="Agregar Evento" onclick="window.location.href='funciones/eventos/agregar.php'">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
                    </svg>
                </button>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>

</html>
