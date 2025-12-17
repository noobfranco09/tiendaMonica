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
        !isset($_POST['idInsumo']) || !isset($_POST['idProducto'])
    ) {
        $_SESSION['error'] = "Por favor, llene todos los campos";
        header('Location:' . BASE_URL . 'controller/dashBoard.php');
        exit();
    }

    $idInsumo = $_POST['idInsumo'];
    $idProducto = $_POST['idProducto'];

    $queryVerificasInsumo = "SELECT COUNT(*) as total 
     FROM insumos_has_productos 
     WHERE idInsumo = ? AND idProducto = ?";
    $verificarInsumo = $db->consultaPreparada($queryVerificasInsumo, "ii", [$idInsumo, $idProducto]);

    if ($verificarInsumo[0]['total'] == 0) {
        $query = "INSERT INTO insumos_has_productos (idInsumo, idProducto) VALUES (?, ?)";
        $resultado = $db->consultaPreparada($query, "ii", [$idInsumo, $idProducto]);

        if ($resultado) {
            $_SESSION['tipoMensaje']="exito";
            $_SESSION['mensaje'] = "Agregado con éxito";
            header('Location:' . BASE_URL . 'controller/dashBoard.php');
            exit();
        }
    } else {
        $_SESSION['mensaje'] = "Este insumo ya ha sido asignado a este producto";
        header('Location:' . BASE_URL . 'controller/dashBoard.php');
        exit();
    }

}

require BASE_PATH . 'controller/dashBoard.php';

?>