<?php
require_once '../conexion.php';

$table = "EVENTOS";

if(!isset($_POST["fechaInicio"]) || !isset($_POST["fechaFin"]) || !isset($_POST["idBrincolin"]) || !isset($_POST["idCliente"]) || !isset($_POST["idLugar"]) || !isset($_POST["idTipoEvento"])) {
    echo "Error: No se han enviado los datos necesarios.";
    die();
}
// YY-MM-IDTIPOEVENTO-IDLUGAR-IDBRINCOLIN-IDCLIENTE-IDEVENTO
$yy = date("y");
$mm = date("m");
$tipoEvento = (int)$_POST["idTipoEvento"];
$lugar = (int)$_POST["idLugar"];
$brincolin = (int)$_POST["idBrincolin"];
$cliente = (int)$_POST["idCliente"];
$fechaInicio = $_POST["fechaInicio"];
$fechaFin = $_POST["fechaFin"];
$folio = $yy . "-" . $mm . "-" . $tipoEvento . "-" . $lugar . "-" . $brincolin . "-" . $cliente;


$sql = "INSERT INTO $table(folio_evento, fecha_inicio_evento, fecha_fin_evento, idBrincolin_evento, idCliente_evento, idLugar_evento, idTipoEvento_evento)
VALUES ('NA', ?, ?, ?, ?, ?, ?)";
$stmt = $conexion->prepare($sql);
if(!$stmt) {
    die("Error en la preparación: " . $conexion->error);
}

$stmt->bind_param("ssiiii", $fechaInicio, $fechaFin, $brincolin, $cliente, $lugar, $tipoEvento);
$result = $stmt->execute(); // Ejecutar la consulta

$id = $conexion->insert_id; // Obtener el ID del último registro insertado

$folio .= "-" . $id; // Agregar el ID al folio

// Actualizar el folio con el ID del evento
$sql = "UPDATE $table SET folio_evento = ? WHERE id_evento = ?";
$stmt = $conexion->prepare($sql);
if(!$stmt) {
    die("Error en la preparación: " . $conexion->error);
}

$stmt->bind_param("si", $folio, $id);

$result = $stmt->execute(); // Ejecutar la consulta


if($result) {
    
    header("Location: ../../../brincolines/vistas/listar.php?tipo=eventos");
} else {
    echo "Error al crear el brincolin: " . $stmt->error;
}

// Cerrar statement
$stmt->close();
?>