<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/tiendaMonica/rutas/rutaGlobal.php';
require BASE_PATH.'/models/mySql.php';

session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location:' .BASE_URL.'views/login.php');
    exit();
}
$db = new Mysql();
require BASE_PATH.'views/layouts/error/error.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (
        !isset($_POST['nombreProducto']) || !isset($_POST['descripcionProducto'])
        || !isset($_POST['stockProducto']) || !isset($_POST['precioProducto']) ||
        !isset($_POST['idProvedor']) || !isset($_POST['idTipoProducto'])
    ) {
        $_SESSION['error']="Por favor, llene todos los campos";
        header('Location:'.BASE_URL.'controller/productos/crearProducto.php');
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

    if ($resultado) {
        
        $_SESSION['mensaje']="Agregado con éxito";
        header('Location:'.BASE_URL. 'controller/dashBoard.php');
        exit();
    }
    ;
}
$queryProvedores = "select * from provedores";
$queryTipoProducto = "select * from tipoProducto";

$provedores = $db->consultaPreparada($queryProvedores);
$tipoProducto = $db->consultaPreparada($queryTipoProducto);
if (empty($provedores)) {
    header('Location:'.BASE_URL. 'controller/provedores.php?error=provedor ');
    exit();
}

if (empty($tipoProducto)) {
    header('Location:'.BASE_URL.'controller/categoriaProducto.php?error=producto ');
    exit();
}
require BASE_PATH.'/views/crearProducto.php';

?>