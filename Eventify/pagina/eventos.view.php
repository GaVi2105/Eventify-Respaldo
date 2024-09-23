<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eventos - Eventify</title>
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
                    <li class="nav-item"><a class="nav-link" href="../../funciones/eventos/eventos.php">Eventos</a></li>
                        <?php if (isset($_SESSION['usuario'])): ?>
                        <?php if ($_SESSION['tipo_usuario'] == 'organizador'): ?>
                    <li class="nav-item"><a class="nav-link" href="../../funciones/eventos/crear_evento.php">Crear Evento</a></li>
                        <?php endif; ?>
                    <li class="nav-item"><a class="nav-link" href="../../funciones/eventos/mis_eventos.php">Mis Eventos</a></li>
                    <li class="nav-item"><a class="nav-link" href="../../funciones/usuario/perfil.php">Mi Perfil</a></li>
                    <li class="nav-item"><a class="nav-link" href="../../funciones/usuario/cerrar_sesion.php">Cerrar Sesión</a></li>
                        <?php else: ?>
                    <li class="nav-item"><a class="nav-link" href="../../funciones/usuario/login.php">Iniciar Sesión</a></li>
                    <li class="nav-item"><a class="nav-link" href="../usuario/register.php">Registrarse</a></li>
                        <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container mt-4">
        <h2 class="mb-4">Lista de Eventos</h2>
        <form action="eventos.php" method="get" class="mb-4">
            <div class="row g-3 align-items-center">
                <div class="col-auto">
                    <select name="categoria" id="categoria" class="form-select">
                        <option value="">Todas las categorías</option>
                        <?php while ($cat = $categorias->fetch_assoc()): ?>
                            <option value="<?php echo $cat['ID_categoria']; ?>" <?php echo ($categoria == $cat['ID_categoria']) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($cat['Nombre_categoria']); ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary">Filtrar</button>
                </div>
            </div>
        </form>

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            <?php while ($evento = $eventos->fetch_assoc()): ?>
                <div class="col">
                    <div class="card h-100">
                        <img src="mostrar_imagen.php?id=<?php echo $evento['ID_evento']; ?>" class="card-img-top"
                            alt="Imagen del evento" style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($evento['Nombre']); ?></h5>
                            <h6 class="card-subtitle mb-2 text-muted">
                                <?php echo htmlspecialchars($evento['Nombre_categoria']); ?>
                            </h6>
                            <p class="card-text">
                                <strong>Fecha:</strong> <?php echo htmlspecialchars($evento['Fecha']); ?><br>
                                <strong>Ubicación:</strong> <?php echo htmlspecialchars($evento['Ubicacion']); ?><br>
                                <strong>Costo de entrada:</strong>
                                $<?php echo htmlspecialchars($evento['Costo_entrada']); ?>
                            </p>
                            <?php if (isset($_SESSION['usuario']) && $_SESSION['tipo_usuario'] == 'participante'): ?>
                                <form action="participar_evento.php" method="POST">
                                    <input type="hidden" name="id_evento" value="<?php echo $evento['ID_evento']; ?>">
                                    <button type="submit" class="btn btn-primary">Participar</button>
                                </form>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>

        <nav aria-label="Page navigation" class="mt-4">
            <ul class="pagination justify-content-center">
                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <li class="page-item <?php echo ($page == $i) ? 'active' : ''; ?>">
                        <a class="page-link"
                            href="?page=<?php echo $i; ?>&categoria=<?php echo $categoria; ?>"><?php echo $i; ?></a>
                    </li>
                <?php endfor; ?>
            </ul>
        </nav>
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