<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Participar en Evento - Eventify</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/styles.css">
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
                    <li class="nav-item"><a class="nav-link" href="../../index.php">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="eventos.php">Eventos</a></li>
                        <?php if (isset($_SESSION['usuario'])): ?>
                        <?php if ($_SESSION['tipo_usuario'] == 'organizador'): ?>
                    <li class="nav-item"><a class="nav-link" href="crear_evento.php">Crear Evento</a></li>
                        <?php endif; ?>
                    <li class="nav-item"><a class="nav-link" href="mis_eventos.php">Mis Eventos</a></li>
                    <li class="nav-item"><a class="nav-link" href="../usuario/perfil.php">Mi Perfil</a></li>
                    <li class="nav-item"><a class="nav-link" href="../usuario/cerrar_sesion.php">Cerrar Sesión</a></li>
                        <?php else: ?>
                    <li class="nav-item"><a class="nav-link" href="../usuario/login.php">Iniciar Sesión</a></li>
                    <li class="nav-item"><a class="nav-link" href="../usuario/register.php">Registrarse</a></li>
                        <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container mt-4">
        <h2 class="mb-4">Participar en Evento</h2>
        <?php if (isset($mensaje)): ?>
            <div class="alert alert-<?php echo $tipo_mensaje; ?>"><?php echo htmlspecialchars($mensaje); ?></div>
        <?php endif; ?>
        <?php if (isset($evento) && !empty($evento)): ?>
            <div class="card">
                <div class="card-body">
                <img src="mostrar_imagen.php?id=<?php echo $evento['ID_evento']; ?>" class="card-img-top"
                            alt="Imagen del evento" style="height: auto; object-fit: cover;">
                    <h5 class="card-title"><?php echo htmlspecialchars($evento['Nombre'] ?? 'Nombre no disponible'); ?></h5>
                    <h6 class="card-subtitle mb-2 text-muted">
                        <?php echo htmlspecialchars($evento['Nombre_categoria'] ?? 'Categoría no disponible'); ?></h6>
                    <p class="card-text">
                        <strong>Descripción:</strong>
                        <?php echo htmlspecialchars($evento['Descripcion'] ?? 'Descripción no disponible'); ?><br>
                        <strong>Fecha:</strong>
                        <?php echo htmlspecialchars($evento['Fecha'] ?? 'Fecha no disponible'); ?><br>
                        <strong>Ubicación:</strong>
                        <?php echo htmlspecialchars($evento['Ubicacion'] ?? 'Ubicación no disponible'); ?><br>
                        <strong>Costo de entrada:</strong>
                        $<?php echo htmlspecialchars($evento['Costo_entrada'] ?? 'Costo no disponible'); ?>
                    </p>
                    <form action="participar_evento.php" method="POST">
                        <input type="hidden" name="id_evento" value="<?php echo $evento['ID_evento']; ?>">
                        <button type="submit" class="btn btn-primary">Confirmar Participación</button>
                    </form>
                </div>
            </div>
        <?php else: ?>
            <div class="alert alert-warning">No se encontró información del evento.</div>
        <?php endif; ?>
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