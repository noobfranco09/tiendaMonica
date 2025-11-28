<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/tiendaMonica/rutas/rutaGlobal.php';
require BASE_PATH . '/models/mySql.php';

require BASE_PATH . 'functions\helpers\session.php';
if (!isset($_SESSION['usuario'])) {
    header('Location:' . BASE_URL . 'views/login.php');
    exit();
}
$db = new Mysql();
require BASE_PATH . 'views/layouts/error/error.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (
        !isset($_POST['nombre']) || !isset($_POST['descripcion'])
        || !isset($_POST['cantidad'])
    ) {
        $_SESSION['error'] = "Por favor, llene todos los campos";
        header('Location:' . BASE_URL . 'controller/insumos/dashBoardInsumos.php');
        exit();
    }

    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'] ?? "";
    $cantidad = $_POST['cantidad'];


    $query = "insert into insumos (nombre,descripcion,cantidad,estado)
    values (?,?,?,?)";
    $tipos = "ssii";
    $datos = [$nombre, $descripcion, $cantidad, 1,];
    $resultado = $db->consultaPreparada($query, $tipos, $datos);

    if ($resultado) {

        $_SESSION['mensaje'] = "Agregado con éxito";
        header('Location:' . BASE_URL . 'controller/insumos/dashBoardInsumos.php');
        exit();
    }
    ;
}

require BASE_PATH . 'views/insumos/dashBoardInsumos.php';

?>