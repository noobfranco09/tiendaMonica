<?php
require '../models/mySql.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        if (
            !isset($_POST['editarIdProducto']) || !isset($_POST['editarNombreProducto'])
            || !isset($_POST['editarDescripcionProducto']) || !isset($_POST['editarStockProducto']) ||
            !isset($_POST['editarIdProvedor']) || !isset($_POST['editarIdTipoProducto'])
        ) {
            $_SESSION['error'] = "Por favor, llene todos los campos";
            header('Location: ');
            exit();
        }

        $idProducto = $_POST['editarIdProducto'];
        $nombre = $_POST['editarNombreProducto'];
        $descripcion = $_POST['editarDescripcionProducto'];
        $stock = $_POST['editarStockProducto'];
        $precio = $_POST['editarPrecioProducto'];
        $idProvedor = $_POST['editarIdProvedor'];
        $idTipoProducto = $_POST['editarIdTipoProducto'];



        $db = new Mysql();
        $query = "update productos set nombre = ?,descripcion = ?,stock = ?,precio = ?,idProvedor = ?, idTipoProducto = ? where idProducto = ?";
        $tipos = "ssidiii";
        $datos = [$nombre, $descripcion, $stock, $precio, $idProvedor, $idTipoProducto, $idProducto];
        $resultado = $db->consultaPreparada($query, $tipos, $datos);

        if ($resultado) {

            $_SESSION['mensaje'] = "Editado con éxito";
            header("Location: ../controller/dashBoard.php");
            exit();
        }
        ;
    } catch (PDOException $e) {
        $_SESSION['mensaje'] = "No se pudo editar el producto";
        header("Location: ../controller/dashBoard.php");
        exit();
    }

} else {
    $_SESSION['mensaje'] = "No se seleccionó ningún producto";
    header("Location: ../controller/dashBoard.php");
    exit();
}
?>