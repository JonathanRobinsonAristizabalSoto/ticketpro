<?php
include '../../connections/config.php';

$sql_programas = "SELECT id_programa, codigo, version, tipo_de_formacion, nombre, nivel_de_formacion, duracion, linea_tecnologica, red_tecnologica, red_de_conocimiento, modalidad FROM Programas";
$result_programas = $conexion->query($sql_programas);

$lista_programas = '';
$opciones_programas = '';

while ($row = $result_programas->fetch_assoc()) {
    $lista_programas .= '<tr>
        <td>' . htmlspecialchars($row['codigo']) . '</td>
        <td>' . htmlspecialchars($row['version']) . '</td>
        <td>' . htmlspecialchars($row['tipo_de_formacion']) . '</td>
        <td>' . htmlspecialchars($row['nombre']) . '</td>
        <td>' . htmlspecialchars($row['nivel_de_formacion']) . '</td>
        <td>' . htmlspecialchars($row['duracion']) . '</td>
        <td>' . htmlspecialchars($row['linea_tecnologica']) . '</td>
        <td>' . htmlspecialchars($row['red_tecnologica']) . '</td>
        <td>' . htmlspecialchars($row['red_de_conocimiento']) . '</td>
        <td>' . htmlspecialchars($row['modalidad']) . '</td>
    </tr>';
    $opciones_programas .= '<option value="' . htmlspecialchars($row['id_programa']) . '" data-tipo="' . htmlspecialchars($row['tipo_de_formacion']) . '" data-modalidad="' . htmlspecialchars($row['modalidad']) . '">' . htmlspecialchars($row['nombre']) . '</option>';
}

echo json_encode([
    'lista' => $lista_programas,
    'opciones' => $opciones_programas
]);
?>