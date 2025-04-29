<?php

require_once '../conexion.php';

$table = "LUGARES";

$id = $_GET['id'] ?? null;

$sql = "SELECT * FROM $table";

if ($id) {
    $sql .= " WHERE id_lugar = $id";
}
$result = $conexion->query($sql);

if ($result->num_rows > 0) {

    echo json_encode($result->fetch_all(MYSQLI_ASSOC));

} else {
    echo json_encode(array("mensaje" => "No se encontraron lugares."));
}

