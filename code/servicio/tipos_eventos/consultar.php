<?php

require_once '../conexion.php';

$table = "TIPOS_EVENTOS";

$sql = "SELECT * FROM $table";
$result = $conexion->query($sql);

if ($result->num_rows > 0) {

    echo json_encode($result->fetch_all(MYSQLI_ASSOC));

} else {
    echo json_encode(array("mensaje" => "No se encontraron lugares."));
}