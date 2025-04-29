<?php

require_once '../conexion.php';

$table = "TIPOS_EVENTOS";

$sql = "SELECT * FROM $table";
$result = $conexion->query($sql);

if ($result->num_rows > 0) {

    $data = $result->fetch_all(MYSQLI_ASSOC);
    if(isset($_GET['select']) && $_GET['select'] == 'true') {
      
        $data = array_map(function($brincolin) {
            return [
                'value' => $brincolin['id_tipoEvento'],
                'label' => $brincolin['descripcion_tipoEvento']
            ];
        }, $data);
    }
    echo json_encode($data);

} else {
    echo json_encode(array("mensaje" => "No se encontraron lugares."));
}