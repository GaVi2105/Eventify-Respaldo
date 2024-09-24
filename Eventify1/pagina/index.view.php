<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eventify</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">Eventify</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="index.php">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="funciones/eventos/eventos.php">Eventos</a></li>
                        <?php if (isset($_SESSION['usuario'])): ?>
                        <?php if ($_SESSION['tipo_usuario'] == 'organizador'): ?>
                    <li class="nav-item"><a class="nav-link" href="funciones/eventos/crear_evento.php">Crear Evento</a></li>
                        <?php endif; ?>
                    <li class="nav-item"><a class="nav-link" href="funciones/eventos/mis_eventos.php">Mis Eventos</a></li>
                    <li class="nav-item"><a class="nav-link" href="funciones/usuario/perfil.php">Mi Perfil</a></li>
                    <li class="nav-item"><a class="nav-link" href="funciones/usuario/cerrar_sesion.php">Cerrar Sesión</a></li>
                        <?php else: ?>
                    <li class="nav-item"><a class="nav-link" href="funciones/usuario/login.php">Iniciar Sesión</a></li>
                    <li class="nav-item"><a class="nav-link" href="funciones/usuario/register.php">Registrarse</a></li>
                        <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container mt-4">
        <h1 class="mb-4">Bienvenido a Eventify</h1>
        <?php if (isset($_SESSION['usuario'])): ?>
            <div class="alert alert-success">
                <p>Hola, <?php echo htmlspecialchars($_SESSION['usuario']); ?>!</p>
                <p>Tipo de usuario: <?php echo htmlspecialchars($_SESSION['tipo_usuario']); ?></p>
            </div>
        <?php else: ?>
            <p class="lead">Únete a nuestra comunidad de eventos.</p>
        <?php endif; ?>

        <h2 class="mt-5 mb-4">Eventos Destacados</h2>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            <?php while ($evento = $eventos_destacados->fetch_assoc()): ?>
                <div class="col">
                    <div class="card h-100">
                        <img src="funciones/eventos/mostrar_imagen.php?id=<?php echo $evento['ID_evento']; ?>"
                            class="card-img-top" alt="Imagen del evento" style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($evento['Nombre']); ?></h5>
                            <h6 class="card-subtitle mb-2 text-muted">
                                <?php echo htmlspecialchars($evento['Nombre_categoria']); ?></h6>
                            <p class="card-text">
                                <strong>Fecha:</strong> <?php echo htmlspecialchars($evento['Fecha']); ?><br>
                                <strong>Ubicación:</strong> <?php echo htmlspecialchars($evento['Ubicacion']); ?>
                            </p>
                            <a href="funciones/eventos/eventos.php?id=<?php echo $evento['ID_evento']; ?>"
                                class="btn btn-primary">Ver más</a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </main>

    <footer style="background-color: #007BFF; color: #fff; text-align: center; padding: 1rem 0;">
        <div class="container">
            <p class="mb-0">&copy; 2023 Eventify. Todos los derechos reservados.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    <script src="../menu.js"></script>
</body>

</html>