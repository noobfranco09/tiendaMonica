<!DOCTYPE html>
<html lang="en">

<head>
    <?php require './layouts/head.php' ?>
</head>

<body>
    <?php require './layouts/header.php' ?>
    <?php require './layouts/navBar.php' ?>
    <?php ?>
    <div class="container">
        <div class="row m-1">
            <div class="col-12">
                <a class="btn btn-primary" href="./crearProducto.php">Crear Producto</a>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <?php if (!empty($resultado)): ?>
                    <?php foreach ($resultado as $producto): ?>
                        <?php $idProducto = $producto['idProducto'] ?>
                        <div class="card" style="width: 18rem;">
                            <img src="..." class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $producto['nombre'] ?></h5>
                                <div class="row p-1">
                                    <div class="col-6"><?php echo "Precio: <br> " . $producto['precio'] ?></div>
                                    <div class="col-6"><?php echo "Stock: <br> " . $producto['stock'] ?></div>
                                </div>
                                <div class="row p-1">
                                    <div class="col-12">
                                        <p class="card-text"><?php echo $producto['descripcion'] ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <a class="btn btn-primary"
                                            href="../controller/eliminarProducto.php?idProducto=<?php echo $producto['idProducto'] ?>">Eliminar</a>
                                    </div>
                                    <div class="col-6">
                                        <a class="btn btn-primary"
                                            href="../views/editarProducto.php?idProducto=<?php echo $producto['idProducto'] ?>">Editar</a>
                                    </div>
                                </div>


                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>


    </div>


    <?php require './layouts/footer.php' ?>
    <?php require './layouts/error/errorProductos.php'; ?>
</body>

</html>