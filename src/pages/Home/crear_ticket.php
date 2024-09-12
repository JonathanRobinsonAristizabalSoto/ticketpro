<?php
// Asegúrate de que la ruta de configuración sea correcta
include_once '../../conections/config.php'; 

// Verificar si la conexión se estableció correctamente
if (!$conexion) {
    die("Error: No se pudo conectar a la base de datos.");
}

// Obtener los datos enviados por el formulario
$tipo_solicitud = $_POST['tipo_solicitud'];
$tipologia = $_POST['tipologia'];
$programa = $_POST['programa'];
$descripcion = $_POST['descripcion'];
$prioridad = $_POST['prioridad'];

// Validar si todos los datos requeridos están presentes
if (!$tipo_solicitud || !$tipologia || !$programa || !$descripcion || !$prioridad) {
    die("Por favor, complete todos los campos del formulario.");
}

// Preparar la consulta para insertar el ticket
$sql = "INSERT INTO Ticket (tipo_de_solicitud, tipologia, programa, descripcion, prioridad, estado, fecha_creacion, fecha_actualizacion)
        VALUES (?, ?, ?, ?, ?, 'Abierto', NOW(), NOW())";

if ($stmt = $conexion->prepare($sql)) {
    // Vincular los parámetros
    $stmt->bind_param("sssss", $tipo_solicitud, $tipologia, $programa, $descripcion, $prioridad);

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
