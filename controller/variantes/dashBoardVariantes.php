<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/tiendaMonica/rutas/rutaGlobal.php';
require BASE_PATH . '/models/mySql.php';
require BASE_PATH . 'functions\helpers\session.php';

if (!isset($_SESSION['usuario'])) {
    header('Location:' . BASE_URL . 'views/login.php');
    exit();
}
$db = new Mysql();

$query = "
SELECT 
    v.idVariante,
    v.nombre AS nombre_variante,
    v.precio,
    v.stock,
    v.estado,
    p.nombre AS nombre_producto,
    c.nombre AS color,
    t.nombre AS talla
FROM variantes v
LEFT JOIN productos p ON v.productos_idProducto = p.idProducto
LEFT JOIN colores c ON v.colores_idColor = c.idColor
LEFT JOIN tallas t ON v.tallas_idTalla = t.idTalla
ORDER BY v.idVariante DESC
";
$query2 = "select * from tallas";
$query3 = "select * from colores where estado = 1";
$query4 = "select * from productos where estado = 1";


$tallas = $db->consultaPreparada($query2);
$colores = $db->consultaPreparada($query3);
$productos = $db->consultaPreparada($query4);



$variantes = $db->consultaPreparada($query);
require BASE_PATH . 'views\layouts\error\error.php';
require BASE_PATH . 'views\variantes\dashBoardVariantes.php';


?>