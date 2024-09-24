<?php
include '../configuracion/config.php';
session_start();
verificar_sesion();

$id_usuario = $_SESSION['ID_usuario'];
$mensaje = $error = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['actualizar_perfil'])) {
        $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
        $edad = mysqli_real_escape_string($conn, $_POST['edad']);
        $telefono = mysqli_real_escape_string($conn, $_POST['telefono']);
        $correo = mysqli_real_escape_string($conn, $_POST['correo']);
        $ci = mysqli_real_escape_string($conn, $_POST['ci']);

        $sql_update = "UPDATE Usuario SET Nombre = ?, Edad = ?, Numero_telefono = ?, Correo_electronico = ?, CI = ? WHERE ID_usuario = ?";
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->bind_param("sisssi", $nombre, $edad, $telefono, $correo, $ci, $id_usuario);

        if ($stmt_update->execute()) {
            $mensaje = "Perfil actualizado exitosamente.";
            $_SESSION['usuario'] = $nombre;
        } else {
            $error = "Error al actualizar el perfil: " . $conn->error;
        }
    } elseif (isset($_POST['cambiar_contrasenia'])) {
        $contrasenia_actual = $_POST['contrasenia_actual'];
        $nueva_contrasenia = $_POST['nueva_contrasenia'];
        $confirmar_contrasenia = $_POST['confirmar_contrasenia'];

        // Verificar la contraseña actual
        $sql_check = "SELECT Contrasenia FROM Usuario WHERE ID_usuario = ?";
        $stmt_check = $conn->prepare($sql_check);
        $stmt_check->bind_param("i", $id_usuario);
        $stmt_check->execute();
        $result = $stmt_check->get_result();
        $user = $result->fetch_assoc();

        if (password_verify($contrasenia_actual, $user['Contrasenia'])) {
            if ($nueva_contrasenia === $confirmar_contrasenia) {
                $hashed_password = password_hash($nueva_contrasenia, PASSWORD_DEFAULT);
                $sql_update = "UPDATE Usuario SET Contrasenia = ? WHERE ID_usuario = ?";
                $stmt_update = $conn->prepare($sql_update);
                $stmt_update->bind_param("si", $hashed_password, $id_usuario);

                if ($stmt_update->execute()) {
                    $mensaje = "Contraseña actualizada exitosamente.";
                } else {
                    $error = "Error al actualizar la contraseña: " . $conn->error;
                }
            } else {
                $error = "Las nuevas contraseñas no coinciden.";
            }
        } else {
            $error = "La contraseña actual es incorrecta.";
        }
    } elseif (isset($_POST['cambiar_tipo_usuario'])) {
        $nuevo_tipo = mysqli_real_escape_string($conn, $_POST['tipo_usuario']);

        if ($nuevo_tipo == 'participante' || $nuevo_tipo == 'organizador') {
            $sql_update = "UPDATE Usuario SET Tipo_usuario = ? WHERE ID_usuario = ?";
            $stmt_update = $conn->prepare($sql_update);
            $stmt_update->bind_param("si", $nuevo_tipo, $id_usuario);

            if ($stmt_update->execute()) {
                $_SESSION['tipo_usuario'] = $nuevo_tipo;
                $mensaje = "Tipo de usuario actualizado exitosamente a " . $nuevo_tipo . ".";

                // Si el nuevo tipo es organizador, agregar a la tabla Organizador si no existe
                if ($nuevo_tipo == 'organizador') {
                    $sql_check = "SELECT * FROM Organizador WHERE ID_usuario = ?";
                    $stmt_check = $conn->prepare($sql_check);
                    $stmt_check->bind_param("i", $id_usuario);
                    $stmt_check->execute();
                    $result = $stmt_check->get_result();

                    if ($result->num_rows == 0) {
                        $sql_insert = "INSERT INTO Organizador (ID_usuario) VALUES (?)";
                        $stmt_insert = $conn->prepare($sql_insert);
                        $stmt_insert->bind_param("i", $id_usuario);
                        $stmt_insert->execute();
                    }
                }
            } else {
                $error = "Error al actualizar el tipo de usuario: " . $conn->error;
            }
        } else {
            $error = "Tipo de usuario no válido.";
        }
    } elseif (isset($_POST['eliminar_cuenta'])) {
        // Iniciar una transacción
        $conn->begin_transaction();

        try {
            // Eliminar registros relacionados en otras tablas
            $tablas = ['Participante', 'Organizador', 'Interes'];
            foreach ($tablas as $tabla) {
                $sql_delete = "DELETE FROM $tabla WHERE ID_usuario = ?";
                $stmt_delete = $conn->prepare($sql_delete);
                $stmt_delete->bind_param("i", $id_usuario);
                $stmt_delete->execute();
            }

            // Eliminar el usuario
            $sql_delete_user = "DELETE FROM Usuario WHERE ID_usuario = ?";
            $stmt_delete_user = $conn->prepare($sql_delete_user);
            $stmt_delete_user->bind_param("i", $id_usuario);
            $stmt_delete_user->execute();

            // Confirmar la transacción
            $conn->commit();

            // Cerrar la sesión y redirigir al usuario
            session_destroy();
            header("Location: ../../index.php?mensaje=cuenta_eliminada");
            exit();
        } catch (Exception $e) {
            // Si ocurre un error, revertir la transacción
            $conn->rollback();
            $error = "Error al eliminar la cuenta: " . $e->getMessage();
        }
    }
}

$sql_user = "SELECT * FROM Usuario WHERE ID_usuario = ?";
$stmt_user = $conn->prepare($sql_user);
$stmt_user->bind_param("i", $id_usuario);
$stmt_user->execute();
$result_user = $stmt_user->get_result();
$user = $result_user->fetch_assoc();

// Llamada a la vista HTML
include '../../pagina/perfil_view.php';
?>