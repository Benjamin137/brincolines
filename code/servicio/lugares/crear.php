<?php
require_once '../conexion.php';

$table = "LUGARES";

// Validar que se está enviando color y nombre
if(!isset($_POST["direccion"])) {
    echo "Error: No se han enviado los datos necesarios.";
    die();
}

$direccion = $_POST["direccion"];


$sql = "INSERT INTO $table(direccion_lugar) VALUES(?)";

$stmt = $conexion->prepare($sql);
if(!$stmt) {
    die("Error en la preparación: " . $conexion->error);
}

$stmt->bind_param("s", $direccion);

$result = $stmt->execute();

if($result) {
    header("Location: ../../../brincolines/vistas/listar.php?tipo=lugares");

} else {
    echo "Error al crear el lugar: " . $stmt->error;
}

// Cerrar statement
$stmt->close();
?>