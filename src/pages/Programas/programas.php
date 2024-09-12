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

    <!-- Incluir CSS de DataTables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

    <!-- Incluir jQuery y JS de DataTables -->
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
            <p>Documento: <?php echo htmlspecialchars($documento); ?></p>
        </section>
        <nav>
            <form action="" method="post">
                <button type="submit" name="cerrar_sesion" class="logout-button"><i class="fas fa-sign-out-alt"></i> Salir</button>
            </form>
            <form action="../Home/home.php" method="get">
                <button type="submit" class="back-button"><i class="fas fa-home"></i> Volver</button>
            </form>
        </nav>
    </header>

    <main>
        <div class="container">
            <!-- Contenido Principal -->
            <div class="main-content">
            <center><h3>Bienvenido a TicketPro+</h3></center>

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