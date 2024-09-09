<?php
include '../../../src/connections/config.php';

session_start();
if (!isset($_SESSION['documento']) || !isset($_SESSION['id_usuario'])) {
    header("Location: ../Auth/login.php");
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
        $error_message = "Error en la consulta del programa: " . $conexion->error;
        file_put_contents('../../../logs/app.log', $error_message . "\n", FILE_APPEND);
        die($error_message);
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
        $error_message = "Error en la consulta de la tipología: " . $conexion->error;
        file_put_contents('../../../logs/app.log', $error_message . "\n", FILE_APPEND);
        die($error_message);
    }

    // Generar número de ticket único
    $numero_ticket = generarNumeroTicket($conexion);

    // Depuración: Imprimir valores antes de la inserción
    $log_message = "Numero Ticket: $numero_ticket\n";
    $log_message .= "Tipo Solicitud: $tipo_solicitud\n";
    $log_message .= "Tipologia: $tipologia\n";
    $log_message .= "Descripcion: $descripcion\n";
    $log_message .= "Prioridad: $prioridad\n";
    $log_message .= "Estado: $estado\n";
    $log_message .= "ID Usuario: $id_usuario\n";
    $log_message .= "ID Programa: $programa\n";
    $log_message .= "ID Tipologia: $id_tipologia\n";
    $log_message .= "Fecha Creacion: $fecha_creacion\n";
    $log_message .= "Fecha Actualizacion: $fecha_actualizacion\n";
    file_put_contents('../../../logs/app.log', $log_message, FILE_APPEND);

    // Insertar el nuevo ticket en la base de datos
    $sql_insertar = "INSERT INTO Ticket (numero_ticket, tipo_de_solicitud, tipologia, descripcion, prioridad, estado, id_usuario, id_programa, id_tipologia, fecha_creacion, fecha_actualizacion) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    if ($stmt = $conexion->prepare($sql_insertar)) {
        $stmt->bind_param("ssssssiisss", $numero_ticket, $tipo_solicitud, $tipologia, $descripcion, $prioridad, $estado, $id_usuario, $programa, $id_tipologia, $fecha_creacion, $fecha_actualizacion);
        if ($stmt->execute()) {
            echo "Ticket creado exitosamente";
        } else {
            $error_message = "Error al crear el ticket: " . $stmt->error;
            file_put_contents('../../../logs/app.log', $error_message . "\n", FILE_APPEND);
            echo $error_message;
        }
        $stmt->close();
    } else {
        $error_message = "Error en la preparación de la consulta: " . $conexion->error;
        file_put_contents('../../../logs/app.log', $error_message . "\n", FILE_APPEND);
        die($error_message);
    }
}
?>