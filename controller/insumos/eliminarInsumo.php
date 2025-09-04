<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/tiendaMonica/rutas/rutaGlobal.php';
require_once BASE_PATH.'/models/mySql.php';
if (!isset($_POST['idInsumo'])) {
    $_SESSION['error'] = "No se seleccionó ningún insumo";
    header('Location:' . BASE_URL . 'controller/insumos/dashBoardInsumos.php');
}
$db= new Mysql();
$query="update insumos set estado = 0 where idInsumo = ? ";
$tipoParametros="i";
$idInsumo = $_POST['idInsumo'];
$db->consultaPreparada($query,$tipoParametros,[$idInsumo]);
 $_SESSION['mensaje'] = "eliminado con éxito";
    header('Location:' . BASE_URL . 'controller/insumos/dashBoardInsumos.php');
?>