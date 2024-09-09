<?php
include '../../connections/config.php';

// Consulta SQL para obtener los tipos de solicitud únicos desde la tabla Tipologias
$sql_tipos_solicitud = "SELECT DISTINCT tipo_de_solicitud FROM Tipologias";
$result_tipos_solicitud = $conexion->query($sql_tipos_solicitud);

$tipos_solicitud = [];
while ($row = $result_tipos_solicitud->fetch_assoc()) {
    $tipos_solicitud[] = $row['tipo_de_solicitud'];
}

// Consulta SQL para obtener las tipologías asociadas a cada tipo de solicitud
$sql_tipologias = "SELECT tipo_de_solicitud, id_tipologia, tipologia FROM Tipologias";
$result_tipologias = $conexion->query($sql_tipologias);

$tipologias = [];
while ($row = $result_tipologias->fetch_assoc()) {
    $tipologias[$row['tipo_de_solicitud']][] = [
        'id' => $row['id_tipologia'],
        'nombre' => $row['tipologia']
    ];
}

echo json_encode(['tipos_solicitud' => $tipos_solicitud, 'tipologias' => $tipologias]);
?>