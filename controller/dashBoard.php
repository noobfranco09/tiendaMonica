<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/tiendaMonica/rutas/rutaGlobal.php';
require BASE_PATH . 'functions\helpers\session.php';
if (!isset($_SESSION['usuario'])) {
    header('Location:' . BASE_URL . 'views/login.php');
    exit();
}

require_once BASE_PATH . 'models/mySql.php';
$db = new Mysql();
$consulta = "SELECT * from productos ;
";
$queryTipoproducto = "select * from tipoProducto where estado = 1";
$consultaInsumos="select * from insumos where estado = 1";
$insumos=$db->consultaPreparada($consultaInsumos);
$resultado = $db->consultaPreparada($consulta);
$tipoProducto = $db->consultaPreparada($queryTipoproducto);
if (!$resultado || empty($resultado)) {
    $_SESSION['error'] = "No hay productos para mostrar";
}
require_once BASE_PATH .'views/layouts/error/error.php';
require BASE_PATH . 'views/dashBoard.php';

?>