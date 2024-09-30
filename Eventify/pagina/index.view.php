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
            <img src="icono/Logo.png" alt="Logo" width="60" height="60" class="d-inline-block align-text-top">
            <a class="navbar-brand" href="index.php">Eventify</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-gear-fill" viewBox="0 0 16 16">
                    <path d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872zM8 10.93a2.929 2.929 0 1 1 0-5.86 2.929 2.929 0 0 1 0 5.858z" />
                </svg>
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

    <main class="mt-5">
        <div class="container">
            <h2 class="mb-4 mt-4">Eventos Recientes</h2>
            <div class="main-content">
                <div class="event-carousel">
                    <?php if (!empty($eventos_recientes) && $eventos_recientes->num_rows > 0): ?>
                        <?php foreach ($eventos_recientes as $evento): ?>
                            <div class="event-item">
                                <img src="funciones/eventos/mostrar_imagen.php?id=<?php echo $evento['ID_evento']; ?>" alt="Imagen del evento">
                                <p><?php echo htmlspecialchars($evento['Descripcion']); ?></p> <!-- Descripción del evento -->
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>No hay eventos recientes disponibles.</p>
                    <?php endif; ?>
                </div>
            </div>

            <h2 class="mt-4 mb-4">Eventos Destacados</h2>
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
                                    <strong>Ubicación:</strong> <?php echo htmlspecialchars($evento['Ubicacion']); ?><br>
                                    <strong>Descripción:</strong> <?php echo htmlspecialchars($evento['Descripcion']); ?>
                                </p>
                                <a href="funciones/eventos/eventos.php?id=<?php echo $evento['ID_evento']; ?>" class="btn btn-primary">Ver más</a>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>

            <h2 class="mt-4 mb-4">Próximos Eventos</h2>
            <p>A continuación, te presentamos una selección de próximos eventos que no te puedes perder:</p>
            <ul class="list-group mb-4">
                <li class="list-group-item">Concierto de Jazz - <strong>Fecha:</strong> 15 de octubre de 2024 - <strong>Ubicación:</strong> Centro Cultural</li>
                <li class="list-group-item">Taller de Fotografía - <strong>Fecha:</strong> 22 de octubre de 2024 - <strong>Ubicación:</strong> Estudio Creativo</li>
                <li class="list-group-item">Feria de Tecnología - <strong>Fecha:</strong> 5 de noviembre de 2024 - <strong>Ubicación:</strong> Parque de la Innovación</li>
            </ul>

            <h2 class="mt-4 mb-4">Testimonios</h2>
            <div class="row">
                <div class="col-md-4">
                    <blockquote class="blockquote">
                        <p class="mb-5">"Eventify me ayudó a descubrir eventos increíbles que nunca habría encontrado por mi cuenta. ¡Lo recomiendo!"</p>
                        <footer class="blockquote-footer">Juan Pérez, <cite title="Source Title">Asistente frecuente</cite></footer>
                    </blockquote>
                </div>
                <div class="col-md-4">
                    <blockquote class="blockquote">
                        <p class="mb-5">"Organizar mi evento fue fácil y rápido. Todo el soporte que necesitaba estaba a solo un clic."</p>
                        <footer class="blockquote-footer">María López, <cite title="Source Title">Organizadora de eventos</cite></footer>
                    </blockquote>
                </div>
                <div class="col-md-4">
                    <blockquote class="blockquote">
                        <p class="mb-5">"Una plataforma fantástica para conectarme con la comunidad y disfrutar de grandes experiencias."</p>
                        <footer class="blockquote-footer">Luis Fernández, <cite title="Source Title">Asistente</cite></footer>
                    </blockquote>
                </div>
            </div>
        </div>
    </main>

    <footer style="background-color: #007BFF; color: #fff; text-align: center; padding: 1rem 0;">  
    <div class="d-flex justify-content-around d-block d-md-none"> <!-- Alineación en fila, solo en pantallas pequeñas -->
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



    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    <script src="js/menu.js"></script>
</body>

</html>
