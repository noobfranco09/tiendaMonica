<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/tiendaMonica/rutas/rutaGlobal.php';
require_once BASE_PATH . '/models/mySql.php';
require BASE_PATH . 'functions\helpers\session.php';

if (!isset($_POST['idProvedor'])) {
    $_SESSION['error'] = "No se seleccionó ningún provedor";
    header('Location:' . BASE_URL . 'controller/provedores/dashBoardProvedores.php');
}
$db = new Mysql();
$query = "update provedores set estado = 0 where idProvedor = ? ";
$tipoParametros = "i";
$idProvedor = $_POST['idProvedor'];
$db->consultaPreparada($query, $tipoParametros, [$idProvedor]);
$_SESSION['mensaje'] = "eliminado con éxito";
header('Location:' . BASE_URL . 'controller/provedores/dashBoardProvedores.php');
?>