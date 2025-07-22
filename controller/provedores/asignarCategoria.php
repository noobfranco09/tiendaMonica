<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/tiendaMonica/rutas/rutaGlobal.php';
require BASE_PATH . '/models/mySql.php';

session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location:' . BASE_URL . 'views/login.php');
    exit();
}
try {
    if (
        !isset($_POST['idProvedor']) || !isset($_POST['categorias'])
    ) {
        $_SESSION['error'] = "Por favor, seleccione un categoria";
        header('Location:' . BASE_URL . 'controller/provedores/dashBoardProvedores.php');
        exit();
    }
    $idProvedor = $_POST['idProvedor'];
    $idCategoria = $_POST['categorias'];
    $db = new Mysql();
    $query = "insert into provedores_has_categorias (idProvedor,idCategoria) values (?,?)";
    $parametros = [$idProvedor, $idCategoria];
    $categorias = $db->consultaPreparada($query, 'ii', $parametros);
    if ($categorias) {
        $_SESSION['mensaje'] = "Agregado con éxito";
        header('Location:' . BASE_URL . 'controller/provedores/dashBoardProvedores.php');
        exit();
    }
} catch (PDOException) {
    $_SESSION['error'] = "No se pudo agregar la categoría";
    header('Location:' . BASE_URL . 'controller/provedores/dashBoardProvedores.php');
    exit();
}


?>