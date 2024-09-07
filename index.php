<?php
include './src/conections/config.php';

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
        // Utilizando una consulta preparada para evitar inyección SQL
        $stmt = $conexion->prepare("SELECT * FROM Usuarios WHERE documento = ? AND tipo_documento = ? AND id_rol = ?");
        if ($stmt === false) {
            $error_message = "Error en la preparación de la consulta: " . $conexion->error;
        } else {
            $stmt->bind_param("ssi", $documento, $tipo_documento, $tipo_usuario);
            $stmt->execute();
            $result = $stmt->get_result();

            // Depuración: Mostrar el número de filas encontradas
            echo "<script>console.log('Número de filas encontradas: " . $result->num_rows . "');</script>";

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                // Verificar la contraseña
                if (password_verify($password, $row['password'])) {
                    // Inicio de sesión exitoso
                    session_start();
                    $_SESSION['documento'] = $documento;
                    $_SESSION['tipo_usuario'] = $tipo_usuario;

                    // Redirigir a la página de inicio después del inicio de sesión exitoso
                    header("Location: ./src/pages/Home/home.php");
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
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
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
            <center>
                <h2>INICIO SESION USUARIO</h2>
            </center>
            
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
                    <option value="1">Administrador</option>
                    <option value="2">Usuario</option>
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
        <?php if (!empty($error_message)): ?>
                <div class="error-overlay" id="error-overlay">
                    <div class="error-message" id="error-message">
                        <?php echo $error_message; ?>
                    </div>
                </div>
                <script>
                    setTimeout(function() {
                        document.getElementById('error-message').classList.add('slide-out');
                        document.getElementById('error-overlay').classList.add('fade-out');
                        setTimeout(function() {
                            document.getElementById('error-overlay').style.display = 'none';
                        }, 1000); // Tiempo de la animación de salida
                    }, 3000); // Tiempo que el mensaje permanece visible
                </script>
            <?php endif; ?>
    </main>

    <footer>
        <!-- Pie de página -->
        <p>&copy; 2024 TicketPro+ - Todos los derechos reservados</p>
    </footer>

    <script src="./assets/js/jquery.min.js"></script>
</body>

</html>