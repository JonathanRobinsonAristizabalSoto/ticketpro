<?php
include '../../conections/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $programa = $_POST['programa']; // Cambiado de 'categoria' a 'programa'
    $id_usuario = $_SESSION['id_usuario']; // Asegúrate de que el ID del usuario esté en la sesión

    $sql = "INSERT INTO Ticket (id_usuario, titulo, descripcion, id_programa, fecha_creacion, estado) 
            VALUES (?, ?, ?, ?, NOW(), 'abierto')";
    if ($stmt = $conexion->prepare($sql)) {
        $stmt->bind_param("issi", $id_usuario, $titulo, $descripcion, $programa);
        $stmt->execute();
        $stmt->close();
        echo "Ticket creado exitosamente";
    } else {
        echo "Error: " . $conexion->error;
    }
}
?>