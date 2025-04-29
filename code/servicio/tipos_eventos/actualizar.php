<?php

require_once '../conexion.php';

$table = "TIPOS_EVENTOS";

$columnas = [
    "id" => "id_tipoEvento",
    "descripcion" => "descripcion_tipoEvento",
  

];


if(!isset($_POST['id'])) {
    echo "Error: ID no proporcionado.";
    die();
}

$id = $_POST['id'];

unset($_POST['id']);

$sql = "UPDATE $table SET ";

foreach ($_POST as $key => $value) {
    if (array_key_exists($key, $columnas)) {
        $sql .= $columnas[$key] . " = '" . $value . "', ";
    }
}
 
$sql = rtrim($sql, ", "); // Eliminar la última coma y espacio

$sql .= " WHERE id_tipoEvento = " .$id. ";"; // Agregar la condición WHERE

$conexion->query($sql);
if ($conexion->error) {
    echo "Error: " . $conexion->error;
} else {
    
    header("Location: ../../../brincolines/vistas/listar.php?tipo=tipos_eventos");
}

?>