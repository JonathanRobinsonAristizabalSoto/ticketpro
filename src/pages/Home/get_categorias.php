<?php
include '../../conections/config.php';

$sql_categorias = "SELECT codigo, version, tipo_de_formacion, nombre, nivel_de_formacion, duracion, linea_tecnologica, red_tecnologica, red_de_conocimiento, modalidad FROM Categoria";
$result_categorias = $conexion->query($sql_categorias);

$lista_categorias = '';
$opciones_categorias = '';

while ($row = $result_categorias->fetch_assoc()) {
    $lista_categorias .= '<tr>
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
    $opciones_categorias .= '<option value="' . $row['codigo'] . '">' . $row['nombre'] . '</option>';
}

echo json_encode([
    'lista' => $lista_categorias,
    'opciones' => $opciones_categorias
]);
?>