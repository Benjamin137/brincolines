<?php

require_once '../conexion.php';

$table = "EVENTOS";

$columnas = [
    "id" => "id_evento",
    "folio" => "folio_evento",
    "fechaInicio" => "fecha_inicio_evento",
    "fechaFin" => "fecha_fin_evento",
    "idBrincolin" => "idBrincolin_evento",
    "idCliente" => "idCliente_evento",
    "idLugar" => "idLugar_evento",
    "idTipoEvento" => "idTipoEvento_evento",

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

$sql .= " WHERE id_evento = " .$id. ";"; // Agregar la condición WHERE

$conexion->query($sql);
if ($conexion->error) {
    echo "Error: " . $conexion->error;
} else {
    echo "Actualización exitosa.";
}

?>