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
    $data = $result->fetch_all(MYSQLI_ASSOC);
    if(isset($_GET['select']) && $_GET['select'] == 'true') {
      
        $data = array_map(function($brincolin) use ($columnas) {
            return [
                'value' => $brincolin['id_brincolin'],
                'label' => $brincolin[$columnas['nombre']]
            ];
        }, $data);
    }
    echo json_encode($data);

} else {
    echo json_encode(array("mensaje" => "No se encontraron brincolines."));
}