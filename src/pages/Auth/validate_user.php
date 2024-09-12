<?php
include '../../connections/config.php'; // Incluir archivo de conexión a la base de datos

$error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $documento = $_POST['documento'];
    $password = $_POST['password'];
    $tipo_documento = $_POST['typeDocument'];
    $tipo_usuario = $_POST['user-type'];

    // Validación de documento para que contenga solo números
    if (!preg_match("/^\d+$/", $documento)) {
        $error_message = "El número de documento solo puede contener números.";
    } else {
        // Consulta sin preparación (menos segura)
        $query = "SELECT * FROM Usuarios WHERE documento = '$documento' AND tipo_documento = '$tipo_documento' AND id_rol = '$tipo_usuario'";
        $result = $conexion->query($query);

        // Depuración: Mostrar el número de filas encontradas
        echo "<script>console.log('Número de filas encontradas: " . $result->num_rows . "');</script>";

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            // Depuración: Mostrar la contraseña almacenada y la ingresada
            echo "<script>console.log('Contraseña almacenada: " . $row['password'] . "');</script>";
            echo "<script>console.log('Contraseña ingresada: " . $password . "');</script>";

            // Verificar la contraseña (sin hash)
            if ($password === $row['password']) {
                // Inicio de sesión exitoso
                session_start();
                $_SESSION['documento'] = $documento;
                $_SESSION['tipo_usuario'] = $tipo_usuario;

                // Redirigir a la página de inicio después del inicio de sesión exitoso
                header("Location: ../Home/home.php");
                exit; // Detener la ejecución del resto del código
            } else {
                // Contraseña incorrecta
                $error_message = "Documento, contraseña, tipo de documento o tipo de usuario incorrectos.";
            }
        } else {
            // Inicio de sesión fallido
            $error_message = "Documento, contraseña, tipo de documento o tipo de usuario incorrectos.";
        }
    }
}
?>