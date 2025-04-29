<?php

require_once '../conexion.php';

$table = "BRINCOLINES";

$id = $_GET['id'] ?? null;

$columnas = [
    "color" => "color_brincolin",
    "nombre" => "nombre_brincolin"
];

$sql = "SELECT * FROM $table";

if ($id) {
    $sql .= " WHERE id_brincolin = $id";
}

$result = $conexion->query($sql);

if ($result->num_rows > 0) {

    echo json_encode( $result->fetch_all(MYSQLI_ASSOC));

} else {
    echo json_encode(array("mensaje" => "No se encontraron brincolines."));
}