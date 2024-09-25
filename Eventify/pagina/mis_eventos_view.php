<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Eventos - Eventify</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/styles.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="../../index.php">Eventify</a>
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
        <h2 class="mb-4">
            <?php echo ($tipo_usuario == 'organizador') ? 'Mis Eventos Creados' : 'Eventos en los que Participo'; ?>
        </h2>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            <?php if (!empty($eventos)): ?>
                <?php foreach ($eventos as $evento): ?>
                    <div class="col">
                        <div class="card h-100">
                            <img src="mostrar_imagen.php?id=<?php echo $evento['ID_evento']; ?>" class="card-img-top"
                                alt="Imagen del evento" style="height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($evento['Nombre']); ?></h5>
                                <h6 class="card-subtitle mb-2 text-muted">
                                    <?php echo htmlspecialchars($evento['Nombre_categoria']); ?></h6>
                                <p class="card-text">
                                    <strong>Descripción:</strong> <?php echo htmlspecialchars($evento['Descripcion']); ?><br>
                                    <strong>Fecha:</strong> <?php echo htmlspecialchars($evento['Fecha']); ?><br>
                                    <strong>Ubicación:</strong> <?php echo htmlspecialchars($evento['Ubicacion']); ?><br>
                                    <strong>Costo de entrada:</strong>
                                    $<?php echo htmlspecialchars($evento['Costo_entrada']); ?>
                                </p>
                                <?php if ($tipo_usuario == 'organizador'): ?>
                                    <a href='editar_evento.php?id=<?php echo $evento['ID_evento']; ?>'
                                        class='btn btn-primary me-2'>Editar</a>
                                    <a href='eliminar_evento.php?id=<?php echo $evento['ID_evento']; ?>' class='btn btn-danger'
                                        onclick='return confirm("¿Estás seguro de que quieres eliminar este evento?");'>Eliminar</a>
                                <?php else: ?>
                                    <a href='participar_evento.php?id=<?php echo $evento['ID_evento']; ?>&action=cancel'
                                        class='btn btn-danger'
                                        onclick='return confirm("¿Estás seguro de que quieres cancelar tu participación en este evento?");'>Cancelar
                                        Participación</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12">
                    <p class="alert alert-info">No tienes eventos
                        <?php echo ($tipo_usuario == 'organizador') ? 'creados' : 'en los que participes'; ?> aún.</p>
                </div>
            <?php endif; ?>
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