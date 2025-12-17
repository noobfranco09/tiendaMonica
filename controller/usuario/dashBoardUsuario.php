<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/tiendaMonica/rutas/rutaGlobal.php';
require BASE_PATH . 'functions\helpers\session.php';

if(empty($_SESSION['usuario']) ){
    $_SESSION['cliente']="cliente";
}

require_once BASE_PATH . 'models/mySql.php';
$db = new Mysql();

$consulta = "
SELECT 
    idProducto,
    nombre,
    descripcion,
    imagen
FROM productos
WHERE estado = 1;
";


$resultado = $db->consultaPreparada($consulta);

if (!$resultado || empty($resultado)) {
    $_SESSION['error'] = "No hay variantes disponibles.";
}

require_once BASE_PATH . 'views/layouts/error/error.php';
require BASE_PATH . 'views/public/cliente/dashBoardCliente.php';
