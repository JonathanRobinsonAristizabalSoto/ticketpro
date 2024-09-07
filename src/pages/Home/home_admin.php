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
    <link rel="stylesheet" href="../../../assets/css/home_admin.css">
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
        <!-- Módulo de dashboard -->
        <section class="modulo" id="dashboard">
            <div class="modulo-header">Dashboard</div>
            <div class="modulo-content">
            </div>
        </section>

        <!-- Módulo de Tickets -->
        <section class="modulo" id="Tickets">
            <div class="modulo-header">Tickets</div>
            <div class="modulo-content">
            </div>
        </section>


        <!-- Módulo de Habitaciones -->
        <section class="modulo" id="habitaciones">
            <div class="modulo-header">Habitaciones</div>
            <div class="modulo-content">

            </div>
        </section>

        <!-- Módulo de Pedidos -->
        <section class="modulo" id="pedidos">
            <div class="modulo-header">Pedidos</div>
            <div class="modulo-content">
            </div>
        </section>


        <!-- Módulo de Usuarios -->
        <section class="modulo" id="usuarios">
            <div>
                <button class="crear-button" id="btnCrearUsuario">Crear nuevo Usuario</button>
            </div>
            <br>
            <div class="modulo-header">Usuarios</div>
            <div class="modulo-content">
                <?php if ($result_usuarios->num_rows > 0) : ?>
                    <table>
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Correo</th>
                                <th>Teléfono</th>
                                <th>Documento</th>
                                <th>Tipo de documento</th>
                                <th>Departamento</th>
                                <th>Ciudad</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $result_usuarios->fetch_assoc()) : ?>
                                <tr>
                                    <td><?= $row['documento'] ?></td>
                                    <td><?= $row['nombre'] ?></td>
                                    <td><?= $row['apellido'] ?></td>
                                    <td><?= $row['correo'] ?></td>
                                    <td><?= $row['telefono'] ?></td>
                                    <td><?= $row['pais'] ?></td>
                                    <td><?= $row['departamento'] ?></td>
                                    <td><?= $row['ciudad'] ?></td>
                                    <td>
                                        <button class="modificar-button">
                                            <a href="modificar_cuenta.php?documento=<?= $row['documento'] ?>" style="color: white; text-decoration: none;">Modificar</a>
                                        </button>
                                        <button class="eliminar-button">
                                            <a href="eliminar_cuenta.php?documento=<?= $row['documento'] ?>" style="color: white; text-decoration: none;">Eliminar</a>
                                        </button>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                <?php else : ?>
                    <p>No hay registros disponibles.</p>
                <?php endif; ?>
            </div>
        </section>

        <!-- Módulo de Configuración -->
        <section class="modulo" id="configuracion">
            <div class="modulo-header">Configuración</div>
            <div class="modulo-content">
                <h2 class="titulos_configuracion">Configuración General</h2>
                <p class="parrafos_configuracion">Personaliza la información general de tu sistema.</p>
                <form id="configuracion-general-form" method="POST">
                    <label for="nombre_sistema">Nombre del Sistema:</label>
                    <input type="text" id="nombre_sistema" name="nombre_sistema" value="Mi Sistema de Gestión">
                    <br><br>
                    <label for="idioma">Idioma:</label>
                    <select id="idioma" name="idioma">
                        <option value="es">Español</option>
                        <option value="en">Inglés</option>
                        <option value="fr">Francés</option>
                    </select>
                    <br><br>
                    <label for="zona_horaria">Zona Horaria:</label>
                    <select id="zona_horaria" name="zona_horaria">
                        <option value="America/New_York">América/New York</option>
                        <option value="Europe/London">Europa/Londres</option>
                        <option value="Asia/Tokyo">Asia/Tokio</option>
                    </select>
                    <br><br>
                    <label for="modo_visual">Modo Visual:</label>
                    <select id="modo_visual" name="modo_visual">
                        <option value="claro">Modo Claro</option>
                        <option value="oscuro">Modo Oscuro</option>
                    </select>
                    <br><br>
                    <button type="submit" class="guardar-configuracion-button">Guardar Cambios</button>
                </form>
                <br>
                <h2 class="titulos_configuracion">Notificaciones por Correo Electrónico</h2>
                <p class="parrafos_configuracion">Configura las notificaciones por correo electrónico.</p>
                <form id="configuracion-correo-form" method="POST">
                    <label for="correo_notificaciones">Correo de Notificaciones:</label>
                    <input type="email" id="correo_notificaciones" name="correo_notificaciones" placeholder="ejemplo@dominio.com">
                    <br><br>
                    <label for="frecuencia_notificaciones">Frecuencia de Notificaciones:</label>
                    <select id="frecuencia_notificaciones" name="frecuencia_notificaciones">
                        <option value="diaria">Diaria</option>
                        <option value="semanal">Semanal</option>
                        <option value="mensual">Mensual</option>
                    </select>
                    <br><br>
                    <button type="submit" class="guardar-configuracion-button">Guardar Cambios</button>
                </form>
                <br>
                <h2 class="titulos_configuracion">Seguridad</h2>
                <p class="parrafos_configuracion">Configura las opciones de seguridad del sistema.</p>
                <form id="configuracion-seguridad-form" method="POST">
                    <label for="politica_contrasenas">Política de Contraseñas:</label>
                    <input type="checkbox" id="politica_contrasenas" name="politica_contrasenas" value="activada"> Activada
                    <br>
                    <br>
                    <label for="autenticacion_dos_factores">Autenticación de Dos Factores:</label>
                    <input type="checkbox" id="autenticacion_dos_factores" name="autenticacion_dos_factores" value="activada"> Activada
                    <br>
                    <br>
                    <button type="submit" class="guardar-configuracion-button">Guardar Cambios</button>
                </form>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 TicketPro+ - Todos los derechos reservados</p>
    </footer>
</body>

<script src="../../../assets/js/code.js"></script>

</html>






