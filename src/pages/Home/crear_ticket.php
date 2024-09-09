<?php
include '../../connections/config.php';

session_start();
if (!isset($_SESSION['documento']) || !isset($_SESSION['id_usuario'])) {
    header("Location: ../../index.php");
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
    $tipologia = $_POST['tipologia'];
    $programa = $_POST['programa'];
    $descripcion = $_POST['descripcion'];
    $prioridad = $_POST['prioridad'];
    $id_usuario = $_SESSION['id_usuario']; // Asegúrate de que el ID del usuario esté en la sesión
    $estado = "abierto"; // Estado inicial del ticket
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

    // Obtener el ID de la tipología seleccionada
    $sql_tipologia = "SELECT id_tipologia FROM Tipologias WHERE tipologia = ? AND tipo_de_solicitud = ?";
    if ($stmt = $conexion->prepare($sql_tipologia)) {
        $stmt->bind_param("ss", $tipologia, $tipo_solicitud);
        $stmt->execute();
        $stmt->bind_result($id_tipologia);
        $stmt->fetch();
        $stmt->close();
    } else {
        die("Error en la consulta de la tipología: " . $conexion->error);
    }

    // Generar número de ticket único
    $numero_ticket = generarNumeroTicket($conexion);

    // Depuración: Imprimir valores antes de la inserción
    error_log("Numero Ticket: $numero_ticket");
    error_log("Tipo Solicitud: $tipo_solicitud");
    error_log("Tipologia: $tipologia");
    error_log("Descripcion: $descripcion");
    error_log("Prioridad: $prioridad");
    error_log("Estado: $estado");
    error_log("ID Usuario: $id_usuario");
    error_log("ID Programa: $programa");
    error_log("ID Tipologia: $id_tipologia");
    error_log("Fecha Creacion: $fecha_creacion");
    error_log("Fecha Actualizacion: $fecha_actualizacion");

    // Insertar el nuevo ticket en la base de datos
    $sql_insertar = "INSERT INTO Ticket (numero_ticket, tipo_de_solicitud, tipologia, descripcion, prioridad, estado, id_usuario, id_programa, id_tipologia, fecha_creacion, fecha_actualizacion) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    if ($stmt = $conexion->prepare($sql_insertar)) {
        $stmt->bind_param("ssssssiisss", $numero_ticket, $tipo_solicitud, $tipologia, $descripcion, $prioridad, $estado, $id_usuario, $programa, $id_tipologia, $fecha_creacion, $fecha_actualizacion);
        if ($stmt->execute()) {
            echo "Ticket creado exitosamente";
        } else {
            error_log("Error al crear el ticket: " . $stmt->error);
            echo "Error al crear el ticket: " . $stmt->error;
        }
        $stmt->close();
    } else {
        die("Error en la preparación de la consulta: " . $conexion->error);
    }
}
?>