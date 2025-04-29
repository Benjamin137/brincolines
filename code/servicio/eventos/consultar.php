<?php

require_once '../conexion.php';

$table = "EVENTOS";

$sql = "SELECT *
FROM $table
INNER JOIN CLIENTES ON id_cliente = idCliente_evento
INNER JOIN LUGARES ON id_lugar = idLugar_evento
INNER JOIN BRINCOLINES ON id_brincolin = idBrincolin_evento
INNER JOIN TIPOS_EVENTOS ON id_tipoEvento = idTipoEvento_evento
";
$result = $conexion->query($sql);

if ($result->num_rows > 0) {

    echo json_encode($result->fetch_all(MYSQLI_ASSOC));

} else {
    echo json_encode(array("mensaje" => "No se encontraron eventos."));
}

