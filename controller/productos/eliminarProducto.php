<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/tiendaMonica/rutas/rutaGlobal.php';
require_once BASE_PATH . '/models/mySql.php';
require BASE_PATH . 'functions\helpers\session.php';
require_once BASE_PATH . "functions\dieAndDumb\depurar.php";

if (!isset($_POST['btnIdProducto'])) {
    $_SESSION['error'] = "No se seleccionó ningún producto";
    header('Location:' . BASE_URL . 'controller/dashBoard.php');
}

$idProducto = $_POST['btnIdProducto'];

$db = new Mysql();
$estado = "select estado from productos where idProducto = ?;";
$respuesta = $db->consultaPreparada($estado, "i", [$idProducto]);
if ($respuesta[0]['estado']===0) {
    $query1 = "update productos set estado = 1 where idProducto = ?; ";
    $tipoParametros = "i";
    $db->consultaPreparada($query1, $tipoParametros, [$idProducto]);
    $_SESSION['tipoMensaje'] = "exito";
    $_SESSION['mensaje'] = "Reactivado con éxito";
    header('Location:' . BASE_URL . 'controller/dashBoard.php');
    exit();
}
$query = "update productos set estado = 0 where idProducto = ? ";
$tipoParametros = "i";
$db->consultaPreparada($query, $tipoParametros, [$idProducto]);
$_SESSION['tipoMensaje'] = "exito";
$_SESSION['mensaje'] = "eliminado con éxito";
header('Location:' . BASE_URL . 'controller/dashBoard.php');
exit();
