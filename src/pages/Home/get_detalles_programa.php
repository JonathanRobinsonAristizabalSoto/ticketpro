<?php
include '../../connections/config.php';

if (isset($_GET['programa'])) {
    $programa_id = $_GET['programa'];

    // Consulta SQL para obtener los detalles del programa
    $sql_detalles = "SELECT modalidad FROM Programas WHERE id_programa = ?";
    $stmt = $conexion->prepare($sql_detalles);
    $stmt->bind_param("i", $programa_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo json_encode(['modalidad' => $row['modalidad']]);
    } else {
        echo json_encode(['error' => 'No se encontraron detalles para el programa seleccionado.']);
    }

    $stmt->close();
} else {
    echo json_encode(['error' => 'ID de programa no proporcionado.']);
}

$conexion->close();
?>