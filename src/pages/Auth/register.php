<?php
include '../../connections/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tipo_documento = $_POST['typeDocument'];
    $documento = $_POST['documento'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $departamento = $_POST['departamento'];
    $municipio = $_POST['municipio'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm-password'];
    $tipo_usuario_id = $_POST['tipoUsuario'];

    // Verificar que la contraseña cumpla con los requisitos
    if (!preg_match("/^(?=.*[A-Z])(?=.*[0-9])/", $password)) {
        echo "La contraseña debe tener al menos una letra mayúscula y al menos un número.";
        exit;
    }

    // Verificar que las contraseñas coincidan
    if ($password !== $confirm_password) {
        echo "Las contraseñas no coinciden.";
        exit;
    }

    // Verificar que el email contenga el carácter '@'
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "El correo electrónico debe ser válido.";
        exit;
    }

    // Verificar que el número telefónico sea numérico
    if (!is_numeric($telefono)) {
        echo "El número telefónico debe ser numérico.";
        exit;
    }

    // Verificar que el id_rol existe en la tabla rol
    $stmt = $conexion->prepare("SELECT id_rol FROM rol WHERE id_rol = ?");
    $stmt->bind_param("i", $tipo_usuario_id);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 0) {
        echo "El rol seleccionado no es válido.";
        $stmt->close();
        exit;
    }
    $stmt->close();

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Preparar la consulta SQL
    $stmt = $conexion->prepare("INSERT INTO usuarios (tipo_documento, documento, nombre, apellido, email, telefono, departamento, municipio, password, id_rol, fecha_registro, estado) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), 'activo')");
    $stmt->bind_param("sssssssssi", $tipo_documento, $documento, $nombre, $apellido, $email, $telefono, $departamento, $municipio, $hashed_password, $tipo_usuario_id);

    // Ejecutar la consulta y verificar el resultado
    if ($stmt->execute()) {
        echo "Registro exitoso";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Cerrar la declaración
    $stmt->close();
}

// Cerrar la conexión
$conexion->close();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - TicketPro+</title>
    <link rel="stylesheet" href="../../../assets/css/styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>
    <header>
        <a href="../../../index.php" class="logo">
            <img src="../../../assets/images/logoticket.png" alt="TicketPro+ Logo">
        </a>
        <section class="textos-header">
            <h1 class="titulo1">TicketPro+</h1>
        </section>
        <nav>
            <a href="./login.php" class="back-link"><i class="fas fa-arrow-left"></i></a>
        </nav>
    </header>

    <main>
        <!-- Contenedor del formulario de registro -->
        <div class="register-container">
            <h2>Registrarse</h2>
            <form action="./register.php" method="post">
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
                <label for="documento">Documento:</label>
                <input type="text" id="documento" name="documento" required placeholder="Documento">

                <!-- Campo de nombre -->
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" required placeholder="Nombre">

                <!-- Campo de apellido -->
                <label for="apellido">Apellidos:</label>
                <input type="text" id="apellido" name="apellido" required placeholder="Apellido">

                <!-- Campo de correo electrónico -->
                <label for="email">Correo electrónico:</label>
                <input type="email" id="email" name="email" required placeholder="Correo electrónico">

                <!-- Campo de teléfono -->
                <label for="telefono">Teléfono:</label>
                <input type="tel" id="telefono" name="telefono" required placeholder="Teléfono">

                <?php include '../../../src/includes/departamentos.php'; ?>

                <!-- Campo de contraseña -->
                <p>La contraseña debe tener al menos 6 caracteres, una letra mayúscula y un símbolo.</p>
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required placeholder="Contraseña">

                <!-- Confirmar contraseña -->
                <label for="confirm-password">Confirmar contraseña:</label>
                <input type="password" id="confirm-password" name="confirm-password" required placeholder="Confirmar contraseña">

                <!-- Tipo de usuario -->
                <label for="tipoUsuario">Tipo de usuario:</label>
                <select id="tipoUsuario" name="tipoUsuario" required>
                    <option value="1">Administrador</option>
                    <option value="2">Usuario</option>
                </select>

                <!-- Acciones del formulario -->
                <div class="form-actions">
                    <button type="submit">Registrarse</button>
                    <a href="../../../index.php">Volver al inicio de sesión</a>
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