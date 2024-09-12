<?php
include '../../connections/config.php';

// Definir el orden cronológico de los estados
$orden_estados = ['Abierto', 'Progreso', 'Pendiente', 'Resuelto', 'Cerrado'];

// Consulta SQL para obtener los estados y sus conteos
$sql_tickets_estado = "SELECT estado, COUNT(*) as count FROM Ticket GROUP BY estado";
$result_tickets_estado = $conexion->query($sql_tickets_estado);

// Verificar si la consulta fue exitosa
if (!$result_tickets_estado) {
    die("Error en la consulta: " . $conexion->error);
}

// Almacenar los resultados en un array asociativo
$estados = [];
while ($row = $result_tickets_estado->fetch_assoc()) {
    $estados[$row['estado']] = $row['count'];
}

// Generar la salida en el orden cronológico definido
$output = '';
foreach ($orden_estados as $estado) {
    $output .= '<div class="estado ticket-' . htmlspecialchars(strtolower($estado)) . '">';
    $output .= '<h5>' . ucfirst(htmlspecialchars($estado)) . '</h5>';
    $output .= '<p>' . (isset($estados[$estado]) ? htmlspecialchars($estados[$estado]) : 0) . ' Tickets</p>';
    $output .= '</div>';
}

echo $output;
?>