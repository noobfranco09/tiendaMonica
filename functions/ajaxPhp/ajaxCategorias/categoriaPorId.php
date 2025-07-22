<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/tiendaMonica/rutas/rutaGlobal.php' ;
header('Content-Type: application/json');
require BASE_PATH.'/models/mySql.php';
$db = new Mysql();
$data = json_decode(file_get_contents("php://input"), true);
if (!isset($data['idCategoria'])) {
    http_response_code(400);
    echo json_encode(["error" => "Falta el id de la categoría"]);
    exit();
}
$id = $data['idCategoria'];

try {
    $query = "select * from categorias where idCategoria =?";
    $resultado = $db->consultaPreparada($query, "i", [$id]);
    echo json_encode($resultado);
    $db->cerrarConexion();
    exit();
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["error" => "error interno $e"]);
}
?>