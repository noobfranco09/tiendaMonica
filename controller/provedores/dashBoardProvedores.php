<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location:' . BASE_URL . 'views/login.php');
    exit();
}
require_once $_SERVER['DOCUMENT_ROOT'] . '/tiendaMonica/rutas/rutaGlobal.php';
require_once BASE_PATH . '/models/mySql.php';
$db = new Mysql();
$query = "select * from provedores";
$provedores = $db->consultaPreparada($query);

if (!$provedores || empty($provedores)) {
    ;
    $_SESSION['mensaje'] = "No  hay provedores para mostrar";
    header('Location:' . BASE_URL . 'controller/dashBoardProvedores.php');
    exit();
}

require_once BASE_PATH . '/views/layouts/error/error.php';
require BASE_PATH . 'views/provedores/dashBoardProvedores.php';

?>