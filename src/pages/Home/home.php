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
    <link rel="stylesheet" href="../../../assets/css/sidebar.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@100;300;400;700;900&family=Poppins:wght@100;200;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
</head>

<body>

    <!-- encabezado -->
    <header>
        <div class="logo_header">
        </div>
        <div class="titulo_header_home">
            <h1>Bienvenido a TicketPro+</h1>
            <p>¡Hola, <?php echo htmlspecialchars($nombre); ?>!</p>
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
            <a href="../Perfil/miperfil.php"><i class="fas fa-user"></i> Mi perfil</a>
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
            <!-- Panel Lateral Fijo -->
            <aside class="sidebar" role="navigation" aria-label="Menú de navegación lateral">
                <div class="logo_panel">
                    <img src="../../../assets/images/logoticket.png" alt="Logo TicketPro+">
                </div>
                <ul>
                    <li><a href="../Users/users.php"><i class="fas fa-user"></i> Usuarios</a></li>
                    <li><a href="../Tipologias/tipologias.php"><i class="fas fa-layer-group"></i> Tipologías</a></li>
                    <li><a href="../Programas/programas.php"><i class="fas fa-laptop"></i> Programas</a></li>
                    <li><a href="../Tickets/tickets.php"><i class="fas fa-ticket-alt"></i> Tickets</a></li>
                </ul>
            </aside>
            <!-- Pestaña para mostrar y ocultar el sidebar -->
            <div class="sidebar-toggle">
                <div>
                    <span>Panel</span>
                </div>
            </div>
        </div>





        <!-- Mis Tickets -->
        <section class="module mis-tickets">
            <h4 class="titulos_tablas">Mis Tickets</h4>
            <table id="miTablaMisTickets" class="display">
                <thead>
                    <tr>
                        <th>ID ticket</th>
                        <th>Numero de ticket</th>
                        <th>Tipología</th>
                        <th>Subtipología</th>
                        <th>Programa</th>
                        <th>Descripción</th>
                        <th>Estado</th>
                        <th>Prioridad</th>
                        <th>Fecha de Creación</th>
                    </tr>
                </thead>
                <tbody id="mis-tickets-list">
                    <!-- Los datos se cargarán aquí -->
                </tbody>
            </table>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 TicketPro+ - Todos los derechos reservados</p>
    </footer>

    <script src="../../../assets/js/mistickets.js"></script>
    <script src="../../../assets/js/menu.js"></script>
    <script src="../../../assets/js/sidebar.js"></script>

</body>

</html>