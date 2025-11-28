<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/tiendaMonica/rutas/rutaGlobal.php';
require BASE_PATH . 'functions\helpers\session.php';

if (!isset($_SESSION['usuario'])) {
    header('Location:' . BASE_URL . 'views/noAutorizado.php');
    exit();
}

require_once BASE_PATH . 'models/mySql.php';
$db = new Mysql();

$consulta = "
SELECT 
    v.idVariante,
    v.nombre AS nombreVariante,
    v.imagen,
    v.stock,
    v.precio,
    p.nombre AS nombreProducto,
    p.descripcion,
    t.nombre AS talla,
    c.nombre AS color
FROM variantes v
INNER JOIN productos p ON v.productos_idProducto = p.idProducto
INNER JOIN tallas t ON v.tallas_idTalla = t.idTalla
INNER JOIN colores c ON v.colores_idColor = c.idColor
WHERE v.estado = 1 AND p.estado = 1;
";

$resultado = $db->consultaPreparada($consulta);

if (!$resultado || empty($resultado)) {
    $_SESSION['error'] = "No hay variantes disponibles.";
}

require_once BASE_PATH . 'views/layouts/error/error.php';
require BASE_PATH . 'views/public/cliente/dashBoardCliente.php';
