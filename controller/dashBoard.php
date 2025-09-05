<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/tiendaMonica/rutas/rutaGlobal.php';
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location:' . BASE_URL . 'views/login.php');
    exit();
}

require_once BASE_PATH . 'models/mySql.php';
$db = new Mysql();
$consulta = "SELECT * from productos WHERE estado = 1;
";
$queryTipoproducto = "select * from tipoProducto where estado = 1";
$queryProvedores = "select * from provedores where estado = 1";
$queryInsumos="select * from insumos where estado = 1";


$resultado = $db->consultaPreparada($consulta);
$insumos = $db->consultaPreparada($queryInsumos);
$tipoProducto = $db->consultaPreparada($queryTipoproducto);
$provedores = $db->consultaPreparada($queryProvedores);
if (!$resultado || empty($resultado)) {
    $_SESSION['error'] = "No hay productos para mostrar";

    // header('Location:'.BASE_URL.'views/dashBoard.php');
    // exit();
}
require_once BASE_PATH . 'views/layouts/error/error.php';
require BASE_PATH . 'views/dashBoard.php';

?>