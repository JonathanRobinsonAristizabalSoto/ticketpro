<?php
// Ubicación del archivo: ../../config/auth_session.php
include '../../connections/config.php';

session_start();
if (!isset($_SESSION['documento'])) {
    header("Location: ./login.php");
    exit;
}

if (isset($_POST['cerrar_sesion'])) {
    session_unset(); // Eliminar todas las variables de sesión
    session_destroy(); // Destruir la sesión
    header("Location: ../../../index.php");
    exit;
}

// Consulta SQL para obtener el nombre y el documento del usuario
$consulta = "SELECT id_usuario, nombre, documento FROM Usuarios WHERE documento = ?";
if ($stmt = $conexion->prepare($consulta)) {
    $stmt->bind_param("s", $_SESSION['documento']);
    $stmt->execute();
    $stmt->bind_result($id_usuario, $nombre, $documento);
    $stmt->fetch();
    $stmt->close();

    // Configurar el id_usuario en la sesión
    $_SESSION['usuario_id'] = $id_usuario;
    $_SESSION['nombre'] = $nombre;
    $_SESSION['documento'] = $documento;
} else {
    die("Error en la consulta: " . $conexion->error);
}
?>