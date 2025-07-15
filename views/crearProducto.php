<!DOCTYPE html>
<html lang="en">

<head>
    <?php require './layouts/head.php'; ?>
</head>

<body>
    <?php require './layouts/header.php'; ?>
    <?php require './layouts/navBar.php'; ?>
    <div class="container">
            <div class="row">
                <div class="col-18 d-flex justify-content-center">
                    <form action="../controller/crearProducto.php" method="POST">
                        <div class="mb-3">
                            <label class="form-label" for="nombreProducto">Nombre del producto</label>
                            <input class="form-control" type="text" required name="nombreProducto" id="nombreProducto">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="descripcionProducto">Descripción del producto</label>
                            <input class="form-control" type="text" required name="descripcionProducto"
                                id="descripcionProducto">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="stockProducto">Stock del producto</label>
                            <input class="form-control" type="number" required name="stockProducto" id="stockProducto">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="precioProducto">Precio del producto</label>
                            <input class="form-control" type="number" required name="precioProducto"
                                id="precioProducto">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="idProvedor">Provedores:</label>
                            <select name="idProvedor" id="idProvedor">
                                <option value="" disabled selected>Selecciona un provedor</option>
                                <?php foreach ($provedores as $provedor): ?>
                                    <option value="<?php echo $provedor['idProvedor'] ?>"><?php echo $provedor['nombre'] ?>
                                    </option>
                                <?php endforeach; ?>

                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="idTipoProducto">Categoria del producto: </label>
                            <select name="idTipoProducto" id="idTipoProducto">
                                <option value="" disabled selected>Selecciona una categoría para el producto</option>
                                <?php foreach ($tipoProducto as $producto): ?>
                                    <option value="<?php echo $producto['idTipoProducto'] ?>">
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
    </div>


    <?php require './layouts/footer.php'; ?>
</body>

</html>