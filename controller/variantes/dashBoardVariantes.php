<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/tiendaMonica/rutas/rutaGlobal.php';
require BASE_PATH . '/models/mySql.php';

session_start();
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
    p.nombre AS nombre_producto,
    c.nombre AS color,
    t.nombre AS talla
FROM variantes v
LEFT JOIN productos p ON v.productos_idProducto = p.idProducto
LEFT JOIN colores c ON v.colores_idColor = c.idColor
LEFT JOIN tallas t ON v.tallas_idTalla = t.idTalla
ORDER BY v.idVariante DESC
";


$variantes = $db->consultaPreparada($query);

require BASE_PATH . 'views\variantes\dashBoardVariantes.php';
?>
