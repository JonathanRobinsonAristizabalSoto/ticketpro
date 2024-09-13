<?php
// Ubicación del archivo: /pages/Tickes/get_mis_tickets.php

include '../../connections/config.php';
include '../Auth/auth_session.php';

try {
    // Verificar la conexión a la base de datos
    if ($conexion->connect_error) {
        throw new Exception("Error de conexión: " . $conexion->connect_error);
    }

    // Verificar si el usuario ha iniciado sesión
    if (!isset($_SESSION['usuario_id'])) {
        throw new Exception("Usuario no autenticado.");
    }

    // Obtener el ID del usuario actual desde la sesión
    $usuario_id = $_SESSION['usuario_id'];

    // Consulta SQL para obtener los tickets del usuario
    $sql_tickets = "
        SELECT t.id_ticket, t.numero_ticket, tp.tipologia AS tipologia, 
               tp.subtipologia AS subtipologia, p.nombre AS programa, 
               t.descripcion, t.estado, t.prioridad, t.fecha_creacion 
        FROM Ticket t
        JOIN Tipologias tp ON t.id_tipologia = tp.id_tipologia
        LEFT JOIN Programas p ON t.id_programa = p.id_programa
        WHERE t.id_usuario = ?
        ORDER BY t.id_ticket DESC";

    // Preparar la consulta
    $stmt = $conexion->prepare($sql_tickets);
    if (!$stmt) {
        throw new Exception("Error en la preparación de la consulta: " . $conexion->error);
    }

    // Asignar el parámetro del ID de usuario
    $stmt->bind_param("i", $usuario_id);
    $stmt->execute();
    $result_tickets = $stmt->get_result();

    if (!$result_tickets) {
        throw new Exception("Error en la ejecución de la consulta SQL: " . $conexion->error);
    }

    // Inicializar la salida HTML
    $output = '';
    while ($row = $result_tickets->fetch_assoc()) {
        // Determinar la clase CSS basada en el estado del ticket
        $estado_clase = '';
        switch (strtolower($row['estado'])) {
            case 'abierto':
                $estado_clase = 'ticket-abierto';
                break;
            case 'cerrado':
                $estado_clase = 'ticket-cerrado';
                break;
            case 'pendiente':
                $estado_clase = 'ticket-pendiente';
                break;
            case 'progreso':
                $estado_clase = 'ticket-progreso';
                break;
            case 'resuelto':
                $estado_clase = 'ticket-resuelto';
                break;
        }

        // Generar cada fila de la tabla con datos seguros para evitar XSS
        $output .= '<tr>';
        $output .= '<td>' . htmlspecialchars($row['id_ticket']) . '</td>';
        $output .= '<td>' . htmlspecialchars($row['numero_ticket']) . '</td>';
        $output .= '<td>' . htmlspecialchars($row['tipologia']) . '</td>';
        $output .= '<td>' . htmlspecialchars($row['subtipologia']) . '</td>';
        $output .= '<td>' . htmlspecialchars($row['programa']) . '</td>';
        $output .= '<td>' . htmlspecialchars($row['descripcion']) . '</td>';
        // Aplicar la clase CSS para el estado del ticket
        $output .= '<td class="' . $estado_clase . '">' . ucfirst(htmlspecialchars($row['estado'])) . '</td>';
        $output .= '<td>' . htmlspecialchars($row['prioridad']) . '</td>';
        $output .= '<td>' . htmlspecialchars($row['fecha_creacion']) . '</td>';
        $output .= '</tr>';
    }

    // Si no hay resultados, mostrar un mensaje apropiado
    if ($output === '') {
        $output = '<tr><td colspan="9">No se encontraron tickets para este usuario.</td></tr>';
    }

    // Imprimir la tabla con los tickets
    echo $output;
} catch (Exception $e) {
    // En caso de error, devolver el mensaje en formato JSON para su manejo en el frontend
    echo json_encode([
        'error' => $e->getMessage()
    ]);
}
