<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/tiendaMonica/rutas/rutaGlobal.php';
require_once BASE_PATH.'/models/mySql.php';
if (!isset($_POST['eliminarIdCategoria'])) {
    $_SESSION['error'] = "No se seleccionó ninguna categoría";
    header('Location:' . BASE_URL . 'controller/categorias/dashBoardCategorias.php');
}
$db= new Mysql();
$query="update categorias set estado = 0 where idCategoria = ? ";
$tipoParametros="i";
$idCategoria = $_POST['eliminarIdCategoria'];
$db->consultaPreparada($query,$tipoParametros,[$idCategoria]);
 $_SESSION['mensaje'] = "eliminado con éxito";
    header('Location:' . BASE_URL . 'controller/categorias/dashBoardCategorias.php');
?>