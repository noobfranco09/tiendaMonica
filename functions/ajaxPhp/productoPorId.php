<?php
header('Content-Type: application/json');
require '../../models/mySql.php';
$db = new Mysql();
$data = json_decode(file_get_contents("php://input"), true);
if (!isset($data['idProducto'])) {
    http_response_code(400);
    echo json_encode(["error" => "Falta el id del producto"]);
    exit();
}
$id = $data['idProducto'];

try {
    $query = "select * from productos where idProducto =?";
    $resultado = $db->consultaPreparada($query, "i", [$id]);
    echo json_encode($resultado);
    $db->cerrarConexion();
    exit();
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["error" => "error interno $e"]);
}
?>