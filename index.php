<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido a TicketPro+</title>
    <link rel="stylesheet" href="./assets/css/header.css">
    <link rel="stylesheet" href="./assets/css/footer.css">
    <link rel="stylesheet" href="./assets/css/home.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script src="./assets/js/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700&display=swap" rel="stylesheet">
</head>

<body>
    <!-- encabezado -->
    <header>
        <div class="logo_header">
            <a href="index.php">
                <img src="./assets/images/logoticket.png" alt="Logo TicketPro+">
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
        </div>
        <!-- Menú de navegación -->
        <nav id="menu-nav">
            <a href="./src/pages/About/about.php">Nosotros</a>
            <a href="./src/pages/Contact/contact.php">Contacto</a>
            <a href="./src/pages/Auth/login.php">Iniciar sesión</a>
            <a href="./src/pages/Auth/register.php">Registrarse</a>
        </nav>
    </header>

    <main>
        <section class="contenedor_index">
            <section class="Seccion_bienvenida">
                <h2>Bienvenido a TicketPro+</h2>
                <p>Gestione sus solicitudes y tickets de manera eficiente con nuestra plataforma.</p>
            </section>

            <!-- Información adicional -->
            <section class="seccion_informacion">
                <h3>¿Qué ofrecemos?</h3>
                <p>
                    TicketPro+ es la solución ideal para gestionar solicitudes de soporte técnico,
                    seguimiento de tickets y mucho más. Nuestra plataforma está diseñada para
                    facilitar la comunicación entre usuarios y administradores.
                </p>
            </section>
        </section>
    </main>

    <!-- Pie de página -->
    <footer>
        <p>&copy; 2024 TicketPro+ Todos los derechos reservados</p>
    </footer>
    <script src="./assets/js/menu.js"></script>
</body>

</html>