<?php
include '../../connections/config.php';

// Consulta SQL para obtener las subtipologías
$sql_subtipologias = "SELECT id_tipologia, subtipologia FROM Tipologias";
$result_subtipologias = $conexion->query($sql_subtipologias);

$subtipologias = [];
while ($row = $result_subtipologias->fetch_assoc()) {
    $subtipologias[] = [
        'id' => $row['id_tipologia'],
        'nombre' => $row['subtipologia']
    ];
}

echo json_encode($subtipologias);
?>