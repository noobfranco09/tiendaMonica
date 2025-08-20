<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: ../views/login.php');
    exit();
}
$idProducto = $_GET['idProducto'];
require '../models/mySql.php';
$db = new Mysql();
$query = "select * from provedores";
$query2 = "select * from tipoProducto";
$query3 = "select * from productos where idProducto= ?";
$tipo = "i";
$provedores = $db->consultaPreparada($query);
$tipoProducto = $db->consultaPreparada($query2);
$producto = $db->consultaPreparada($query3, $tipo, [$idProducto]);
$producto = $producto[0];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar producto</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
</head>

<body>
    <?php if (empty($producto)) {
        die("No se ha seleccionado ningún producto");
    } ?>
    <?php if (empty($idProducto)) {
        die("No se ha seleccionado ningún producto");
    } ?>
    <?php if (empty($provedores)) {
        die("Por favor,primero agregue provedores a su base de datos");
    } ?>
    <?php if (empty($tipoProducto)) {
        die("Por favor,primero agregue las categorías de los productos  a su base de datos");
    } ?>
    <div class="container">
        <header></header>
        <aside></aside>
        <section>
            <div class="row">
                <div class="col-18 d-flex justify-content-center">

                </div>
            </div>
        </section>
    </div>


    <script src="../assets/js/bootstrap.bundle.js"></script>
</body>

</html>