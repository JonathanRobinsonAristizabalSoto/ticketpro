<?php
// Ubicación del archivo: ../../config/config.php
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
$consulta = "SELECT nombre, documento FROM Usuarios WHERE documento = ?";
if ($stmt = $conexion->prepare($consulta)) {
    $stmt->bind_param("s", $_SESSION['documento']);
    $stmt->execute();
    $stmt->bind_result($nombre, $documento);
    $stmt->fetch();
    $stmt->close();
} else {
    die("Error en la consulta: " . $conexion->error);
}
?>