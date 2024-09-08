<?php
// Ubicación del archivo: ../../conections/config.php
include '../../conections/config.php';

session_start();
if (!isset($_SESSION['documento'])) {
    header("Location: ../../index.php");
    exit;
}

if (isset($_POST['cerrar_sesion'])) {
    session_unset(); // Eliminar todas las variables de sesión
    session_destroy(); // Destruir la sesión
    header("Location: ../../../index.php");
    exit;
}

// Consulta SQL para obtener el nombre y el documento del usuario
$consulta = "SELECT nombre, documento FROM usuarios WHERE documento = ?";
if ($stmt = $conexion->prepare($consulta)) {
    $stmt->bind_param("s", $_SESSION['documento']);
    $stmt->execute();
    $stmt->bind_result($nombre, $documento);
    $stmt->fetch();
    $stmt->close();
} else {
    die("Error en la consulta: " . $conexion->error);
}
?>

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
        <a href="../../index.php" class="logo">
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

            <!-- Crear Nuevo Ticket -->
            <section class="module">
                <h4 class="titulos_tablas">Crear Nuevo Ticket</h4>
                <form id="nueva-solicitud-form" method="POST" action="crear_ticket.php">
                    <!-- Formulario -->
                    <label for="tipo_solicitud">Tipo de solicitud:</label>
                    <select id="tipo_solicitud" name="tipo_solicitud" required>
                        <option value="" disabled selected>Seleccione una opción</option>
                        <option value="Formacion">Formación</option>
                        <option value="Consulta">Consulta</option>
                        <option value="Certificacion">Certificación</option>
                    </select>

                    <label for="programa">Programa:</label>
                    <select id="programa" name="programa" required>
                        <option value="" disabled selected>Seleccione un programa</option>
                    </select>

                    <label for="tipo_de_formacion">Tipo de formación:</label>
                    <input type="text" id="tipo_de_formacion" name="tipo_de_formacion" readonly>

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

            <!-- Tickets Recientes -->
            <section class="module tickets-recientes">
                <h4 class="titulos_tablas">Historial de Tickets</h4>
                <table id="miTablaTickets" class="display">
                    <thead>
                        <tr>
                            <th>ID ticket</th>
                            <th>ID</th>
                            <th>Tipo de Solicitud</th>
                            <th>Título</th>
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

            <!-- Programas -->
            <section class="module programas">
                <h4 class="titulos_tablas">Programas</h4>
                <table id="miTablaProgramas" class="display">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Versión</th>
                            <th>Tipo de Formación</th>
                            <th>Nombre</th>
                            <th>Nivel de Formación</th>
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
    </main>

    <footer>
        <p>&copy; 2024 TicketPro+ - Todos los derechos reservados</p>
    </footer>

    <script>
    $(document).ready(function() {
        // Función para manejar errores de AJAX
        function handleError(message) {
            alert(message);
        }

        // Cargar estados de tickets
        $.ajax({
            url: 'get_estados.php',
            method: 'GET',
            success: function(data) {
                $('#estados-container').html(data);
            },
            error: function() {
                handleError("Error al cargar los estados de los tickets.");
            }
        });

        // Cargar tickets recientes
        $.ajax({
            url: 'get_tickets_recientes.php',
            method: 'GET',
            success: function(data) {
                $('#tickets-recientes-list').html(data);
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

        // Cargar programas
        $.ajax({
            url: 'get_programas.php',
            method: 'GET',
            success: function(data) {
                var programas = JSON.parse(data);
                $('#programas-list').html(programas.lista);
                $('#programa').html('<option value="" disabled selected>Seleccione un programa</option>' + programas.opciones);
                $('#miTablaProgramas').DataTable({
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
                handleError("Error al cargar los programas.");
            }
        });

        // Actualizar campos ocultos al seleccionar un programa
        $('#programa').change(function() {
            var selectedOption = $(this).find('option:selected');
            $('#tipo_de_formacion').val(selectedOption.data('tipo'));
            $('#modalidad').val(selectedOption.data('modalidad'));
        });

        // Crear nuevo ticket
        $('#nueva-solicitud-form').submit(function(event) {
            event.preventDefault();
            var tipo_solicitud = $('#tipo_solicitud').val();
            var programa = $('#programa').val();
            var tipo_de_formacion = $('#tipo_de_formacion').val();
            var modalidad = $('#modalidad').val();
            var descripcion = $('#descripcion').val();
            var prioridad = $('#prioridad').val();

            $.ajax({
                url: 'crear_ticket.php',
                method: 'POST',
                data: {
                    tipo_solicitud: tipo_solicitud,
                    programa: programa,
                    tipo_de_formacion: tipo_de_formacion,
                    modalidad: modalidad,
                    descripcion: descripcion,
                    prioridad: prioridad
                },
                success: function(response) {
                    alert('Ticket creado exitosamente');
                    $('#nueva-solicitud-form')[0].reset();
                    // Recargar tickets recientes
                    $.ajax({
                        url: 'get_tickets_recientes.php',
                        method: 'GET',
                        success: function(data) {
                            $('#tickets-recientes-list').html(data);
                        },
                        error: function() {
                            handleError("Error al recargar los tickets recientes.");
                        }
                    });
                },
                error: function() {
                    handleError("Error al crear el ticket.");
                }
            });
        });
    });
</script>

    
</body>

</html>