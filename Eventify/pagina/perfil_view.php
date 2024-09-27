<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Perfil - Eventify</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/styles.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="../../index.php">Eventify</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="../../index.php">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="../eventos/eventos.php">Eventos</a></li>
                    <?php if (isset($_SESSION['usuario'])): ?>
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

    <main class="container mt-4">
        <br>
        <h1 class="mb-4">Mi Perfil</h1>
        <div class="row">
            <div class="col-md-6">
                <h2>Información Personal</h2>
                <p><strong>Nombre:</strong> <?php echo htmlspecialchars($user['Nombre']); ?></p>
                <p><strong>Edad:</strong> <?php echo htmlspecialchars($user['Edad']); ?></p>
                <p><strong>Teléfono:</strong> <?php echo htmlspecialchars($user['Numero_telefono']); ?></p>
                <p><strong>Correo Electrónico:</strong> <?php echo htmlspecialchars($user['Correo_electronico']); ?></p>
                <p><strong>CI:</strong> <?php echo htmlspecialchars($user['CI']); ?></p>
            </div>
            <div class="col-md-6">
                <h2>Información de la Cuenta</h2>
                <p><strong>Tipo de Usuario:</strong> <?php echo htmlspecialchars($user['Tipo_usuario']); ?></p>
                <a href="editar_perfil.php" class="btn btn-primary">Modificar Perfil</a>
            </div>
        </div>
    </main>

    <footer style="background-color: #007BFF; color: #fff; text-align: center; padding: 1rem 0;">
        <div class="container">
            <p class="mb-0">&copy; 2023 Eventify. Todos los derechos reservados.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    <script src="menu.js"></script>
</body>
</html>
