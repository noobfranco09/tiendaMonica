<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/tiendaMonica/rutas/rutaGlobal.php';
require BASE_PATH . '/models/mySql.php';
require BASE_PATH . 'functions\helpers\session.php';

if (!isset($_SESSION['usuario'])) {
    header('Location:' . BASE_URL . 'views/login.php');
    exit();
}

$db = new Mysql();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Validar campos obligatorios
    if (empty($_POST['nombreColor']) || empty($_POST['codigo'])) {
        $_SESSION['tipoMensaje'] = "error";
        $_SESSION['mensaje'] = "Por favor, complete todos los campos requeridos.";
        header('Location:' . BASE_URL . 'controller/variantes/dashBoardVariantes.php');
        exit();
    }

    // Sanitizar datos
    $nombre = trim($_POST['nombreColor']);
    $codigo = trim($_POST['codigo']); // código HEX como #000000

    // Insertar en base de datos
    $query = "INSERT INTO colores (nombre, codigo, estado) VALUES (?, ?, ?)";
    $tipos = "ssi";
    $datos = [$nombre, $codigo, 1];

    $resultado = $db->consultaPreparada($query, $tipos, $datos);

    if ($resultado) {
        $_SESSION['tipoMensaje'] = "exito";
        $_SESSION['mensaje'] = "Color creado con éxito.";

        header('Location:' . BASE_URL . 'controller/variantes/dashBoardVariantes.php');
        exit();
    } else {
        $_SESSION['tipoMensaje'] = "error";
        $_SESSION['mensaje'] = "Error al crear el color. Inténtelo de nuevo.";
        header('Location:' . BASE_URL . 'controller/variantes/dashBoardVariantes.php');
        exit();
    }
} else {
    header('Location:' . BASE_URL . 'views/noAutorizado.php');
    exit();
}
?>
