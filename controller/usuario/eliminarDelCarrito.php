<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/tiendaMonica/rutas/rutaGlobal.php';
require_once BASE_PATH . 'functions/dieAndDumb/depurar.php';
require BASE_PATH . 'functions\helpers\session.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($_POST['idProducto']) || empty($_POST['tallaProducto'])) {
        $_SESSION['tipoMensaje'] = "error";
        $_SESSION['mensaje'] = "Error al intentar eliminar el producto.";
        header('Location:' . BASE_URL . 'controller/usuario/dashBoardUsuario.php');
        exit();
    }

    $idProducto = $_POST['idProducto'];
    $tallaProducto = $_POST['tallaProducto'];

    if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])) {
        foreach ($_SESSION['carrito'] as $index => $item) {
            if ($item['id'] == $idProducto && $item['talla'] == $tallaProducto) {
                unset($_SESSION['carrito'][$index]);
                break;
            }
        }
        $_SESSION['carrito'] = array_values($_SESSION['carrito']); // Reindexar
    }

    $_SESSION['tipoMensaje'] = "exito";
    $_SESSION['mensaje'] = "Producto eliminado del carrito correctamente.";
    header('Location:' . BASE_URL . 'controller/usuario/dashBoardUsuario.php');
    exit();
}

header('Location:' . BASE_URL . 'views/noAutorizado.php');
exit();
