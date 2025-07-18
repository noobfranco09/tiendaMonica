<?php
session_start();
require "../functions/sanitizarVariables.php";
require "../models/mySql.php";
require '../../rutas/rutaGlobal.php';

$db = new Mysql();

$correoSanitizado = validarCorreo($_POST['correo']);
$contraseña = $_POST['contraseña'];

if ($correoSanitizado && !empty($contraseña)) {
    $sql = "SELECT nombre, correo, contraseña FROM usuarios WHERE correo = ?";
    $resultado = $db->consultaPreparada($sql, "s", [$correoSanitizado]);

    if ($resultado && count($resultado) > 0) {
        $usuario = $resultado[0];
        if ($contraseña == $usuario['contraseña']) {
            $_SESSION['usuario'] = $usuario['nombre'];
            header("Location: ../controller/dashboard.php");
            exit();
        } else {
            header("Location: ../views/login.php?error=contraseña");
            exit();
        }
    } else {
        header("Location: ../views/login.php?error=usuario");
        exit();
    }
} else {
    header("Location: ../views/login.php?error=datos");
    exit();
}


?>