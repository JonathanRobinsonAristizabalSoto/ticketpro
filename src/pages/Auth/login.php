<?php include 'validate_user.php'; ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sesión - TicketPro+</title>
    <link rel="stylesheet" href="../../../assets/css/header.css">
    <link rel="stylesheet" href="../../../assets/css/footer.css">
    <link rel="stylesheet" href="../../../assets/css/styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="../../../assets/js/jquery.min.js"></script>
</head>

<body>
    <!-- encabezado -->
    <header>
        <div class="logo_header">
            <a href="index.php">
                <img src="../../../assets/images/logoticket.png" alt="Logo TicketPro+">
            </a>
        </div>
        <div class="titulo_header">
            <h1>TICKET PRO +</h1>
        </div>

        <!-- Ícono de menú hamburguesa con texto "Menú" -->
        <div class="menu-container">
            <div class="menu-icon" id="menu-icon">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <span class="menu-text">Menú</span> <!-- Texto debajo del icono -->
            <!-- Menú de navegación -->
            <nav id="menu-nav">
                <a href="../../../index.php">Inicio</a>
                <a href="./src/pages/About/about.php">Nosotros</a>
                <a href="./src/pages/Contact/contact.php">Contacto</a>
                <a href="./register.php">Registrarse</a>
            </nav>
        </div>
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
                    <a href="./register.php">Registrarse</a>
                    <a href="./password_recovery.php">Olvidé mi contraseña</a>
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

    <!-- Pie de página -->
    <footer>
        <p>&copy; 2024 TicketPro+ Todos los derechos reservados</p>
    </footer>

    <script src="../../../assets/js/menu.js"></script>
</body>

</html>