<?php
include './src/conections/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $documento = $_POST['documento'];
    $password = $_POST['password'];
    $tipo_documento = $_POST['typeDocument'];
    $tipo_usuario = $_POST['user-type'];

    // Validación de documento para que contenga solo números
    if (!preg_match("/^\d+$/", $documento)) {
        echo "El número de documento solo puede contener números.";
        exit;
    }

    // Utilizando una consulta preparada para evitar inyección SQL
    $stmt = $conexion->prepare("SELECT * FROM usuarios WHERE documento = ? AND password = ? AND tipo_documento = ? AND tipo_usuario = ?");
    $stmt->bind_param("ssss", $documento, $password, $tipo_documento, $tipo_usuario);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Inicio de sesión exitoso
        session_start();
        $_SESSION['documento'] = $documento;
        $_SESSION['tipo_usuario'] = $tipo_usuario;

        // Redirigir a la página de inicio después del inicio de sesión exitoso
        header("Location: ./src/pages/Home/home.php");
        exit; // Detener la ejecución del resto del código
    } else {
        // Inicio de sesión fallido
        $error_message = "Documento, contraseña, tipo de documento o tipo de usuario incorrectos.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sesión - TicketPro+</title>
    <link rel="stylesheet" href="./assets/css/styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>

<body>
    <header>
        <a href="index.php" class="logo">
            <img src="./assets/images/logoticket.png">
        </a>
        <section class="textos-header">
            <h1 class="titulo1">TICKET PRO +</h1>
        </section>
        <nav>
            <a href="#">Inicio</a>
            <a href="#">Nosotros</a>
            <a href="#">Contacto</a>
        </nav>
    </header>

    <main>
        <!-- formulario de inicio de sesión -->
        <div class="login-container">
            <center><h2>INICIO SESION USUARIO</h2></center>
            <form action="" method="post">
                <!-- Selector de tipo de documento -->
                <label for="typeDocument">Tipo de documento:</label>
                <select id="typeDocument" name="typeDocument" required>
                    <option value="CC">Cédula de Ciudadanía</option>
                    <option value="TI">Tarjeta de Identidad</option>
                    <option value="CE">Cédula de Extranjería</option>
                    <option value="PS">Pasaporte</option>
                    <option value="DNI">Documento Nacional de Identificación</option>
                </select>

                <!-- Campo de número de documento -->
                <label for="documento">Número de documento:</label>
                <input type="text" id="documento" name="documento" required pattern="\d+">

                <!-- Campo de contraseña -->
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required>

                <!-- Selector de tipo de usuario -->
                <label for="user-type">Tipo de usuario:</label>
                <select id="user-type" name="user-type" required>
                    <option value="usuario">Usuario</option>
                    <option value="administrador">Administrador</option>
                </select>

                <!-- capchat -->

                <div class="g-recaptcha" data-sitekey="6LdpSHwpAAAAABpEL1Pus7OzGgEAJ8U212pSYx7z" data-action="LOGIN"></div>

                <!-- Acciones del formulario -->
                <div class="form-actions">
                    <button type="submit">Iniciar sesión</button>
                    <a href="./src/pages/register.php">Registrarse</a>
                    <a href="./src/pages/password.php">Olvidé mi contraseña</a>
                </div>
            </form>
        </div>
    </main>

    <footer>
        <!-- Pie de página -->
        <p>&copy; 2024 TicketPro+ - Todos los derechos reservados</p>
    </footer>
    
</body>

</html>
