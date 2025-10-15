<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/tiendaMonica/rutas/rutaGlobal.php';
require BASE_PATH . '/models/mySql.php';

session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location:' . BASE_URL . 'views/login.php');
    exit();
}
$db = new Mysql();
$queryCategorias = "select * from categorias";
$categorias = $db->consultaPreparada($queryCategorias);
if (empty($categorias)) {
 $_SESSION['error'] = "No hay categorías para los provedores, antes de crear un provedor cree una categoría.";
        header('Location:' . BASE_URL . 'controller/provedores/dashBoardProvedores.php');
        exit();
}
require BASE_PATH . 'views/layouts/error/error.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    if (
        !isset($_POST['nombreProvedor']) || !isset($_POST['contactoProvedor'])
    ) {
        $_SESSION['error'] = "Por favor, llene todos los campos";
        header('Location:' . BASE_URL . 'controller/provedores/dashBoardProvedores.php');
        exit();
    }

    $nombre = $_POST['nombreProvedor'];
    $contacto = $_POST['contactoProvedor'];




    $query = "insert into provedores (nombre,contacto,estado)
    values (?,?,?)";
    $tipos = "ssi";
    $datos = [$nombre, $contacto,1];
    $resultado = $db->consultaPreparada($query, $tipos, $datos);

    if ($resultado) {

        $_SESSION['mensaje'] = "Agregado con éxito";
        header('Location:'.BASE_URL. 'controller/provedores/dashBoardProvedores.php');
        exit();

    }
    ;
    exit();
}
$queryProvedores = "select * from provedores";
$queryTipoProducto = "select * from tipoProducto";

$provedores = $db->consultaPreparada($queryProvedores);
$tipoProducto = $db->consultaPreparada($queryTipoProducto);
if (empty($provedores)) {
    header('Location:' . BASE_URL . 'controller/provedores/dashBoardprovedores.php');
    exit();
}

if (empty($tipoProducto)) {
    header('Location:' . BASE_URL . 'controller/categorias/dashBoardCategorias.php');
    exit();
}
require BASE_PATH . 'views/crearProducto.php';

?>