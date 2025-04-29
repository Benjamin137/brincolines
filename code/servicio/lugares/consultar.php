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

    $data = $result->fetch_all(MYSQLI_ASSOC);
    if(isset($_GET['select']) && $_GET['select'] == 'true') {
      
        $data = array_map(function($brincolin) {
            return [
                'value' => $brincolin['id_lugar'],
                'label' => $brincolin['direccion_lugar']
            ];
        }, $data);
    }
    echo json_encode($data);

} else {
    echo json_encode(array("mensaje" => "No se encontraron lugares."));
}

