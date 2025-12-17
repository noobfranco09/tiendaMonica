<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/tiendaMonica/rutas/rutaGlobal.php';
require_once BASE_PATH . '/models/mySql.php';
require BASE_PATH . 'functions\helpers\session.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        if (
            !isset($_POST['editarIdProducto']) || !isset($_POST['editarNombreProducto'])
            || !isset($_POST['editarDescripcionProducto']) ||
            !isset($_POST['editarIdTipoProducto'])
        ) {
            $_SESSION['error'] = "Por favor, llene todos los campos";
            header('Location:' . BASE_URL . 'controller/dashBoard.php');
            exit();
        }

        $idProducto = $_POST['editarIdProducto'];
        $idTipoProducto = $_POST['editarIdTipoProducto'];
        $nombre = trim($_POST['editarNombreProducto'] ?? '');
        $descripcion = trim($_POST['editarDescripcionProducto'] ?? '');

        if ($nombre === '' || !preg_match('/^[\p{L}0-9\s\-_,.()]+$/u', $nombre)) {
            $_SESSION['tipoMensaje'] = 'error';
            $_SESSION['mensaje'] = 'El nombre contiene caracteres no permitidos.';
            header('Location:' . BASE_URL . 'controller/productos/crearProducto.php');
            exit();
        }

        if ($descripcion !== '' && !preg_match('/^[\p{L}0-9\s\-_,.()]+$/u', $descripcion)) {
            $_SESSION['tipoMensaje'] = 'error';
            $_SESSION['mensaje'] = 'La descripción contiene caracteres no permitidos.';
            header('Location:' . BASE_URL . 'controller/productos/crearProducto.php');
            exit();
        }




        $db = new Mysql();
        $query = "update productos set nombre = ?,descripcion = ?, idTipoProducto = ? where idProducto = ?";
        $tipos = "ssii";
        $datos = [$nombre, $descripcion, $idTipoProducto, $idProducto];
        $resultado = $db->consultaPreparada($query, $tipos, $datos);

        if ($resultado) {
            $_SESSION['tipoMensaje'] = "exito";
            $_SESSION['mensaje'] = "Editado con éxito";
            header('Location:' . BASE_URL . 'controller/dashBoard.php');
            exit();
        }
        ;
    } catch (PDOException $e) {
        $_SESSION['mensaje'] = "No se pudo editar el producto";
        header('Location:' . BASE_URL . 'controller/dashBoard.php');
        exit();
    }

} else {
    $_SESSION['mensaje'] = "No se seleccionó ningún producto";
    header('Location:' . BASE_URL . 'controller/dashBoard.php');
    exit();
}
?>