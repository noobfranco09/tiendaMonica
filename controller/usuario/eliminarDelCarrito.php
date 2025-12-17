<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/tiendaMonica/rutas/rutaGlobal.php';
require BASE_PATH . 'functions\helpers\session.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (empty($_POST['idVariante'])) {
        $_SESSION['tipoMensaje'] = "error";
        $_SESSION['mensaje'] = "Error al eliminar el producto.";
        header('Location:' . BASE_URL . 'controller/usuario/dashBoardUsuario.php');
        exit();
    }

    $idVariante = $_POST['idVariante'];

    if (!empty($_SESSION['carrito'])) {
        foreach ($_SESSION['carrito'] as $index => $item) {
            if ($item['idVariante'] == $idVariante) {
                unset($_SESSION['carrito'][$index]);
                break;
            }
        }

        $_SESSION['carrito'] = array_values($_SESSION['carrito']); // reindexar
    }

    $_SESSION['tipoMensaje'] = "exito";
    $_SESSION['mensaje'] = "Producto eliminado del carrito.";
    header('Location:' . BASE_URL . 'controller/usuario/dashBoardUsuario.php');
    exit();
}

header('Location:' . BASE_URL . 'views/noAutorizado.php');
exit();
