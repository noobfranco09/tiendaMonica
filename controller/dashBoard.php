<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: ../views/login.php');
    exit();
}

include "../models/mySql.php";
$db = new Mysql();
$consulta = "select*from productos where estado = 1";
$resultado = $db->consultaPreparada($consulta);

if(!$resultado || empty($resultado))
{
    $_SESSION['error']="No hay productos para mostrar";
    header('Location: ../views/dashBoard.php');
    exit();
}
require '../views/dashBoard.php';

?>