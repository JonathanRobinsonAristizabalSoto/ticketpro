<?php
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
$consulta = "SELECT nombre, documento, id_usuario FROM usuarios WHERE documento = ?";
if ($stmt = $conexion->prepare($consulta)) {
    $stmt->bind_param("s", $_SESSION['documento']);
    $stmt->execute();
    $stmt->bind_result($nombre, $documento, $id_usuario);
    $stmt->fetch();
    $_SESSION['id_usuario'] = $id_usuario; // Guardar el id_usuario en la sesión
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
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <header>
        <a href="../../index.php" class="logo">
            <img src="../../../assets/images/logoticket.png" alt="TicketPro+ Logo">
        </a>
        <section class="textos-header">
            <h1 class="titulo1">TicketPro+</h1>
            <p>¡Hola, <?php echo $nombre; ?>!</p>
            <p>Documento: <?php echo $documento; ?></p>
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
                <h4>Estados de Tickets</h4>
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
                <h4>Crear Nuevo Ticket</h4>
                <form id="nueva-solicitud-form" method="POST" action="crear_ticket.php">
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
                    <input type="text" id="tipo_de_formacion" name="tipo_de_formacion" readonly placeholder="Se llenará automáticamente">

                    <label for="modalidad">Modalidad:</label>
                    <input type="text" id="modalidad" name="modalidad" readonly placeholder="Se llenará automáticamente">

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
                <h4>Tickets Recientes</h4>
                <table>
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
                <h4>Programas</h4>
                <table>
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
            // Cargar estados de tickets
            $.ajax({
                url: 'get_estados.php',
                method: 'GET',
                success: function(data) {
                    $('#estados-container').html(data);
                }
            });

            // Cargar tickets recientes
            $.ajax({
                url: 'get_tickets_recientes.php',
                method: 'GET',
                success: function(data) {
                    $('#tickets-recientes-list').html(data);
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
                }
            });

            // Actualizar campos ocultos al seleccionar un programa
            $('#programa').change(function() {
                var selectedOption = $(this).find('option:selected');
                console.log('Tipo de formación:', selectedOption.data('tipo')); // Verificación
                console.log('Modalidad:', selectedOption.data('modalidad')); // Verificación
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
                            }
                        });
                    }
                });
            });
        });
    </script>
</body>

</html>