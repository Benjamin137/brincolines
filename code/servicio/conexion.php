<?php

try {
    $host = "localhost";     // 'localhosy' 
    $user = "root";     // 'root'
    $password = ""; // ''
    $database = "brincolines";    // 'brincolines'

    // Crear conexión
    $conexion = new mysqli($host, $user, $password, $database);

    // Verificar errores
    if ($conexion->connect_error) {
        die("Error de conexión a la base de datos: " . $conexion->connect_error);
    }

    // Configurar charset (opcional pero recomendado)
    $conexion->set_charset("utf8");

} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>