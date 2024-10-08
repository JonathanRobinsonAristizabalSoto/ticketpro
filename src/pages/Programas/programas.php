<?php include '../Auth/auth_session.php'; ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - TicketPro+</title>
    <link rel="stylesheet" href="../../../assets/css/header.css">
    <link rel="stylesheet" href="../../../assets/css/footer.css">
    <link rel="stylesheet" href="../../../assets/css/home.css">
    <link rel="stylesheet" href="../../../assets/css/menu.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@100;300;400;700;900&family=Poppins:wght@100;200;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">


    <!-- Incluir CSS de DataTables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

    <!-- Incluir jQuery y JS de DataTables -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
</head>

<body>
    <!-- encabezado -->
    <header>
        <div class="logo_header">
            <a href="index.php">
                <img src="../../../assets/images/logoticket.png" alt="Logo TicketPro+">
            </a>
        </div>
        <div class="titulo_header_home">
            <h1>Bienvenido a TicketPro+</h1>
            <p>¡Hola, <?php echo htmlspecialchars($nombre); ?>!</p>
        </div>

        <div class="btn_header_back">
            <a href="../Home/home.php"><i class="fas fa-arrow-left"></i> Atras</a>
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
            <a href="../src/pages/Profile/miperfil.php"><i class="fas fa-user"></i> Mi perfil</a>
            <a href="configuracion.php"><i class="fas fa-cog"></i> Configuración</a>
            <br>
            <form action="" method="post">
                <button type="submit" name="cerrar_sesion" class="logout-button">
                    <i class="fas fa-sign-out-alt"></i> Salir
                </button>
            </form>
            <br>
        </nav>
    </header>

    <main>
        <div class="container">
            <!-- Contenido Principal -->
            <div class="main-content">
                <center>
                    <h3>PROGRAMAS</h3>
                </center>

                <!-- Programas -->
                <section class="module programas">
                    <h4 class="titulos_tablas">Programas</h4>
                    <table id="miTablaProgramas" class="display">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Versión</th>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Duración</th>
                                <th>Línea Tecnológica</th>
                                <th>Red Tecnológica</th>
                                <th>Red de Conocimiento</th>
                                <th>Modalidad</th>
                            </tr>
                        </thead>
                        <tbody id="programas-list"></tbody>
                    </table>
                </section>

            </div>
        </div>
    </main>

    <footer>
        <p>&copy; 2024 TicketPro+ - Todos los derechos reservados</p>
    </footer>

    <script src="../../../assets/js/menu.js"></script>

    <script src="../../../assets/js/handleError.js"></script>
    <script src="../../../assets/js/cargarEstadosTickets.js"></script>
    <script src="../../../assets/js/cargarTicketsRecientes.js"></script>
    <script src="../../../assets/js/cargarProgramas.js"></script>
    <script src="../../../assets/js/cargarTipologiasYSubtipologias.js"></script>
    <script src="../../../assets/js/actualizarCamposPrograma.js"></script>
    <script src="../../../assets/js/manejarFormularioNuevoTicket.js"></script>
    <script src="../../../assets/js/inicializarFunciones.js"></script>
</body>

</html>