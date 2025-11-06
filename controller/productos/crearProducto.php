<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/tiendaMonica/rutas/rutaGlobal.php';
require BASE_PATH . '/models/mySql.php';

session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location:' . BASE_URL . 'views/login.php');
    exit();
}
$db = new Mysql();
require BASE_PATH . 'views/layouts/error/error.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (
        !isset($_POST['nombreProducto']) || !isset($_POST['descripcionProducto'])
        || !isset($_POST['idTipoProducto'])
    ) {
        $_SESSION['error'] = "Por favor, llene todos los campos";
        header('Location:' . BASE_URL . 'controller/productos/crearProducto.php');
        exit();
    }

    $nombre = $_POST['nombreProducto'];
    $descripcion = $_POST['descripcionProducto'];
    $estado = 1;
    $idTipoProducto = $_POST['idTipoProducto'];



    $query = "insert into productos (nombre,descripcion,estado,idTipoProducto)
    values (?,?,?,?)";
    $tipos = "ssii";
    $datos = [$nombre, $descripcion, $estado, $idTipoProducto];
    $resultado = $db->consultaPreparada($query, $tipos, $datos);

    if ($resultado) {

        $_SESSION['mensaje'] = "Agregado con éxito";
        header('Location:' . BASE_URL . 'controller/dashBoard.php');
        exit();
    }
    ;
}


require BASE_PATH . 'views/crearProducto.php';

?>