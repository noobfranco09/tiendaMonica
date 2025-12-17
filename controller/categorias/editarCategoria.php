<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/tiendaMonica/rutas/rutaGlobal.php';
require_once BASE_PATH . '/models/mySql.php';
require BASE_PATH . 'functions\helpers\session.php';



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        if (
            !isset($_POST['editarIdCategoria']) || !isset($_POST['nombre'])
            || !isset($_POST['descripcion'])
        ) {
            $_SESSION['error'] = "Por favor, llene todos los campos";
            header('Location:' . BASE_URL . 'controller/categorias/dashBoardCategorias.php');
            exit();
        }

        $idCategoria = $_POST['editarIdCategoria'];
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



        $db = new Mysql();
        $query = "update categorias set nombre = ?,descripcion = ?  where idCategoria = ?";
        $tipos = "ssi";
        $datos = [$nombre, $descripcion, $idCategoria];
        $resultado = $db->consultaPreparada($query, $tipos, $datos);

        if ($resultado) {

            $_SESSION['mensaje'] = "Editado con éxito";
            header('Location:' . BASE_URL . 'controller/categorias/dashBoardCategorias.php');
            exit();
        }
        ;
    } catch (PDOException $e) {
        $_SESSION['mensaje'] = "No se pudo editar el producto";
        header('Location:' . BASE_URL . 'controller/categorias/dashBoardCategorias.php');
        exit();
    }

} else {
    $_SESSION['mensaje'] = "No se seleccionó ningún producto";
    header('Location:' . BASE_URL . 'controller/categorias/dashBoardCategorias.php');
    exit();
}
?>