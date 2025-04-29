<?php
require_once '../conexion.php';

$table = "CLIENTES";

// Validar que se está enviando color y nombre



if(!isset($_POST["telefono"]) || !isset($_POST["nombre"])) {
    echo "Error: No se han enviado los datos necesarios.";
    die();
}

$telefono = $_POST["telefono"];
$nombre = $_POST["nombre"];

$sql = "INSERT INTO $table(telefono_cliente, nombreCompleto_cliente) VALUES(?, ?)";
$stmt = $conexion->prepare($sql);
if(!$stmt) {
    die("Error en la preparación: " . $conexion->error);
}

$stmt->bind_param("ss", $telefono, $nombre);

$result = $stmt->execute();

if($result) {
    
    header("Location: ../../../brincolines/vistas/listar.php?tipo=clientes");
} else {
    echo "Error al crear el brincolin: " . $stmt->error;
}

// Cerrar statement
$stmt->close();
?>