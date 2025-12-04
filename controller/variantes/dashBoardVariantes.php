<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/tiendaMonica/rutas/rutaGlobal.php';
require BASE_PATH . '/models/mySql.php';
require BASE_PATH . 'functions\helpers\session.php';

if (!isset($_SESSION['usuario'])) {
    header('Location:' . BASE_URL . 'views/login.php');
    exit();
}

$db = new Mysql();

/* Traer colores */
$colores = "SELECT * FROM colores WHERE estado = 1";
$resultadoColores = $db->consultaPreparada($colores);

/* Traer tallas */
$tallas = "SELECT * FROM tallas WHERE estado = 1";
$resultadoTallas = $db->consultaPreparada($tallas);

/* 1. Traer productos */
$sqlProductos = "
SELECT 
    p.idProducto,
    p.nombre AS nombre_producto,
    p.descripcion,
    p.imagen
FROM productos p
WHERE p.estado = 1
";
$productos = $db->consultaPreparada($sqlProductos);

/* 2. Traer variantes por producto */
$sqlVariantes = "
SELECT 
    v.idVariante,
    v.idProducto,
    v.nombre AS nombre_variante,
    v.precio,
    v.stock,
    v.estado,
    v.imagen,
    c.nombre AS color,
    t.nombre AS talla
FROM variantes v
LEFT JOIN colores c ON c.idColor = v.colores_idColor
LEFT JOIN tallas t ON t.idTalla = v.tallas_idTalla
WHERE v.estado = 1
";
$variantes = $db->consultaPreparada($sqlVariantes);

/* 3. Agrupar variantes dentro de productos */
$resultado = [];

foreach ($productos as $prod) {
    $resultado[] = [
        "idProducto" => $prod["idProducto"],
        "nombreProducto" => $prod["nombre_producto"],
        "descripcion" => $prod["descripcion"],
        "imagen" => $prod["imagen"],
        "variantes" => array_values(array_filter($variantes, function ($v) use ($prod) {
            return $v['idProducto'] == $prod['idProducto'];
        }))
    ];
}

require BASE_PATH . 'views/layouts/error/error.php';
require BASE_PATH . 'views/variantes/dashBoardVariantes.php';
