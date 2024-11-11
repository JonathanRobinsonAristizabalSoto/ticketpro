<?php
include_once '../../connections/config.php'; 

// Verificar si la conexión se estableció correctamente
if (!$conexion) {
    die("Error: No se pudo conectar a la base de datos. " . mysqli_connect_error());
} else {
    echo "Conexión a la base de datos exitosa.<br>";
}

// Obtener los datos enviados por el formulario
$tipologia = $_POST['tipologia'];
$subtipologia = $_POST['subtipologia'];
$programa = $_POST['programa'];
$descripcion = $_POST['descripcion'];
$prioridad = $_POST['prioridad'];

// Mostrar los datos recibidos para depuración
echo "Datos recibidos:<br>";
var_dump($_POST);

// Validar si todos los datos requeridos están presentes
if (!$tipologia || !$subtipologia || !$programa || !$descripcion || !$prioridad) {
    die("Por favor, complete todos los campos del formulario.");
}

// Definir el id_usuario y id_rol (esto debe ser obtenido de la sesión o de alguna otra fuente)
$id_usuario = 1; // Ejemplo: ID del usuario que está creando el ticket
$id_rol = 1; // Ejemplo: ID del rol del usuario que está creando el ticket

// Mostrar los valores de las variables antes de la inserción
echo "Valores a insertar:<br>";
var_dump($tipologia, $subtipologia, $programa, $descripcion, $prioridad, $id_usuario, $id_rol);

// Preparar la consulta para insertar el ticket
$sql = "INSERT INTO ticket (id_usuario, numero_ticket, descripcion, prioridad, estado, id_rol, id_programa, id_tipologia, fecha_creacion, fecha_actualizacion)
        VALUES (?, ?, ?, ?, 'Abierto', ?, ?, ?, NOW(), NOW())";

// Mostrar la consulta SQL para depuración
echo "Consulta SQL: $sql<br>";

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