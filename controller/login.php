<?php
session_start();
/* require "../functions/sanitizarVariables.php";
require "../models/mySql.php";
$correo = $_POST['correo'];
$contraseña = $_POST['contraseña'];
$correoSanitizado = validarCorreo($correo);
$resultado;
if ($correoSanitizado != false && isset($contraseña) && !empty($contraseña)) {
    $db = new mysqli();
    $consulta = $db->prepare("select rol,correo,contraseña from usuarios where correo = ?");
    $consulta->bind_param("s",$correo);
    $consulta->execute();
    $resultado1 = $consulta->get_result();
    $resultado = $resultado1->fetch_assoc();

} else {
    die("Por favor,verifique los datos ingresados");
}
if ($resultado && $contraseña == $resultado['contraseña']) {
    $_SESSION['rol'] = $resultado['rol'];
    header("Location: dashBoard.php");
}else
{
    die("El usuario con el que desea acceder no existe");
} */
require "../functions/sanitizarVariables.php";
require "../models/mySql.php";
$db = new Mysql();

$correoSanitizado = validarCorreo($_POST['correo']);
$contraseña = $_POST['contraseña'];

if ($correoSanitizado && !empty($contraseña) && isset($contraseña) ) {
    $sql = "SELECT idRol, correo, contraseña FROM usuarios WHERE correo = ?";
    $resultado = $db->consultaPreparada($sql, "s", [$correoSanitizado]);

    if ($resultado && count($resultado) > 0) {
        $usuario = $resultado[0];
        if ($contraseña == $usuario['contraseña']) {
            $_SESSION['rol'] = $usuario['idRol'];
            header("Location: ../views/dashboard.php");
            exit();
        } else {
            die("Contraseña incorrecta.");
        }
    } else {
        die("El usuario no existe.");
    }
} else {
    die("Datos inválidos.");
}

?>