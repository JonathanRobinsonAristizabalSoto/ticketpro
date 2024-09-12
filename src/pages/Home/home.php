<?php include '../Auth/auth_session.php'; ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - TicketPro+</title>
    <link rel="stylesheet" href="../../../assets/css/home.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@100;300;400;700;900&family=Poppins:wght@100;200;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
</head>

<body>
<header>
    <a href="../../../index.php" class="logo">
        <img src="../../../assets/images/logoticket.png" alt="TicketPro+ Logo">
    </a>
    <section class="textos-header">
        <h1 class="titulo1">TicketPro+</h1>
        <p>¡Hola, <?php echo htmlspecialchars($nombre); ?>!</p>
    </section>
    <nav>
        <form action="" method="post">
            <button type="submit" name="cerrar_sesion" class="logout-button">
                <i class="fas fa-sign-out-alt"></i> Salir
            </button>
        </form>
    </nav>
</header>


    <main>
        <div class="container">
            <!-- Panel Lateral Fijo -->


            <aside class="sidebar" role="navigation" aria-label="Menú de navegación lateral">
                <center>
                    <a href="../../../index.php" class="logo">
                        <img src="../../../assets/images/logoticket.png" alt="TicketPro+ Logo">
                    </a>
                </center>
                <ul>
                    <li><a href="../Users/users.php"><i class="fas fa-user"></i> Usuarios</a></li>
                    <li><a href="../Tipologias/tipologias.php"><i class="fas fa-layer-group"></i> Tipologías</a></li>
                    <li><a href="../Programas/programas.php"><i class="fas fa-laptop"></i> Programas</a></li>
                    <li><a href="../Tickets/tickets.php"><i class="fas fa-ticket-alt"></i> Tickets</a></li>
                </ul>
                <div class="config">
                    <ul>
                        <li><a href="configuracion.php"><i class="fas fa-cog"></i> Configuración</a></li>
                    </ul>
                </div>
            </aside>

            <!-- Contenido Principal -->
            <div class="main-content">
                <h3>Bienvenido a TicketPro+</h3>
                <!-- Aquí va el contenido de la página -->
            </div>
        </div>
    </main>

    <footer>
        <p>&copy; 2024 TicketPro+ - Todos los derechos reservados</p>
    </footer>

</body>

</html>