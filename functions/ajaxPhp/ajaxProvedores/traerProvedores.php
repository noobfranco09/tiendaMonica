

<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/tiendaMonica/rutas/rutaGlobal.php';
header('Content-Type: application/json');
require_once BASE_PATH.'/models/mySql.php';
$db = new Mysql();
try {
    $query = "select * from provedores where estado = 1";
    $resultado = $db->consultaPreparada($query, "i", );
    echo json_encode($resultado);
    $db->cerrarConexion();
    exit();
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["error" => "error interno $e"]);
}
?>