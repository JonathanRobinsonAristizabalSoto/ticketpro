<?php
include '../../conections/config.php';

$sql_tickets_recientes = "SELECT t.id_ticket, t.titulo, t.estado, t.fecha_creacion, u.nombre, u.apellido 
                          FROM Ticket t 
                          JOIN Usuarios u ON t.id_usuario = u.id_usuario 
                          ORDER BY t.fecha_creacion DESC 
                          LIMIT 10";
$result_tickets_recientes = $conexion->query($sql_tickets_recientes);

$output = '';
while ($row = $result_tickets_recientes->fetch_assoc()) {
    $output .= '<tr>';
    $output .= '<td>' . htmlspecialchars($row['id_ticket']) . '</td>';
    $output .= '<td>' . htmlspecialchars($row['titulo']) . '</td>';
    $output .= '<td>' . ucfirst(htmlspecialchars($row['estado'])) . '</td>';
    $output .= '<td>' . htmlspecialchars($row['fecha_creacion']) . '</td>';
    $output .= '<td>' . htmlspecialchars($row['nombre']) . ' ' . htmlspecialchars($row['apellido']) . '</td>';
    $output .= '</tr>';
}

echo $output;
?>