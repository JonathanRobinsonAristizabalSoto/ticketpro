<?php
include '../../connections/config.php';
include '../Auth/auth_session.php';

try {
    // Verificar la conexión
    if ($conexion->connect_error) {
        throw new Exception("Error de conexión: " . $conexion->connect_error);
    }

    // Verificar si el usuario_id está definido en la sesión
    if (!isset($_SESSION['usuario_id'])) {
        throw new Exception("Usuario no autenticado.");
    }

    // Obtener el ID del usuario desde la sesión
    $usuario_id = $_SESSION['usuario_id'];

    // Consulta SQL para obtener los tickets del usuario actual con la información de la tipología, subtipología y programa
    $sql_tickets = "SELECT t.id_ticket, tp.tipologia AS tipologia, tp.subtipologia AS subtipologia, p.nombre AS programa, t.descripcion, t.estado, t.prioridad, t.fecha_creacion 
                    FROM Ticket t
                    JOIN Tipologias tp ON t.id_tipologia = tp.id_tipologia
                    LEFT JOIN Programas p ON t.id_programa = p.id_programa
                    WHERE t.id_usuario = ?";
    $stmt = $conexion->prepare($sql_tickets);
    if (!$stmt) {
        throw new Exception("Error en la preparación de la consulta: " . $conexion->error);
    }
    $stmt->bind_param("i", $usuario_id);
    $stmt->execute();
    $result_tickets = $stmt->get_result();

    if (!$result_tickets) {
        throw new Exception("Error en la consulta SQL: " . $conexion->error);
    }

    $tickets = [];
    while ($row = $result_tickets->fetch_assoc()) {
        $tickets[] = [
            'id_ticket' => htmlspecialchars($row['id_ticket']),
            'tipologia' => htmlspecialchars($row['tipologia']),
            'subtipologia' => htmlspecialchars($row['subtipologia']),
            'programa' => htmlspecialchars($row['programa']),
            'descripcion' => htmlspecialchars($row['descripcion']),
            'estado' => htmlspecialchars($row['estado']),
            'prioridad' => htmlspecialchars($row['prioridad']),
            'fecha_creacion' => htmlspecialchars($row['fecha_creacion'])
        ];
    }

    echo json_encode($tickets);

} catch (Exception $e) {
    echo json_encode([
        'error' => $e->getMessage()
    ]);
}
?>