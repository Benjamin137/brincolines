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
    $data = $result->fetch_all(MYSQLI_ASSOC);
    if (isset($_GET['select']) && $_GET['select'] == 'true') {

        $data = array_map(function ($brincolin) {
            return [
                'value' => $brincolin['id_cliente'],
                'label' => $brincolin['nombreCompleto_cliente'],
            ];
        }, $data);
    }
    echo json_encode($data);
} else {
    echo json_encode(array("mensaje" => "No se encontraron brincolines."));
}
