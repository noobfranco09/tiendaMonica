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

        if (!isset($_POST['nombreTalla'])) {
            $_SESSION['tipoMensaje'] = "error";
            $_SESSION['mensaje'] = "Por favor, complete todos los campos requeridos.";
            header('Location:' . BASE_URL . 'controller\variantes\dashBoardVariantes.php');
            exit();
        }

    $nombre = trim($_POST['nombreTalla']);

    $query = "INSERT INTO tallas 
              (nombre)
              VALUES (?)";
    $tipos = "s";
    $datos = [$nombre];

    $resultado = $db->consultaPreparada($query, $tipos, $datos);

    if ($resultado) {
        $_SESSION['tipoMensaje'] = "exito";
        $_SESSION['mensaje'] = "Talla creada con éxito.";
        header('Location:' . BASE_URL . 'controller\variantes\dashBoardVariantes.php');
        exit();
    } else {
        $_SESSION['tipoMensaje'] = "error";
        $_SESSION['mensaje'] = "error al crear la talla. Inténtelo de nuevo.";
        header('Location:' . BASE_URL . 'controller\variantes\dashBoardVariantes.php');
        exit();
    }
}else{
header('Location:' . BASE_URL . 'views\noAutorizado.php');
exit();

}


?>