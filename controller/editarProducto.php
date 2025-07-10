<?php
require '../models/mySql.php';
$idProducto=$_POST['idProducto'];
$nombre = $_POST['nombreProducto'];
$descripcion = $_POST['descripcionProducto'];
$stock = $_POST['stockProducto'];
$precio = $_POST['precioProducto'];
$idProvedor = $_POST['idProvedor'];
$idTipoProducto = $_POST['idTipoProducto'];

$db = new Mysql();
$query = "update productos set nombre = ?,descripcion = ?,stock = ?,precio = ?,idProvedor = ?, idTipoProducto = ? where idProducto = ?";
$tipos = "ssidiii";
$datos = [$nombre, $descripcion, $stock, $precio, $idProvedor, $idTipoProducto,$idProducto];
$resultado = $db->consultaPreparada($query, $tipos, $datos);
if ($resultado == true) {
    echo "editado  con éxito";
    header("Location: ../views/dashBoard.php");
}
;
?>