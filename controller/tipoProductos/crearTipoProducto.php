<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/tiendaMonica/rutas/rutaGlobal.php';
require BASE_PATH . '/models/mySql.php';
require BASE_PATH . '/functions/dieAndDumb/depurar.php';

require BASE_PATH . 'functions\helpers\session.php';
if (!isset($_SESSION['usuario'])) {
    header('Location:' . BASE_URL . 'views/login.php');
    exit();
}
$db = new Mysql();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (
        !isset($_POST['nombreCategoriaProducto']) || !isset($_POST['descripcionCategoriaProducto'])
    ) {
        $_SESSION['error'] = "Por favor, llene todos los campos";
        header('Location:' . BASE_URL . 'controller/tipoProductos/dashBoardTipoProductos.php');
        exit();
    }

    $nombre = $_POST['nombreCategoriaProducto'];
    $descripcion = $_POST['descripcionCategoriaProducto'];


    $query = "insert into tipoProducto (nombre,descripcion,estado)
    values (?,?,?)";
    $tipos = "ssi";
    $datos = [$nombre, $descripcion,1];
    $resultado = $db->consultaPreparada($query, $tipos, $datos);

    if ($resultado) {

        $_SESSION['mensaje'] = "Agregado con éxito";
        header('Location:' . BASE_URL . 'controller/tipoProductos/dashBoardTipoProductos.php');
        exit();
    }
    ;
}

require BASE_PATH . 'controller/tipoProductos/dashBoardTipoProductos.php';

?>