<?php
include '../../conections/config.php';

$sql_categorias = "SELECT id_categoria, nombre FROM Categoria";
$result_categorias = $conexion->query($sql_categorias);

$lista_categorias = '';
$opciones_categorias = '';

while ($row = $result_categorias->fetch_assoc()) {
    $lista_categorias .= '<li>' . $row['nombre'] . '</li>';
    $opciones_categorias .= '<option value="' . $row['id_categoria'] . '">' . $row['nombre'] . '</option>';
}

echo json_encode([
    'lista' => $lista_categorias,
    'opciones' => $opciones_categorias
]);
?>