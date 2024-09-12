<?php
include '../../connections/config.php';

// Consulta SQL para obtener las tipologías únicas desde la tabla Tipologias
$sql_tipologias = "SELECT DISTINCT tipologia FROM Tipologias";
$result_tipologias = $conexion->query($sql_tipologias);

$tipologias = [];
while ($row = $result_tipologias->fetch_assoc()) {
    $tipologias[] = $row['tipologia'];
}

// Consulta SQL para obtener las subtipologías asociadas a cada tipología
$sql_subtipologias = "SELECT tipologia, id_tipologia, subtipologia FROM Tipologias";
$result_subtipologias = $conexion->query($sql_subtipologias);

$subtipologias = [];
while ($row = $result_subtipologias->fetch_assoc()) {
    $subtipologias[$row['tipologia']][] = [
        'id' => $row['id_tipologia'],
        'nombre' => $row['subtipologia']
    ];
}

echo json_encode(['tipologias' => $tipologias, 'subtipologias' => $subtipologias]);
?>