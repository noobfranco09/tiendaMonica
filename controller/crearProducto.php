<?php
require '../models/mySql.php';
$nombre = $_POST['nombreProducto'];
$descripcion = $_POST['descripcionProducto'];
$stock = $_POST['stockProducto'];
$precio = $_POST['precioProducto'];
$estado = 1;
$idProvedor = $_POST['idProvedor'];
$idTipoProducto = $_POST['idTipoProducto'];

$db = new Mysql();
$query = "insert into productos (nombre,descripcion,stock,precio,estado,idProvedor,idTipoProducto)
values (?,?,?,?,?,?,?)";
$tipos = "ssidiii";
$datos = [$nombre, $descripcion, $stock, $precio, $estado, $idProvedor, $idTipoProducto];
$resultado = $db->consultaPreparada($query, $tipos, $datos);
if ($resultado == true) {
    echo "agregado con éxito";
    header("Location: ../views/dashBoard.php");
}
;
?>