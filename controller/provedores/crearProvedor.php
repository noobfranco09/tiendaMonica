<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/tiendaMonica/rutas/rutaGlobal.php';
require BASE_PATH . '/models/mySql.php';

require BASE_PATH . 'functions\helpers\session.php';
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

    $contacto = trim($_POST['contactoProvedor'] ?? '');
    $nombre = trim($_POST['nombreProvedor'] ?? '');

    if ($nombre === '' || !preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{2,50}$/', $nombre)) {
        $_SESSION['tipoMensaje'] = 'error';
        $_SESSION['mensaje'] = 'El nombre solo puede contener letras y espacios.';
        header('Location:' . BASE_URL . 'controller/provedores/dashBoardProvedores.php');
        exit();
    }

    // Permitir números, espacios, +, paréntesis y guiones
    if (!preg_match('/^[\d\+\-\(\)\s]{7,20}$/', $contacto)) {
        $_SESSION['tipoMensaje'] = 'error';
        $_SESSION['mensaje'] = 'Formato de número inválido.';
        header('Location:' . BASE_URL . 'controller/provedores/dashBoardProvedores.php');
        exit();
    }

    // Normalizar: solo números
    $contactoLimpio = preg_replace('/\D/', '', $contacto);

    // Validar cantidad real de dígitos
    if (strlen($contactoLimpio) < 7 || strlen($contactoLimpio) > 15) {
        $_SESSION['tipoMensaje'] = 'error';
        $_SESSION['mensaje'] = 'El número de contacto debe tener entre 7 y 15 dígitos.';
        header('Location:' . BASE_URL . 'controller/provedores/dashBoardProvedores.php');
        exit();
    }





    $query = "insert into provedores (nombre,contacto,estado)
    values (?,?,?)";
    $tipos = "ssi";
    $datos = [$nombre, $contacto, 1];
    $resultado = $db->consultaPreparada($query, $tipos, $datos);

    if ($resultado) {
        $_SESSION['tipoMensaje']="exito";
        $_SESSION['mensaje'] = "Agregado con éxito";
        header('Location:' . BASE_URL . 'controller/provedores/dashBoardProvedores.php');
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