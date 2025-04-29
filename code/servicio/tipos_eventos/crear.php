<?php
require_once '../conexion.php';

$table = "TIPOS_EVENTOS";

// Validar que se está enviando color y nombre
if(!isset($_POST["descripcion"])) {
    echo "Error: No se han enviado los datos necesarios.";
    die();
}

$descripcion = $_POST["descripcion"];


$sql = "INSERT INTO $table(descripcion_tipoEvento) VALUES(?)";

$stmt = $conexion->prepare($sql);
if(!$stmt) {
    die("Error en la preparación: " . $conexion->error);
}

$stmt->bind_param("s", $descripcion);

$result = $stmt->execute();

if($result) {
    
    header("Location: ../../../brincolines/vistas/listar.php?tipo=tipos_eventos");
} else {
    echo "Error al crear la descripcion: " . $stmt->error;
}

// Cerrar statement
$stmt->close();
?>