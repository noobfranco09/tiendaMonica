<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/tiendaMonica/rutas/rutaGlobal.php';
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location:' . BASE_URL . 'views/login.php');
    exit();
}



require_once BASE_PATH . '/models/mySql.php';
$db = new Mysql();
$query = "SELECT 
    provedores.idProvedor,
    provedores.nombre AS nombreProvedor,
    provedores.contacto,
    provedores.estado AS estadoProvedor,
    categorias.idCategoria,
    categorias.nombre AS nombreCategoria,
    categorias.descripcion,
    categorias.estado AS estadoCategoria
FROM provedores_has_categorias 
INNER JOIN provedores ON provedores.idProvedor = provedores_has_categorias.idProvedor 
INNER JOIN categorias ON categorias.idCategoria = provedores_has_categorias.idCategoria 
WHERE provedores.estado = 1 
ORDER BY provedores.idProvedor
 ";
$queryProvedores = "select * from provedores ";
$provedores = $db->consultaPreparada($queryProvedores);
$categoriasProvedor = $db->consultaPreparada($query);


$queryCategorias = "select * from categorias";
$categorias = $db->consultaPreparada($queryCategorias);
$db->cerrarConexion();

require_once BASE_PATH . '/views/layouts/error/error.php';
require BASE_PATH . 'views/provedores/dashBoardProvedores.php';

?>