<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/tiendaMonica/rutas/rutaGlobal.php';
require_once BASE_PATH.'/models/mySql.php';
require BASE_PATH . 'functions\helpers\session.php';

if (!isset($_POST['btnIdProducto'])) {
    $_SESSION['error'] = "No se seleccionó ningún producto";
    header('Location:' . BASE_URL . 'controller/dashBoard.php');
}
$db= new Mysql();
$query="update productos set estado = 0 where idProducto = ? ";
$tipoParametros="i";
$idProducto = $_POST['btnIdProducto'];
$db->consultaPreparada($query,$tipoParametros,[$idProducto]);
 $_SESSION['mensaje'] = "eliminado con éxito";
    header('Location:' . BASE_URL . 'controller/dashBoard.php');
echo $idProducto;
?>