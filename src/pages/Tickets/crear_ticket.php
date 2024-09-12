<?php
include_once '../../connections/config.php'; 

// Verificar si la conexión se estableció correctamente
if (!$conexion) {
    die("Error: No se pudo conectar a la base de datos.");
}

// Obtener los datos enviados por el formulario
$tipologia = $_POST['tipologia'];
$subtipologia = $_POST['subtipologia'];
$programa = $_POST['programa'];
$descripcion = $_POST['descripcion'];
$prioridad = $_POST['prioridad'];

// Validar si todos los datos requeridos están presentes
if (!$tipologia || !$subtipologia || !$programa || !$descripcion || !$prioridad) {
    die("Por favor, complete todos los campos del formulario.");
}

// Preparar la consulta para insertar el ticket
$sql = "INSERT INTO Ticket (id_usuario, numero_ticket, descripcion, prioridad, estado, id_rol, id_programa, id_tipologia, fecha_creacion, fecha_actualizacion)
        VALUES (?, ?, ?, ?, 'Abierto', ?, ?, ?, NOW(), NOW())";

if ($stmt = $conexion->prepare($sql)) {
    // Generar un número de ticket único
    $numero_ticket = uniqid('TKT-');

    // Vincular los parámetros
    $stmt->bind_param("isssiii", $id_usuario, $numero_ticket, $descripcion, $prioridad, $id_rol, $programa, $tipologia);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo "Ticket creado exitosamente";
    } else {
        echo "Error al crear el ticket: " . $stmt->error;
    }

    // Cerrar la declaración preparada
    $stmt->close();
} else {
    echo "Error en la preparación de la consulta: " . $conexion->error;
}

// Cerrar la conexión
$conexion->close();
?>