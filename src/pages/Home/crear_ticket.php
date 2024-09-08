<?php
include '../../conections/config.php';

session_start();
if (!isset($_SESSION['documento']) || !isset($_SESSION['id_usuario'])) {
    header("Location: ../../index.php");
    exit;
}

if (isset($_POST['cerrar_sesion'])) {
    session_unset(); // Eliminar todas las variables de sesión
    session_destroy(); // Destruir la sesión
    header("Location: ../../../index.php");
    exit;
}

function generarNumeroTicket($conexion) {
    $caracteres = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $longitud = 6; // Ajustado a 6 caracteres para coincidir con la estructura de la tabla
    $esUnico = false;

    do {
        $numero_ticket = '';
        for ($i = 0; $i < $longitud; $i++) {
            $numero_ticket .= $caracteres[rand(0, strlen($caracteres) - 1)];
        }

        // Verificar si el número de ticket ya existe en la base de datos
        $sql_verificar = "SELECT id_ticket FROM Ticket WHERE numero_ticket = ?";
        if ($stmt = $conexion->prepare($sql_verificar)) {
            $stmt->bind_param("s", $numero_ticket);
            $stmt->execute();
            $stmt->store_result();
            if ($stmt->num_rows == 0) {
                $esUnico = true;
            }
            $stmt->close();
        }
    } while (!$esUnico);

    return $numero_ticket;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tipo_solicitud = $_POST['tipo_solicitud'];
    $programa = $_POST['programa'];
    $descripcion = $_POST['descripcion'];
    $prioridad = $_POST['prioridad'];
    $id_usuario = $_SESSION['id_usuario']; // Asegúrate de que el ID del usuario esté en la sesión
    $titulo = "Título de ejemplo"; // Ajusta esto según tus necesidades
    $estado = "Abierto"; // Estado inicial del ticket
    $fecha_creacion = date('Y-m-d');
    $fecha_actualizacion = date('Y-m-d');

    // Obtener tipo de formación y modalidad del programa seleccionado
    $sql_programa = "SELECT tipo_de_formacion, modalidad FROM Programas WHERE id_programa = ?";
    if ($stmt = $conexion->prepare($sql_programa)) {
        $stmt->bind_param("i", $programa);
        $stmt->execute();
        $stmt->bind_result($tipo_de_formacion, $modalidad);
        $stmt->fetch();
        $stmt->close();
    } else {
        die("Error en la consulta del programa: " . $conexion->error);
    }

    // Generar número de ticket único
    $numero_ticket = generarNumeroTicket($conexion);

    // Insertar el nuevo ticket en la base de datos
    $sql_insertar = "INSERT INTO Ticket (numero_ticket, tipo_de_solicitud, titulo, descripcion, prioridad, estado, id_usuario, id_programa, fecha_creacion, fecha_actualizacion) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    if ($stmt = $conexion->prepare($sql_insertar)) {
        $stmt->bind_param("ssssssiiss", $numero_ticket, $tipo_solicitud, $titulo, $descripcion, $prioridad, $estado, $id_usuario, $programa, $fecha_creacion, $fecha_actualizacion);
        if ($stmt->execute()) {
            echo "Ticket creado exitosamente";
        } else {
            echo "Error al crear el ticket: " . $stmt->error;
        }
        $stmt->close();
    } else {
        die("Error en la preparación de la consulta: " . $conexion->error);
    }
}
?>