<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/tiendaMonica/rutas/rutaGlobal.php';
require_once BASE_PATH . '/models/mySql.php';

header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"), true);

$idProducto = $data['idProducto'] ?? null;

if (!$idProducto) {
    echo json_encode(['error' => 'ID inválido']);
    exit;
}

$db = new Mysql();

// Producto
$producto = $db->consultaPreparada(
    "SELECT idProducto, nombre, descripcion, idTipoProducto 
     FROM productos 
     WHERE idProducto = ?",
    "i",
    [$idProducto]
);

if (empty($producto)) {
    echo json_encode(['error' => 'Producto no encontrado']);
    exit;
}

// Categorías
$categorias = $db->consultaPreparada(
    "SELECT idTipoProducto, nombre FROM tipoProducto;",
);

echo json_encode([
    'idProducto'       => $producto[0]['idProducto'],
    'nombre'           => $producto[0]['nombre'],
    'descripcion'      => $producto[0]['descripcion'],
    'idTipoProducto'   => $producto[0]['idTipoProducto'],
    'categorias'       => $categorias
]);
