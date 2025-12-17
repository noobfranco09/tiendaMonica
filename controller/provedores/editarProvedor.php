<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/tiendaMonica/rutas/rutaGlobal.php';
require_once BASE_PATH . '/models/mySql.php';
require BASE_PATH . 'functions\helpers\session.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        if (
            !isset($_POST['idProvedor']) || !isset($_POST['nombre'])
            || !isset($_POST['contacto'])
        ) {
            $_SESSION['error'] = "Por favor, llene todos los campos";
            header('Location:' . BASE_URL . 'controller/provedores/dashBoardProvedores.php');
            exit();
        }

        $idProvedor = $_POST['idProvedor'];
        $nombre = trim($_POST['nombre'] ?? '');
        if ($nombre === '' || !preg_match('/^[\p{L}0-9\s\-_,.()]+$/u', $nombre)) {
            $_SESSION['tipoMensaje'] = 'error';
            $_SESSION['mensaje'] = 'El nombre contiene caracteres no permitidos.';
            header('Location:' . BASE_URL . 'controller/provedores/dashBoardProvedores.php');
            exit();
        }
        $contacto = trim($_POST['contactoProvedor'] ?? '');
        if (!preg_match('/^\+?[0-9\s]{7,15}$/', $contacto)) {
            $_SESSION['tipoMensaje'] = 'error';
            $_SESSION['mensaje'] = 'El número de contacto no es válido.';
            header('Location:' . BASE_URL . 'controller/provedores/dashBoardProvedores.php');
            exit();
        }





        $db = new Mysql();
        $query = "update provedores set nombre = ?,contacto = ? where idProvedor = ?";
        $tipos = "ssi";
        $datos = [$nombre, $contacto, $idProvedor];
        $resultado = $db->consultaPreparada($query, $tipos, $datos);

        if ($resultado) {

            $_SESSION['mensaje'] = "Editado con éxito";
            header('Location:' . BASE_URL . 'controller/provedores/dashBoardProvedores.php');
            exit();
        }
        ;
    } catch (PDOException $e) {
        $_SESSION['mensaje'] = "No se pudo editar el provedor";
        header('Location:' . BASE_URL . 'controller/provedores/dashBoardProvedores.php');
        exit();
    }

} else {
    $_SESSION['mensaje'] = "No se seleccionó ningún provedor";
    header('Location:' . BASE_URL . 'controller/provedores/dashBoardProvedores.php');
    exit();
}
?>