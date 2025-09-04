<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/tiendaMonica/rutas/rutaGlobal.php';
require_once BASE_PATH.'/models/mySql.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        if (
            !isset($_POST['nombre']) || !isset($_POST['descripcion'])
            || !isset($_POST['cantidad']) || !isset($_POST['idInsumo']) 
        ) {
            $_SESSION['error'] = "Por favor, llene todos los campos";
            header('Location:'.BASE_URL.'controller/insumos/dashBoardInsumos.php');
            exit();
        }

        $idInsumo = $_POST['idInsumo'];
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'] ?? "";
        $cantidad = $_POST['cantidad'];



        $db = new Mysql();
        $query = "update insumos set nombre = ?,descripcion = ?,cantidad = ? where idInsumo = ?";
        $tipos = "ssii";
        $datos = [$nombre, $descripcion, $cantidad, $idInsumo];
        $resultado = $db->consultaPreparada($query, $tipos, $datos);

        if ($resultado) {

            $_SESSION['mensaje'] = "Editado con éxito";
            header('Location:'.BASE_URL.'controller/insumos/dashBoardInsumos.php');
            exit();
        }
        ;
    } catch (PDOException $e) {
        $_SESSION['mensaje'] = "No se pudo editar el insumo";
        header('Location:'.BASE_URL.'controller/insumos/dashBoardInsumos.php');
        exit();
    }

} else {
    $_SESSION['mensaje'] = "No se seleccionó ningún producto";
    header('Location:'.BASE_URL.'controller/insumos/dashBoardInsumos.php');
    exit();
}
?>