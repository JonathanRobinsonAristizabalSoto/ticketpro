<?php
$file = 'C:/xampp/htdocs/ticketpro/logs/app.log';
$message = "Esto es una prueba de escritura en el log.\n";

// Intenta escribir en el archivo
if (file_put_contents($file, $message, FILE_APPEND) !== false) {
    echo "Escritura en el archivo de log exitosa.";
} else {
    echo "No se pudo escribir en el archivo de log.";
}
?>