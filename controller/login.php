<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/tiendaMonica/rutas/rutaGlobal.php';
require BASE_PATH . "functions/sanitizarVariables.php";
require BASE_PATH . "models/mySql.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = new Mysql();

    $correoSanitizado = validarCorreo($_POST['correo']);
    $contraseña = $_POST['contraseña'];

    if ($correoSanitizado && !empty($contraseña)) {
        $sql = "SELECT nombre, correo, contraseña FROM usuarios WHERE correo = ?";
        $resultado = $db->consultaPreparada($sql, "s", [$correoSanitizado]);

        if ($resultado && count($resultado) > 0) {
            $usuario = $resultado[0];
            if ($contraseña === $usuario['contraseña']) {
                $_SESSION['usuario'] = $usuario['nombre'];
                header('Location:' . BASE_URL . 'controller/dashBoard.php');
                exit();
            } else {
                echo BASE_PATH .'views/login.php';
            }
        } else {
            echo BASE_PATH.'views/login.php';
        }
    } else {
        echo BASE_PATH.'views/login.php';

    }
}else
{
     require BASE_PATH . "views/login.php";
     
}



?>