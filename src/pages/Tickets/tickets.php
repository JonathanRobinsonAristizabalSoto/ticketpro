<?php 
include '../Auth/auth_session.php'; 
include_once '../../connections/config.php'; 

// Verificar si la conexión se estableció correctamente
if (!$conexion) {
    die("Error: No se pudo conectar a la base de datos.");
}

// Obtener las tipologías
$tipologias = [];
$result = $conexion->query("SELECT DISTINCT tipologia FROM Tipologias");
while ($row = $result->fetch_assoc()) {
    $tipologias[] = $row;
}

// Obtener las subtipologías
$subtipologias = [];
$result = $conexion->query("SELECT tipologia, subtipologia FROM Tipologias");
while ($row = $result->fetch_assoc()) {
    $subtipologias[] = $row;
}

// Obtener los programas
$programas = [];
$result = $conexion->query("SELECT id_programa, nombre, modalidad FROM Programas");
while ($row = $result->fetch_assoc()) {
    $programas[] = $row;
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
    <title>Tickets - TicketPro+</title>
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
                    <h3>TICKETS</h3>
                </center>

                <!-- Estados de Tickets -->
                <section class="module estados">
                    <h4 class="titulos_tablas">Estados de Tickets</h4>
                    <div class="estados-container" id="estados-container">
                        <div class="estado ticket-abierto">
                            <h5>Tickets Abiertos</h5>
                            <p id="tickets-abiertos">0</p>
                        </div>
                        <div class="estado ticket-progreso">
                            <h5>Tickets En Progreso</h5>
                            <p id="tickets-progreso">0</p>
                        </div>
                        <div class="estado ticket-pendiente">
                            <h5>Tickets Pendientes</h5>
                            <p id="tickets-pendientes">0</p>
                        </div>
                        <div class="estado ticket-resuelto">
                            <h5>Tickets Resueltos</h5>
                            <p id="tickets-resueltos">0</p>
                        </div>
                        <div class="estado ticket-cerrado">
                            <h5>Tickets Cerrados</h5>
                            <p id="tickets-cerrados">0</p>
                        </div>
                    </div>
                </section>

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

                <section class="module">
                    <h4 class="titulos_tablas">Crear Nuevo Ticket</h4>
                    <form id="nueva-solicitud-form" method="POST" action="crear_ticket.php">

                        <!-- Formulario -->
                        <label for="tipologia">Tipología:</label>
                        <select id="tipologia" name="tipologia" required>
                            <option value="" disabled selected>Seleccione una tipología</option>
                            <?php foreach ($tipologias as $tipologia): ?>
                                <option value="<?php echo $tipologia['tipologia']; ?>"><?php echo $tipologia['tipologia']; ?></option>
                            <?php endforeach; ?>
                        </select>

                        <label for="subtipologia">Subtipología:</label>
                        <select id="subtipologia" name="subtipologia" required>
                            <option value="" disabled selected>Seleccione una subtipología</option>
                        </select>

                        <div id="programa-container" style="display: none;">
                            <label for="programa">Programa:</label>
                            <select id="programa" name="programa" disabled>
                                <option value="" disabled selected>Seleccione un programa</option>
                                <?php foreach ($programas as $programa): ?>
                                    <option value="<?php echo $programa['id_programa']; ?>"><?php echo $programa['nombre']; ?></option>
                                <?php endforeach; ?>
                            </select>

                            <label for="modalidad">Modalidad:</label>
                            <input type="text" id="modalidad" name="modalidad" readonly>
                        </div>

                        <label for="descripcion">Descripción:</label>
                        <textarea id="descripcion" name="descripcion" placeholder="Ingrese una descripción" required></textarea>

                        <label for="prioridad">Prioridad:</label>
                        <select id="prioridad" name="prioridad" required>
                            <option value="" disabled selected>Seleccione una opción</option>
                            <option value="Alta">Alta</option>
                            <option value="Media">Media</option>
                            <option value="Baja">Baja</option>
                        </select>

                        <button type="submit">Crear</button>
                    </form>
                </section>

                <!-- Tabla de Tickets -->
                <section class="module tickets-recientes">
                    <h4 class="titulos_tablas">Historial de Tickets</h4>
                    <table id="miTablaTickets" class="display">
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
                                <th>Solicitado por</th>
                                <th>Asignado a</th>
                                <th>Fecha de Creación</th>
                            </tr>
                        </thead>
                        <tbody id="tickets-recientes-list">
                            <?php include 'get_tickets_recientes.php'; ?>
                        </tbody>
                    </table>
                </section>
            </div>
        </div>
    </main>

    <footer>
        <p>&copy; 2024 TicketPro+ - Todos los derechos reservados</p>
    </footer>

    <script src="../../../assets/js/menu.js"></script>
    <script src="../../../assets/js/tickets.js"></script>
    <script>
        // JavaScript para actualizar las subtipologías según la tipología seleccionada
        const subtipologias = <?php echo json_encode($subtipologias); ?>;
        const programas = <?php echo json_encode($programas); ?>;
        const tipologiaSelect = document.getElementById('tipologia');
        const subtipologiaSelect = document.getElementById('subtipologia');
        const programaContainer = document.getElementById('programa-container');
        const programaSelect = document.getElementById('programa');
        const modalidadInput = document.getElementById('modalidad');

        tipologiaSelect.addEventListener('change', function() {
            const selectedTipologia = this.value;
            subtipologiaSelect.innerHTML = '<option value="" disabled selected>Seleccione una subtipología</option>';
            programaSelect.innerHTML = '<option value="" disabled selected>Seleccione un programa</option>';
            modalidadInput.value = '';

            subtipologias.forEach(function(subtipologia) {
                if (subtipologia.tipologia === selectedTipologia) {
                    const option = document.createElement('option');
                    option.value = subtipologia.subtipologia;
                    option.textContent = subtipologia.subtipologia;
                    subtipologiaSelect.appendChild(option);
                }
            });

            // Mostrar u ocultar los campos de programa y modalidad
            if (selectedTipologia === 'Formacion' || selectedTipologia === 'Certificacion' || selectedTipologia === 'Consultas') {
                programaContainer.style.display = 'block';
                programaSelect.disabled = false;
                programas.forEach(function(programa) {
                    const option = document.createElement('option');
                    option.value = programa.id_programa;
                    option.textContent = programa.nombre;
                    programaSelect.appendChild(option);
                });
            } else if (selectedTipologia === 'PQRSF' || selectedTipologia === 'Otro') {
                programaContainer.style.display = 'block';
                programaSelect.disabled = true;
                programaSelect.innerHTML = '<option value="no_aplica" selected>No aplica</option>';
                modalidadInput.value = 'No aplica';
            } else {
                programaContainer.style.display = 'none';
                programaSelect.disabled = true;
                modalidadInput.value = '';
            }
        });

        programaSelect.addEventListener('change', function() {
            const selectedPrograma = this.value;
            modalidadInput.value = '';

            programas.forEach(function(programa) {
                if (programa.id_programa == selectedPrograma) {
                    modalidadInput.value = programa.modalidad;
                }
            });
        });
    </script>
</body>

</html>