<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Olvidé mi contraseña - TicketPro+</title>
    <link rel="stylesheet" href="../../assets/css/styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>

<body>
    <header>
        <a href="../../index.php" class="logo">
            <img src="../../assets/images/logoticket.png" alt="TicketPro+ Logo">
        </a>
        <section class="textos-header">
            <h1 class="titulo1">TicketPro+</h1>
        </section>
        <nav>
            <a href="../../index.php" class="back-link"><i class="fas fa-arrow-left"></i></a>
        </nav>
    </header>
    <main>
        <div class="password-reset-container">
            <h2>Restablecer contraseña</h2>
            <p>Por favor, ingresa tu correo electrónico para recibir las instrucciones de restablecimiento de contraseña.</p>
            <form action="send-reset-link.php" method="post">
                <label for="email">Correo electrónico:</label>
                <input type="email" id="email" name="email" required>
                <button type="submit">Enviar</button>
                <br>
                <a href="../../index.php">Volver al inicio de sesión</a>
            </form>
        </div>
    </main>

    <footer>
        <p>&copy; 2024 TicketPro+ - Todos los derechos reservados</p>
    </footer>
</body>

</html>