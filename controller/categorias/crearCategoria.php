<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/tiendaMonica/rutas/rutaGlobal.php';
require BASE_PATH . 'models/mySql.php';
require BASE_PATH . 'functions\helpers\session.php';


if (!isset($_SESSION['usuario'])) {
    header('Location:' . BASE_URL . 'views/login.php');
    exit();
}
$db = new Mysql();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (
        !isset($_POST['nombre']) || !isset($_POST['descripcion'])
    ) {
        $_SESSION['error'] = "Por favor, llene todos los campos";
        header('Location:' . BASE_URL . 'controller/categorias/dashBoardCategorias.php');
        exit();
    }

    $nombre = trim($_POST['nombre'] ?? '');
    $descripcion = trim($_POST['descripcion'] ?? '');

    if ($nombre === '' || !preg_match('/^[\p{L}0-9\s\-_,.()]+$/u', $nombre)) {
        $_SESSION['tipoMensaje'] = 'error';
        $_SESSION['mensaje'] = 'El nombre contiene caracteres no permitidos.';
        header('Location:' . BASE_URL . 'controller/categorias/dashBoardCategorias.php');
        exit();
    }

    if ($descripcion !== '' && !preg_match('/^[\p{L}0-9\s\-_,.()]+$/u', $descripcion)) {
        $_SESSION['tipoMensaje'] = 'error';
        $_SESSION['mensaje'] = 'La descripción contiene caracteres no permitidos.';
        header('Location:' . BASE_URL . 'controller/categorias/dashBoardCategorias.php');
        exit();
    }





    $query = "insert into categorias (nombre,descripcion,estado)
    values (?,?,?)";
    $tipos = "ssi";
    $datos = [$nombre, $descripcion, 1];
    $resultado = $db->consultaPreparada($query, $tipos, $datos);

    if ($resultado) {
        $_SESSION['tipoMensaje'] = 'exito';

        $_SESSION['mensaje'] = "Agregado con éxito";
        header('Location:' . BASE_URL . 'controller/categorias/dashBoardCategorias.php');
        exit();
    }
    ;
}

require BASE_PATH . 'views/categorias/dashBoardCategorias.php';

?>