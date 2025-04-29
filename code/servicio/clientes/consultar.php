<?php

require_once '../conexion.php';

$table = "CLIENTES";

$columnas = [
    "nombre" => "nombreCompleto_cliente",
    "telefono" => "telefono_cliente",
];

$id = $_GET['id'] ?? null;

$sql = "SELECT * FROM $table";

if ($id) {
    $sql .= " WHERE id_cliente = $id";
}

$result = $conexion->query($sql);

if ($result->num_rows > 0) {

    echo json_encode($result->fetch_all(MYSQLI_ASSOC));

} else {
    echo json_encode(array("mensaje" => "No se encontraron brincolines."));
}

