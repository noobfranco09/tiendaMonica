<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location:' . BASE_URL . 'views/login.php');
    exit();
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/tiendaMonica/rutas/rutaGlobal.php';
require_once BASE_PATH . 'views/layouts/error/error.php';
require_once BASE_PATH . '/models/mySql.php';
$db = new Mysql();
$query = "select * from categorias ";
$categorias = $db->consultaPreparada($query);

if (!$categorias || empty($categorias)) {
    ;
    $_SESSION['mensaje'] = "No  hay provedores para mostrar";
    header('Location:' . BASE_URL . 'controller/categorias/dashBoardCAtegorias.php');
    exit();
}

require_once BASE_PATH . '/views/layouts/error/error.php';
require_once BASE_PATH . 'views/categorias/dashBoardCategorias.php';

?>