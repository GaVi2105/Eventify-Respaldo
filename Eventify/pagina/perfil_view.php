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
            <a class="navbar-brand" href="index.php">Eventify</a>
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
                    <li class="nav-item"><a class="nav-link" href="../eventos/crear_evento.php">Crear Evento</a></li>
                        <?php endif; ?>
                    <li class="nav-item"><a class="nav-link" href="../eventos/mis_eventos.php">Mis Eventos</a></li>
                    <li class="nav-item"><a class="nav-link" href="../usuario/perfil.php">Mi Perfil</a></li>
                    <li class="nav-item"><a class="nav-link" href="cerrar_sesion.php">Cerrar Sesión</a></li>
                        <?php else: ?>
                        <?php endif; ?> 
                </ul>
            </div>
        </div>
    </nav>

    <main class="container mt-4">
        <h1 class="mb-4">Mi Perfil</h1>
        <?php if (isset($mensaje)): ?>
            <div class="alert alert-success" role="alert"><?php echo htmlspecialchars($mensaje); ?></div>
        <?php endif; ?>
        <?php if (isset($error)): ?>
            <div class="alert alert-danger" role="alert"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        <div class="row">
            <div class="col-md-6">
                <h2>Información Personal</h2>
                <form method="POST" action="perfil.php" class="needs-validation" novalidate>
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre:</label>
                        <input type="text" class="form-control" id="nombre" name="nombre"
                            value="<?php echo htmlspecialchars($user['Nombre']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="edad" class="form-label">Edad:</label>
                        <input type="number" class="form-control" id="edad" name="edad"
                            value="<?php echo htmlspecialchars($user['Edad']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="telefono" class="form-label">Teléfono:</label>
                        <input type="tel" class="form-control" id="telefono" name="telefono"
                            value="<?php echo htmlspecialchars($user['Numero_telefono']); ?>">
                    </div>
                    <div class="mb-3">
                        <label for="correo" class="form-label">Correo Electrónico:</label>
                        <input type="email" class="form-control" id="correo" name="correo"
                            value="<?php echo htmlspecialchars($user['Correo_electronico']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="ci" class="form-label">CI:</label>
                        <input type="text" class="form-control" id="ci" name="ci"
                            value="<?php echo htmlspecialchars($user['CI']); ?>">
                    </div>
                    <button type="submit" name="actualizar_perfil" class="btn btn-primary">Actualizar Perfil</button>
                </form>
            </div>
            <div class="col-md-6">
                <h2>Cambiar Contraseña</h2>
                <form method="POST" action="perfil.php" class="needs-validation" novalidate>
                    <div class="mb-3">
                        <label for="contrasenia_actual" class="form-label">Contraseña Actual:</label>
                        <input type="password" class="form-control" id="contrasenia_actual" name="contrasenia_actual"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="nueva_contrasenia" class="form-label">Nueva Contraseña:</label>
                        <input type="password" class="form-control" id="nueva_contrasenia" name="nueva_contrasenia"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="confirmar_contrasenia" class="form-label">Confirmar Nueva Contraseña:</label>
                        <input type="password" class="form-control" id="confirmar_contrasenia"
                            name="confirmar_contrasenia" required>
                    </div>
                    <button type="submit" name="cambiar_contrasenia" class="btn btn-primary">Cambiar Contraseña</button>
                </form>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-6">
                <h2>Cambiar Tipo de Usuario</h2>
                <form method="POST" action="perfil.php" class="needs-validation" novalidate>
                    <div class="mb-3">
                        <label for="tipo_usuario" class="form-label">Tipo de Usuario:</label>
                        <select class="form-select" id="tipo_usuario" name="tipo_usuario" required>
                            <option value="participante" <?php echo ($user['Tipo_usuario'] == 'participante') ? 'selected' : ''; ?>>Participante</option>
                            <option value="organizador" <?php echo ($user['Tipo_usuario'] == 'organizador') ? 'selected' : ''; ?>>Organizador</option>
                        </select>
                    </div>
                    <button type="submit" name="cambiar_tipo_usuario" class="btn btn-primary">Cambiar Tipo de
                        Usuario</button>
                </form>
            </div>
            <div class="col-md-6">
                <h2>Eliminar Cuenta</h2>
                <p class="text-danger">Advertencia: Esta acción es irreversible y eliminará todos tus datos.</p>
                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                    data-bs-target="#confirmarEliminarModal">
                    Eliminar mi cuenta
                </button>
            </div>
        </div>
    </main>

    <div class="modal fade" id="confirmarEliminarModal" tabindex="-1" aria-labelledby="confirmarEliminarModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmarEliminarModalLabel">Confirmar eliminación de cuenta</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <p>¿Estás seguro de querer eliminar tu cuenta? Esta acción no se puede deshacer.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <form method="POST" action="perfil.php">
                        <button type="submit" name="eliminar_cuenta" class="btn btn-danger">Sí, eliminar mi
                            cuenta</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

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