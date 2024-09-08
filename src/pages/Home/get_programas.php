<?php
include '../../conections/config.php';

$sql_programas = "SELECT id_programa, codigo, version, tipo_de_formacion, nombre, nivel_de_formacion, duracion, linea_tecnologica, red_tecnologica, red_de_conocimiento, modalidad FROM Programas";
$result_programas = $conexion->query($sql_programas);

$lista_programas = '';
$opciones_programas = '';

while ($row = $result_programas->fetch_assoc()) {
    $lista_programas .= '<tr>
        <td>' . $row['codigo'] . '</td>
        <td>' . $row['version'] . '</td>
        <td>' . $row['tipo_de_formacion'] . '</td>
        <td>' . $row['nombre'] . '</td>
        <td>' . $row['nivel_de_formacion'] . '</td>
        <td>' . $row['duracion'] . '</td>
        <td>' . $row['linea_tecnologica'] . '</td>
        <td>' . $row['red_tecnologica'] . '</td>
        <td>' . $row['red_de_conocimiento'] . '</td>
        <td>' . $row['modalidad'] . '</td>
    </tr>';
    $opciones_programas .= '<option value="' . $row['id_programa'] . '" data-tipo="' . $row['tipo_de_formacion'] . '" data-modalidad="' . $row['modalidad'] . '">' . $row['nombre'] . '</option>';
}

echo json_encode([
    'lista' => $lista_programas,
    'opciones' => $opciones_programas
]);
?>