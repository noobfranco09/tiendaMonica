<?php
require '../models/mySql.php';

session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: ../views/login.php');
    exit();
}
$db = new Mysql();

$queryProvedores = "select * from provedores";
$queryTipoProducto = "select * from tipoProducto";

$provedores = $db->consultaPreparada($queryProvedores);
$tipoProducto = $db->consultaPreparada($queryTipoProducto);
if (empty($provedores)) {
    header('Location: ../views/provedores.php?error=provedor ');
    exit();
}

if (empty($tipoProducto)) {
    header('Location: ../views/categoriaProducto.php?error=producto ');
    exit();
}
require'../views/crearProducto.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (
        !isset($_POST['nombreProducto']) || !isset($_POST['descripcionProducto'])
        || !isset($_POST['stockProducto']) || !isset($_POST['precioProducto']) ||
        !isset($_POST['idProvedor']) || !isset($_POST['idTipoProducto'])
    ) {
        header('Location: ../views/crearProducto.php?error=variablesVacias');
        exit();
    }

    $nombre = $_POST['nombreProducto'];
    $descripcion = $_POST['descripcionProducto'];
    $stock = $_POST['stockProducto'];
    $precio = $_POST['precioProducto'];
    $estado = 1;
    $idProvedor = $_POST['idProvedor'];
    $idTipoProducto = $_POST['idTipoProducto'];



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
} else {
    header("Location: ../views/crearProducto.php");
}


?>