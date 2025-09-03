<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/tiendaMonica/rutas/rutaGlobal.php';
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location:'.BASE_URL.'views/login.php');
    exit();
}

require_once BASE_PATH . 'models/mySql.php';
$db = new Mysql();
$consulta = "select*from insumos where estado = 1";



$resultado = $db->consultaPreparada($consulta);
if(!$resultado || empty($resultado))
{
    $_SESSION['error']="No hay insumos para mostrar";
    
    // header('Location:'.BASE_URL.'views/dashBoard.php');
    // exit();
}
require_once BASE_PATH.'views/layouts/error/error.php';
require BASE_PATH.'views/insumos/dashBoardInsumos.php';

?>