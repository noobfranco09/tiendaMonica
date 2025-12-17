<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/tiendaMonica/rutas/rutaGlobal.php';
require_once BASE_PATH . '/models/mySql.php';
require BASE_PATH . 'functions\helpers\session.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        if (
            !isset($_POST['nombre']) || !isset($_POST['descripcion'])
            || !isset($_POST['cantidad']) || !isset($_POST['idInsumo'])
        ) {
            $_SESSION['error'] = "Por favor, llene todos los campos";
            header('Location:' . BASE_URL . 'controller/insumos/dashBoardInsumos.php');
            exit();
        }

        $idInsumo = $_POST['idInsumo'];
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



        $db = new Mysql();
        $query = "update insumos set nombre = ?,descripcion = ?,cantidad = ? where idInsumo = ?";
        $tipos = "ssii";
        $datos = [$nombre, $descripcion, $cantidad, $idInsumo];
        $resultado = $db->consultaPreparada($query, $tipos, $datos);

        if ($resultado) {

            $_SESSION['mensaje'] = "Editado con éxito";
            header('Location:' . BASE_URL . 'controller/insumos/dashBoardInsumos.php');
            exit();
        }
        ;
    } catch (PDOException $e) {
        $_SESSION['mensaje'] = "No se pudo editar el insumo";
        header('Location:' . BASE_URL . 'controller/insumos/dashBoardInsumos.php');
        exit();
    }

} else {
    $_SESSION['mensaje'] = "No se seleccionó ningún producto";
    header('Location:' . BASE_URL . 'controller/insumos/dashBoardInsumos.php');
    exit();
}
?>