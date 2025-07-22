<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/tiendaMonica/rutas/rutaGlobal.php';
require BASE_PATH . '/models/mySql.php';

session_start();
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

    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];




    $query = "insert into categorias (nombre,descripcion)
    values (?,?)";
    $tipos = "ss";
    $datos = [$nombre, $descripcion];
    $resultado = $db->consultaPreparada($query, $tipos, $datos);

    if ($resultado) {

        $_SESSION['mensaje'] = "Agregado con éxito";
        header('Location:' . BASE_URL . 'controller/categorias/dashBoardCategorias.php');
        exit();
    }
    ;
}

require BASE_PATH . 'views/categorias/dashBoardCategorias.php';

?>