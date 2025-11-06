<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/tiendaMonica/rutas/rutaGlobal.php';
require BASE_PATH . "functions/sanitizarVariables.php";
require BASE_PATH . "views/layouts/error/error.php";

require BASE_PATH . "models/mySql.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = new Mysql();

    $correoSanitizado = validarCorreo($_POST['correo']);
    $contraseña = $_POST['contraseña'];

    if ($correoSanitizado && !empty($contraseña)) {
        $sql = "SELECT idUsuario,nombre, correo, contrasena FROM usuarios WHERE correo = ?";
        $resultado = $db->consultaPreparada($sql, "s", [$correoSanitizado]);

        if ($resultado && count($resultado) > 0) {
            $usuario = $resultado[0];
            if ($contraseña === $usuario['contrasena']) {
                $_SESSION['usuario'] = $usuario['nombre'];
                $_SESSION['idUsuario'] = $usuario['idUsuario'];
                header('Location:' . BASE_URL . 'controller/dashBoard.php');
                exit();
            } else {
                $_SESSION['tipoMensaje'] = 'error';
                $_SESSION['mensaje'] = 'Contraseña incorrecta';
                header('Location:' . BASE_URL . 'views/login.php');
                exit();
            }
        } else {
            $_SESSION['tipoMensaje'] = 'error';
            $_SESSION['mensaje'] = 'Usuaerio no encontrado';
            header('Location:' . BASE_URL . 'views/login.php');
            exit();
        }
    } else {
        // require_once BASE_PATH.'views/login.php';
        $_SESSION['tipoMensaje'] = 'error';
        $_SESSION['mensaje'] = 'Por favor,llene todods los campos';
        header('Location:' . BASE_URL . 'views/login.php');
        exit();

    }
} else {
    require BASE_PATH . "views/login.php";
}

?>