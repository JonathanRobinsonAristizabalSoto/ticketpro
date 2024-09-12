<?php include '../Auth/auth_session.php'; ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tickets - TicketPro+</title>
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
        </nav>
    </header>

    <main>
        <div class="container">
            <!-- Panel Lateral -->
            <aside class="sidebar">
                <ul>
                    <li><a href="usuarios.php">Usuarios</a></li>
                    <li><a href="tipologias.php">Tipologías</a></li>
                    <li><a href="programas.php">Programas</a></li>
                    <li><a href="../Tickets/tickets.php">Tickets</a></li>
                </ul>
            </aside>

            <!-- Contenido Principal -->
            <div class="main-content">
                <h3>Bienvenido a TicketPro+</h3>
                <div class="dashboard">

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

                    <!-- Formulario Crear Nuevo Ticket -->
                    <section class="module">
                        <h4 class="titulos_tablas">Crear Nuevo Ticket</h4>
                        <form id="nueva-solicitud-form" method="POST" action="crear_ticket.php">

                            <!-- Formulario -->
                            <label for="tipologia">Tipología:</label>
                            <select id="tipologia" name="tipologia" required>
                                <option value="" disabled selected>Seleccione una tipología</option>
                            </select>

                            <label for="subtipologia">Subtipología:</label>
                            <select id="subtipologia" name="subtipologia" required>
                                <option value="" disabled selected>Seleccione una subtipología</option>
                            </select>

                            <label for="programa">Programa:</label>
                            <select id="programa" name="programa" required>
                                <option value="" disabled selected>Seleccione un programa</option>
                            </select>

                            <label for="modalidad">Modalidad:</label>
                            <input type="text" id="modalidad" name="modalidad" readonly>

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
                                    <th>ID</th>
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
        </div>
    </main>

    <footer>
        <p>&copy; 2024 TicketPro+ - Todos los derechos reservados</p>
    </footer>

    <!-- Scripts -->
    <script>
        $(document).ready(function() {
            inicializarFunciones();
        });

        function inicializarFunciones() {
            manejarFormularioNuevoTicket();
            cargarEstadosTickets();
            cargarTicketsRecientes();
            cargarMisTickets();
            cargarProgramas();
            cargarTipologiasYSubtipologias();
            actualizarCamposPrograma();
        }

        function cargarTicketsRecientes() {
            $.ajax({
                url: 'get_tickets_recientes.php',
                method: 'GET',
                success: function(data) {
                    $('#tickets-recientes-list').html(data);
                    if ($.fn.DataTable.isDataTable('#miTablaTickets')) {
                        $('#miTablaTickets').DataTable().destroy();
                    }
                    $('#miTablaTickets').DataTable({
                        pageLength: 5,
                        language: {
                            "sEmptyTable": "No hay datos disponibles en la tabla",
                            "sInfo": "Mostrando _START_ a _END_ de _TOTAL_ entradas",
                            "sInfoEmpty": "Mostrando 0 a 0 de 0 entradas",
                            "sInfoFiltered": "(filtrado de _MAX_ entradas en total)",
                            "sLengthMenu": "Mostrar _MENU_ entradas",
                            "sLoadingRecords": "Cargando...",
                            "sProcessing": "Procesando...",
                            "sSearch": "Buscar:",
                            "sZeroRecords": "No se encontraron resultados",
                            "oPaginate": {
                                "sFirst": "Primero",
                                "sLast": "Último",
                                "sNext": "Siguiente",
                                "sPrevious": "Anterior"
                            }
                        }
                    });
                },
                error: function() {
                    handleError("Error al cargar los tickets recientes.");
                }
            });
        }

        function cargarMisTickets() {
            $.ajax({
                url: 'get_mis_tickets.php',
                method: 'GET',
                success: function(data) {
                    var tickets = JSON.parse(data);
                    var tableBody = $('#mis-tickets-list');
                    tableBody.empty(); // Limpiar el contenido existente

                    tickets.forEach(function(ticket) {
                        var row = '<tr>' +
                            '<td>' + ticket.id_ticket + '</td>' +
                            '<td>' + ticket.tipologia + '</td>' +
                            '<td>' + ticket.subtipologia + '</td>' +
                            '<td>' + ticket.programa + '</td>' +
                            '<td>' + ticket.descripcion + '</td>' +
                            '<td>' + ticket.estado + '</td>' +
                            '<td>' + ticket.prioridad + '</td>' +
                            '<td>' + ticket.fecha_creacion + '</td>' +
                            '</tr>';
                        tableBody.append(row);
                    });

                    if ($.fn.DataTable.isDataTable('#miTablaMisTickets')) {
                        $('#miTablaMisTickets').DataTable().destroy();
                    }
                    $('#miTablaMisTickets').DataTable({
                        pageLength: 5,
                        language: {
                            "sEmptyTable": "No hay datos disponibles en la tabla",
                            "sInfo": "Mostrando _START_ a _END_ de _TOTAL_ entradas",
                            "sInfoEmpty": "Mostrando 0 a 0 de 0 entradas",
                            "sInfoFiltered": "(filtrado de _MAX_ entradas en total)",
                            "sLengthMenu": "Mostrar _MENU_ entradas",
                            "sLoadingRecords": "Cargando...",
                            "sProcessing": "Procesando...",
                            "sSearch": "Buscar:",
                            "sZeroRecords": "No se encontraron resultados",
                            "oPaginate": {
                                "sFirst": "Primero",
                                "sLast": "Último",
                                "sNext": "Siguiente",
                                "sPrevious": "Anterior"
                            }
                        }
                    });
                },
                error: function() {
                    handleError("Error al cargar mis tickets.");
                }
            });
        }

        function manejarFormularioNuevoTicket() {
            $('#nueva-solicitud-form').submit(function(event) {
                event.preventDefault();

                var tipologia = $('#tipologia').val();
                var subtipologia = $('#subtipologia').val();
                var programa = $('#programa').val();
                var descripcion = $('#descripcion').val();
                var prioridad = $('#prioridad').val();

                if (!tipologia || !subtipologia || !programa || !descripcion || !prioridad) {
                    alert('Por favor, complete todos los campos del formulario.');
                    return;
                }

                $.ajax({
                    url: 'crear_ticket.php',
                    method: 'POST',
                    data: {
                        tipologia: tipologia,
                        subtipologia: subtipologia,
                        programa: programa,
                        descripcion: descripcion,
                        prioridad: prioridad
                    },
                    success: function(response) {
                        alert('Ticket creado exitosamente');
                        $('#nueva-solicitud-form')[0].reset();
                        cargarTicketsRecientes();
                        cargarMisTickets();
                    },
                    error: function(xhr, status, error) {
                        console.error("Error al crear el ticket:", status, error);
                        alert('Error al crear el ticket. Por favor, intente de nuevo.');
                    }
                });
            });
        }

        function cargarEstadosTickets() {
            $.ajax({
                url: 'get_estados.php',
                method: 'GET',
                success: function(data) {
                    $('#estados-container').html(data);
                    inicializarFuncionesEstados();
                },
                error: function() {
                    handleError("Error al cargar los estados de los tickets.");
                }
            });
        }

        function inicializarFuncionesEstados() {
            console.log("Estados de tickets cargados y funciones adicionales inicializadas.");
        }

        function handleError(message) {
            alert(message);
        }
    </script>
</body>

</html>