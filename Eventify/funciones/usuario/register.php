<?php
include '../configuracion/config.php';  // Incluye la conexión a la base de datos

$error = '';

// Verifica si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Obtiene los datos del formulario
    $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
    $correo = mysqli_real_escape_string($conn, $_POST['correo']);
    $contrasenia = $_POST['contrasenia'];
    $confirmar_contrasenia = $_POST['confirmar_contrasenia'];
    $edad = mysqli_real_escape_string($conn, $_POST['edad']);
    $telefono = mysqli_real_escape_string($conn, $_POST['telefono']);
    $ci = mysqli_real_escape_string($conn, $_POST['ci']);
    $tipo_usuario = mysqli_real_escape_string($conn, $_POST['tipo_usuario']);

    // Verifica si las contraseñas coinciden
    if ($contrasenia !== $confirmar_contrasenia) {
        $error = "Las contraseñas no coinciden";
    } else {
        // Verifica si el correo ya está registrado
        $sql_check_email = "SELECT * FROM Usuario WHERE Correo_electronico = ?";
        $stmt_check = $conn->prepare($sql_check_email);
        $stmt_check->bind_param("s", $correo);
        $stmt_check->execute();
        $result = $stmt_check->get_result();

        if ($result->num_rows > 0) {
            $error = "Este correo ya está registrado";
        } else {
            // Si todo está bien, realiza el hash de la contraseña
            $contrasenia_hash = password_hash($contrasenia, PASSWORD_DEFAULT);

            // Inserta el nuevo usuario en la base de datos
            $sql = "INSERT INTO Usuario (Nombre, Correo_electronico, Contrasenia, Edad, Numero_telefono, CI, Tipo_usuario) 
                    VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssssss", $nombre, $correo, $contrasenia_hash, $edad, $telefono, $ci, $tipo_usuario);

            if ($stmt->execute()) {
                $id_usuario = $conn->insert_id;

                // Si es organizador, inserta en la tabla Organizador
                if ($tipo_usuario == 'organizador') {
                    $sql_organizador = "INSERT INTO Organizador (ID_usuario) VALUES (?)";
                    $stmt_organizador = $conn->prepare($sql_organizador);
                    $stmt_organizador->bind_param("i", $id_usuario);
                    if ($stmt_organizador->execute()) {
                        header("Location: login.php?registro_exitoso=1");
                        exit();
                    } else {
                        $error = "Error al registrar el organizador: " . $stmt_organizador->error;
                    }
                } else {
                    header("Location: login.php?registro_exitoso=1");
                    exit();
                }
            } else {
                $error = "Error al registrar el usuario: " . $stmt->error;
            }
        }
    }
}

include '../../pagina/register.view.php';
?>