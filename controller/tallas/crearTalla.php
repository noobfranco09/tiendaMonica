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

    if (!isset($_POST['nombreTalla']) || empty(trim($_POST['nombreTalla']))) {
        $_SESSION['tipoMensaje'] = "error";
        $_SESSION['mensaje'] = "Por favor, complete todos los campos requeridos.";
        header('Location:' . BASE_URL . 'controller\variantes\dashBoardVariantes.php');
        exit();
    }

    $nombre = trim($_POST['nombre'] ?? '');
    if ($nombre === '' || !preg_match('/^[\p{L}0-9\s\-_,.()]+$/u', $nombre)) {
        $_SESSION['tipoMensaje'] = 'error';
        $_SESSION['mensaje'] = 'El nombre contiene caracteres no permitidos.';
        header('Location:' . BASE_URL . 'controller\variantes\dashBoardVariantes.php');
        exit();
    }

    /** ----------------------------------------------------------
     *  VALIDACIÓN: Verificar si la talla ya existe
     * ----------------------------------------------------------*/
    $queryExiste = "SELECT idTalla FROM tallas WHERE nombre = ?";
    $resultadoExiste = $db->consultaPreparada($queryExiste, "s", [$nombre]);

    if (!empty($resultadoExiste)) {
        $_SESSION['tipoMensaje'] = "error";
        $_SESSION['mensaje'] = "La talla '$nombre' ya existe.";
        header('Location:' . BASE_URL . 'controller\variantes\dashBoardVariantes.php');
        exit();
    }

    /** ----------------------------------------------------------
     *  INSERTAR LA NUEVA TALLA
     * ----------------------------------------------------------*/
    $query = "INSERT INTO tallas (nombre, estado) VALUES (?, ?)";
    $tipos = "si";
    $datos = [$nombre, 1];

    $resultado = $db->consultaPreparada($query, $tipos, $datos);

    if ($resultado) {
        $_SESSION['tipoMensaje'] = "exito";
        $_SESSION['mensaje'] = "Talla creada con éxito.";
    } else {
        $_SESSION['tipoMensaje'] = "error";
        $_SESSION['mensaje'] = "Error al crear la talla. Inténtelo de nuevo.";
    }

    header('Location:' . BASE_URL . 'controller\variantes\dashBoardVariantes.php');
    exit();

} else {
    header('Location:' . BASE_URL . 'views\noAutorizado.php');
    exit();
}
?>