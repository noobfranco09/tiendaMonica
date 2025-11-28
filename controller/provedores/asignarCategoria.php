<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/tiendaMonica/rutas/rutaGlobal.php';
require BASE_PATH . '/models/mySql.php';

require BASE_PATH . 'functions\helpers\session.php';
if (!isset($_SESSION['usuario'])) {
    header('Location:' . BASE_URL . 'views/login.php');
    exit();
}
try {
    $db = new Mysql();
    if (
        !isset($_POST['idProvedor']) || !isset($_POST['categorias'])
    ) {
        $_SESSION['error'] = "Por favor, seleccione un categoria";
        header('Location:' . BASE_URL . 'controller/provedores/dashBoardProvedores.php');
        exit();
    }
    $idProvedor = $_POST['idProvedor'];
    $idCategoria = $_POST['categorias'];

    $consultarCategoria = "select provedores.nombre from provedores_has_categorias inner join provedores
     on provedores.idProvedor = provedores_has_categorias.idProvedor inner join categorias on 
     categorias.idCategoria = provedores_has_categorias.idCategoria 
     where provedores_has_categorias.idProvedor = ? and provedores_has_categorias.idCategoria = ? ";
    $resultadoConsulta = $db->consultaPreparada($consultarCategoria, "ii", [$idProvedor, $idCategoria]);

    if (empty($resultadoConsulta)) {


        $query = "insert into provedores_has_categorias (idProvedor,idCategoria) values (?,?)";
        $parametros = [$idProvedor, $idCategoria];
        $categorias = $db->consultaPreparada($query, 'ii', $parametros);
        if ($categorias) {
            $_SESSION['mensaje'] = "Agregado con éxito";
            header('Location:' . BASE_URL . 'controller/provedores/dashBoardProvedores.php');
            exit();
        }
    } else {
        $_SESSION['error'] = "La categoría ya está asignada a este provedor";
        header('Location:' . BASE_URL . 'controller/provedores/dashBoardProvedores.php');
        exit();
    }

} catch (PDOException) {
    $_SESSION['error'] = "No se pudo agregar la categoría";
    header('Location:' . BASE_URL . 'controller/provedores/dashBoardProvedores.php');
    exit();
}


?>