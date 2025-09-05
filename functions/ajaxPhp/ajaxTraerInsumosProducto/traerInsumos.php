<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/tiendaMonica/rutas/rutaGlobal.php';
header('Content-Type: application/json');
require_once BASE_PATH . '/models/mySql.php';

$db = new Mysql();
$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['idProducto'])) {
    http_response_code(400);
    echo json_encode(["error" => "Falta el id del producto"]);
    exit();
}

$id = $data['idProducto'];

try {
    $query = "SELECT i.nombre, i.descripcion, i.cantidad 
              FROM insumos_has_productos ip
              INNER JOIN insumos i ON i.idInsumo = ip.idInsumo
              INNER JOIN productos p ON p.idProducto = ip.idProducto
              WHERE p.idProducto = ? AND i.estado = 1";
    
    $resultado = $db->consultaPreparada($query, "i", [$id]);

    echo json_encode($resultado);
    $db->cerrarConexion();
    exit();

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["error" => "Error interno: " . $e->getMessage()]);
}
?>
