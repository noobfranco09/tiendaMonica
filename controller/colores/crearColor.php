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

        if (!isset($_POST['nombreColor'])) {
            $_SESSION['tipoMensaje'] = "error";
            $_SESSION['mensaje'] = "Por favor, complete todos los campos requeridos.";
            header('Location:' . BASE_URL . 'controller\variantes\dashBoardVariantes.php');
            exit();
        }

    $nombre = trim($_POST['nombreColor']);

    $query = "INSERT INTO colores 
              (nombre,estado)
              VALUES (?, ?)";
    $tipos = "si";
    $datos = [$nombre, 1];

    $resultado = $db->consultaPreparada($query, $tipos, $datos);

    if ($resultado) {
        $_SESSION['tipoMensaje'] = "exito";
        $_SESSION['mensaje'] = "Color creado con éxito.";

        header('Location:' . BASE_URL . 'controller\variantes\dashBoardVariantes.php');
        exit();
    } else {
        $_SESSION['tipoMensaje'] = "error";
        $_SESSION['mensaje'] = "error al crear el color. Inténtelo de nuevo.";
        header('Location:' . BASE_URL . 'controller\variantes\dashBoardVariantes.php');
        exit();
    }
}else{
header('Location:' . BASE_URL . 'views\noAutorizado.php');
exit();

}


?>