<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/tiendaMonica/rutas/rutaGlobal.php';
require BASE_PATH . 'functions\helpers\session.php';
if (!isset($_SESSION['usuario'])) {
    header('Location:'.BASE_URL.'views/login.php');
    exit();
}

require_once BASE_PATH . 'models/mySql.php';
$db = new Mysql();
$consulta = "select*from tipoProducto where estado = 1";



$categoriaProducto = $db->consultaPreparada($consulta);
if(!$categoriaProducto || empty($categoriaProducto))
{
    $_SESSION['error']="No hay categorías de producto para mostrar";
    
}
require_once BASE_PATH.'views/layouts/error/error.php';
require BASE_PATH.'views/tipoProductos/dashBoardTipoProductos.php';

?>