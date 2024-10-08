<?php
include '../../connections/config.php';

// Consulta SQL para obtener los tickets recientes
$sql_tickets_recientes = "SELECT t.id_ticket, t.numero_ticket, tip.tipologia, tip.subtipologia, p.nombre AS programa, t.descripcion, t.estado, t.prioridad, u.nombre AS solicitado_por, a.nombre AS asignado_a, t.fecha_creacion 
                          FROM Ticket t 
                          JOIN Usuarios u ON t.id_usuario = u.id_usuario 
                          LEFT JOIN Usuarios a ON t.id_rol = a.id_usuario 
                          LEFT JOIN Programas p ON t.id_programa = p.id_programa
                          LEFT JOIN Tipologias tip ON t.id_tipologia = tip.id_tipologia
                          ORDER BY t.id_ticket DESC 
                          LIMIT 100";
$result_tickets_recientes = $conexion->query($sql_tickets_recientes);

$output = '';
while ($row = $result_tickets_recientes->fetch_assoc()) {
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

    $output .= '<tr>';
    $output .= '<td>' . htmlspecialchars($row['id_ticket']) . '</td>';
    $output .= '<td>' . htmlspecialchars($row['numero_ticket']) . '</td>';
    $output .= '<td>' . htmlspecialchars($row['tipologia']) . '</td>';
    $output .= '<td>' . htmlspecialchars($row['subtipologia']) . '</td>';
    $output .= '<td>' . htmlspecialchars($row['programa']) . '</td>';
    $output .= '<td>' . htmlspecialchars($row['descripcion']) . '</td>';
    $output .= '<td class="' . $estado_clase . '">' . ucfirst(htmlspecialchars($row['estado'])) . '</td>';
    $output .= '<td>' . htmlspecialchars($row['prioridad']) . '</td>';
    $output .= '<td>' . htmlspecialchars($row['solicitado_por']) . '</td>';
    $output .= '<td>' . htmlspecialchars($row['asignado_a']) . '</td>';
    $output .= '<td>' . htmlspecialchars($row['fecha_creacion']) . '</td>';
    $output .= '</tr>';
}

echo $output;
?>