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

    $nombre = trim($_POST['nombre'] ?? '');
    $descripcion = trim($_POST['descripcion'] ?? '');
    $cantidad = filter_input(INPUT_POST, 'cantidad', FILTER_VALIDATE_INT);


    if ($nombre === '' || !preg_match('/^[\p{L}0-9\s\-_,.()]+$/u', $nombre)) {
        $_SESSION['tipoMensaje'] = 'error';
        $_SESSION['mensaje'] = 'El nombre contiene caracteres no permitidos.';
        header('Location:' . BASE_URL . 'controller/insumos/dashBoardInsumos.php');
        exit();
    }

    if ($descripcion !== '' && !preg_match('/^[\p{L}0-9\s\-_,.()]+$/u', $descripcion)) {
        $_SESSION['tipoMensaje'] = 'error';
        $_SESSION['mensaje'] = 'La descripción contiene caracteres no permitidos.';
        header('Location:' . BASE_URL . 'controller/insumos/dashBoardInsumos.php');
        exit();
    }

    if ($cantidad === false || $cantidad <= 0) {
        $_SESSION['tipoMensaje'] = 'error';
        $_SESSION['mensaje'] = 'La cantidad ingresada no es válida.';
        header('Location:' . BASE_URL . 'controller/insumos/dashBoardInsumos.php');
        exit();
    }




    $query = "insert into insumos (nombre,descripcion,cantidad,estado)
    values (?,?,?,?)";
    $tipos = "ssii";
    $datos = [$nombre, $descripcion, $cantidad, 1,];
    $resultado = $db->consultaPreparada($query, $tipos, $datos);

    if ($resultado) {
        $_SESSION['tipoMensaje'] = 'exito';

        $_SESSION['mensaje'] = "Agregado con éxito";
        header('Location:' . BASE_URL . 'controller/insumos/dashBoardInsumos.php');
        exit();
    }
    ;
}

require BASE_PATH . 'views/insumos/dashBoardInsumos.php';

?>