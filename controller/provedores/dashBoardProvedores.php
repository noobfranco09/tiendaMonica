<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/tiendaMonica/rutas/rutaGlobal.php';
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location:' . BASE_URL . 'views/login.php');
    exit();
}



require_once BASE_PATH . '/models/mySql.php';
$db = new Mysql();
$query = "SELECT * from provedores where estado = 0";
$queryProvedores = "select * from provedores ";
$provedores = $db->consultaPreparada($queryProvedores);
$categoriasProvedor = $db->consultaPreparada($query);


$queryCategorias = "select * from categorias";
$categorias = $db->consultaPreparada($queryCategorias);
$db->cerrarConexion();

require_once BASE_PATH . '/views/layouts/error/error.php';
require BASE_PATH . 'views/provedores/dashBoardProvedores.php';

?>