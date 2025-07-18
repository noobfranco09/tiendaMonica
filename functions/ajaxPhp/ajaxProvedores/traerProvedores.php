<?php
header('Content-Type: application/json');
require '../../models/mySql.php';

$db = new Mysql();

try {
    // Consulta sin parámetros
    $query = "SELECT * FROM provedores";
    
    // Realizamos la consulta sin parámetros
    $resultado = $db->consultaPreparada($query);  // No necesitas pasar parámetros
    echo json_encode($resultado);  // Devolver los resultados en formato JSON
    
    $db->cerrarConexion();  // Cerrar la conexión a la base de datos
    exit();  // Finalizar el script correctamente
} catch (PDOException $e) {
    // Manejo de errores
    http_response_code(500);  // Error interno del servidor
    echo json_encode(["error" => "Error interno: " . $e->getMessage()]);  // Mostrar el error con el mensaje adecuado
}
?>
