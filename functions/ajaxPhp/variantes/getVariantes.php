<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/tiendaMonica/rutas/rutaGlobal.php';
require BASE_PATH . 'models/mySql.php';

header('Content-Type: application/json');
$data = json_decode(file_get_contents("php://input"), true);


if (!isset($data['idProducto'])) {
    echo json_encode(["error" => "Falta idProducto"]);
    exit;
}

$idProducto = intval($data['idProducto']);
$db = new Mysql();

$sql = "
    SELECT 
        p.nombre AS nombreProducto,
        p.imagen AS imagenProducto,
        v.idVariante,
        v.precio,
        v.stock,
        c.idColor,
        c.nombre AS nombreColor,
        c.codigo AS codigoHex,
        t.idTalla,
        t.nombre AS nombreTalla
    FROM variantes v
    INNER JOIN productos p ON p.idProducto = v.idProducto
    INNER JOIN colores c ON c.idColor = v.colores_idColor
    INNER JOIN tallas t ON t.idTalla = v.tallas_idTalla
    WHERE v.idProducto = ?
";

$rows = $db->consultaPreparada($sql, "i", [$idProducto]);

if (!$rows) {
    echo json_encode(["error" => "No se encontraron variantes"]);
    exit;
}

$variantes = [];
$colores = [];
$producto = [
    "nombre" => $rows[0]["nombreProducto"],
    "imagen" => $rows[0]["imagenProducto"]
];

foreach ($rows as $r) {

    // Variantes completas
    $variantes[] = [
        "idVariante" => $r["idVariante"],
        "precio"     => $r["precio"],
        "stock"      => $r["stock"],
        "idColor"    => $r["idColor"],
        "color"      => $r["nombreColor"],
        "hex"        => $r["codigoHex"],
        "idTalla"    => $r["idTalla"],
        "talla"      => $r["nombreTalla"],
    ];

    // Colores únicos
    if (!isset($colores[$r["idColor"]])) {
        $colores[$r["idColor"]] = [
            "idColor" => $r["idColor"],
            "nombre"  => $r["nombreColor"],
            "hex"     => $r["codigoHex"]
        ];
    }
}

echo json_encode([
    "producto"  => $producto,
    "colores"   => array_values($colores),
    "variantes" => $variantes
]);

exit;
