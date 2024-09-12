<?php
include '../../connections/config.php';

try {
    // Verificar la conexión
    if ($conexion->connect_error) {
        throw new Exception("Error de conexión: " . $conexion->connect_error);
    }

    // Consulta SQL para obtener los programas
    $sql_programas = "SELECT id_programa, codigo, version, nombre, descripcion, duracion, linea_tecnologica, red_tecnologica, red_de_conocimiento, modalidad FROM Programas";
    $result_programas = $conexion->query($sql_programas);

    if (!$result_programas) {
        throw new Exception("Error en la consulta SQL: " . $conexion->error);
    }

    $lista_programas = '';
    $opciones_programas = '';
    $modalidades_programas = [];

    while ($row = $result_programas->fetch_assoc()) {
        $lista_programas .= '<tr>
            <td>' . htmlspecialchars($row['codigo']) . '</td>
            <td>' . htmlspecialchars($row['version']) . '</td>
            <td>' . htmlspecialchars($row['nombre']) . '</td>
            <td>' . htmlspecialchars($row['descripcion']) . '</td>
            <td>' . htmlspecialchars($row['duracion']) . '</td>
            <td>' . htmlspecialchars($row['linea_tecnologica']) . '</td>
            <td>' . htmlspecialchars($row['red_tecnologica']) . '</td>
            <td>' . htmlspecialchars($row['red_de_conocimiento']) . '</td>
            <td>' . htmlspecialchars($row['modalidad']) . '</td>
        </tr>';
        $opciones_programas .= '<option value="' . htmlspecialchars($row['id_programa']) . '" data-modalidad="' . htmlspecialchars($row['modalidad']) . '">' . htmlspecialchars($row['nombre']) . '</option>';
        $modalidades_programas[$row['id_programa']] = htmlspecialchars($row['modalidad']);
    }

    echo json_encode([
        'lista' => $lista_programas,
        'opciones' => $opciones_programas,
        'modalidades' => $modalidades_programas
    ]);

} catch (Exception $e) {
    echo json_encode([
        'error' => $e->getMessage()
    ]);
}
?>