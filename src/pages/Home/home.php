<?php
include '../../conections/config.php';

session_start();
if (!isset($_SESSION['documento'])) {
    header("Location: ../../index.php");
    exit;
}

if (isset($_POST['cerrar_sesion'])) {
    // Cerrar sesión solo al hacer clic en "cerrar sesión"
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
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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
        <!-- Contenido dinámico -->
        <section class="module" id="mis-solicitudes">
            <h4>Mis Solicitudes</h4>
            <ul id="solicitudes-list">
                <?php
                // Verificar que $solicitudes esté definida y sea un array antes de iterar sobre ella
                if (isset($solicitudes) && is_array($solicitudes)) {
                    foreach ($solicitudes as $solicitud) {
                        echo "<li><strong>{$solicitud['titulo']}</strong><br>{$solicitud['descripcion']}<br><button onclick='modificarSolicitud({$solicitud['id']})'>Modificar</button><button onclick='eliminarSolicitud({$solicitud['id']})'>Eliminar</button></li>";
                    }
                } else {
                    echo "<li>No hay solicitudes disponibles</li>";
                }
                ?>
            </ul>
        </section>
        <section class="module">
            <h4>Crear Nueva Solicitud</h4>
            <!-- Formulario interactivo para crear una nueva solicitud -->
            <form id="nueva-solicitud-form">
                <label for="titulo">Título:</label>
                <input type="text" id="titulo" name="titulo" required>
                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion" name="descripcion" required></textarea>
                <button type="submit">Crear</button>
            </form>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 TicketPro+ - Todos los derechos reservados</p>
    </footer>

    <script>
        // Función para cargar las solicitudes dinámicamente
        function cargarSolicitudes() {
            // Simular carga de datos
            setTimeout(function() {
                var solicitudesList = document.getElementById('solicitudes-list');
                var solicitudes = ['Solicitud 1', 'Solicitud 2', 'Solicitud 3'];

                solicitudes.forEach(function(solicitud) {
                    var li = document.createElement('li');
                    li.textContent = solicitud;
                    solicitudesList.appendChild(li);
                });
            }, 1000); // Simula una carga de datos que tarda 1 segundo
        }

        // Llamar a la función para cargar las solicitudes al cargar la página
        window.onload = cargarSolicitudes;

        // Funciones para modificar y eliminar solicitudes (puedes enviar una solicitud a un script PHP que realice la acción)
        function modificarSolicitud(id) {
            console.log('Modificar solicitud con ID:', id);
            // Aquí puedes implementar la lógica para modificar la solicitud
        }

        function eliminarSolicitud(id) {
            console.log('Eliminar solicitud con ID:', id);
            // Aquí puedes implementar la lógica para eliminar la solicitud
        }

        // Formulario interactivo para crear una nueva solicitud
        var nuevaSolicitudForm = document.getElementById('nueva-solicitud-form');
        nuevaSolicitudForm.addEventListener('submit', function(event) {
            event.preventDefault(); // Evitar que se recargue la página
            var titulo = document.getElementById('titulo').value;
            var descripcion = document.getElementById('descripcion').value;
            // Aquí puedes enviar los datos del formulario para crear la solicitud
            console.log('Título:', titulo);
            console.log('Descripción:', descripcion);
            // Luego puedes actualizar la lista de solicitudes con la nueva solicitud
            var solicitudesList = document.getElementById('solicitudes-list');
            var li = document.createElement('li');
            li.textContent = titulo + ' - ' + descripcion;
            solicitudesList.appendChild(li);
            // Limpiar el formulario después de enviarlo
            nuevaSolicitudForm.reset();
        });
    </script>
</body>

</html>






