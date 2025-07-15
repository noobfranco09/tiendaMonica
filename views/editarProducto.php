<?php
session_start();
if(!isset($_SESSION['usuario']))
{
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
                    <form action="../controller/editarProducto.php" method="POST">
                        <div class="mb-3">
                             <input class="form-control" type="hidden" required name="idProducto" id="idProducto"
                                value="<?php echo $idProducto;?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="nombreProducto">Nombre del producto</label>
                            <input class="form-control" type="text" required name="nombreProducto" id="nombreProducto"
                                value="<?php echo $producto['nombre'] ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="descripcionProducto">Descripción del producto</label>
                            <input class="form-control" type="text" required name="descripcionProducto"
                                id="descripcionProducto" value="<?php echo $producto['descripcion'] ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="stockProducto">Stock del producto</label>
                            <input class="form-control" type="number" required name="stockProducto" id="stockProducto"
                                value="<?php echo $producto['stock'] ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="precioProducto">Precio del producto</label>
                            <input class="form-control" type="number" required name="precioProducto" id="precioProducto"
                                value="<?php echo $producto['precio'] ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="idProvedor">Provedores:</label>
                            <select name="idProvedor" id="idProvedor">
                                <option value="" disabled selected>Selecciona un provedor</option>
                                <?php foreach ($provedores as $provedor): ?>
                                    <option value="<?php echo $provedor['idProvedor'] ?>" <?php if ($provedor['idProvedor'] == $producto['idProvedor'])
                                           echo 'selected'; ?>>

                                        <?php echo $provedor['nombre'] ?>
                                    </option>
                                <?php endforeach; ?>

                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="idTipoProducto">Categoria del producto: </label>
                            <select name="idTipoProducto" id="idTipoProducto">
                                <option value="" disabled selected>Selecciona una categoría para el producto</option>
                                <?php foreach ($tipoProducto as $producto): ?>
                                    <option value="<?php echo $producto['idTipoProducto'] ?>" <?php if ($producto['idTipoProducto'] == $producto['idTipoProducto'])
                                           echo 'selected'; ?>>
                                        <?php echo $producto['nombre'] ?>
                                    </option>
                                <?php endforeach; ?>

                            </select>
                        </div>
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-6">
                                    <button class="btn btn-primary " type="submit">Guardar</button>
                                </div>
                                <div class="col-6">
                                    <a href="./dashBoard.php" class="btn btn-danger ">Cancelar</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>


    <script src="../assets/js/bootstrap.bundle.js"></script>
</body>

</html>