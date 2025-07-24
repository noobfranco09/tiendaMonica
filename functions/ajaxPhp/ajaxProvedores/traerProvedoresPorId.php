<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/tiendaMonica/rutas/rutaGlobal.php';
header('Content-Type: application/json');
require_once BASE_PATH.'/models/mySql.php';
$db = new Mysql();
$data = json_decode(file_get_contents("php://input"), true);
if (!isset($data['idProvedor'])) {
    http_response_code(400);
    echo json_encode(["error" => "Falta el id del provedor"]);
    exit();
}
$id = $data['idProvedor'];

try {
    $query = "select * from provedores where idProvedor =?";
    $resultado = $db->consultaPreparada($query, "i", [$id]);
    echo json_encode($resultado);
    $db->cerrarConexion();
    exit();
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["error" => "error interno $e"]);
}
?>