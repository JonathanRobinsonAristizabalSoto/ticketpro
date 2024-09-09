<?php
include '../../connections/config.php';

// Consulta SQL para obtener las tipologías
$sql_tipologias = "SELECT id_tipologia, tipologia FROM Tipologias";
$result_tipologias = $conexion->query($sql_tipologias);

$tipologias = [];
while ($row = $result_tipologias->fetch_assoc()) {
    $tipologias[] = [
        'id' => $row['id_tipologia'],
        'nombre' => $row['tipologia']
    ];
}

echo json_encode($tipologias);
?>