<?php
require_once '../conexion.php';

$table = "BRINCOLINES";

$columnas = [
    "color" => "color_brincolin",
    "nombre" => "nombre_brincolin"
];

// Validar que se está enviando color y nombre
if(!isset($_POST["color"]) || !isset($_POST["nombre"])) {
    echo "Error: No se han enviado los datos necesarios.";
    die();
}

$color = $_POST["color"];
$nombre = $_POST["nombre"];

$sql = "INSERT INTO $table(".$columnas["color"].", ".$columnas["nombre"].") VALUES(?, ?)";

$stmt = $conexion->prepare($sql);
if(!$stmt) {
    die("Error en la preparación: " . $conexion->error);
}

$stmt->bind_param("ss", $color, $nombre);

$result = $stmt->execute();

if($result) {
    
    header("Location: ../../../brincolines/vistas/listar.php?tipo=brincolines");
} else {
    echo "Error al crear el brincolin: " . $stmt->error;
}

// Cerrar statement
$stmt->close();
?>