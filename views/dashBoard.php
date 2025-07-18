<!DOCTYPE html>
<html lang="en">

<head>
    <?php require '../views/layouts/head.php' ?>
</head>

<body>

    <?php require '../views/layouts/header.php' ?>
    <?php require '../views/layouts/navBar.php' ?>

    <?php require '../views/layouts/modals/modalEditarProducto.php' ?>
    <main>

    </main>
    <div class="container">
        <div class="row m-1">
            <div class="col-12">
                <a class="btn btn-primary" href="<?php echo BASE_URL."controller/productos/crearProducto.php" ?>">Crear Producto</a>
            </div>
        </div>
        <div class="row d-flex">

            <?php if (!empty($resultado)): ?>
                <?php foreach ($resultado as $producto): ?>
                    <?php $idProducto = $producto['idProducto'] ?>
                    <div class="col-4 d-flex  justify-content-around  mt-3 ">
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
                                        <button class="btn btn-primary btnEditarProducto"
                                            data-id="<?php echo $producto['idProducto'] ?>" data-bs-toggle="modal"
                                            data-bs-target="#modalEditarProducto">Editar</button>
                                    </div>
                                    <div class="col-6">
                                        <form action="<?php echo BASE_URL . 'controller/productos/eliminarProducto.php' ?>"
                                            method="POST">
                                            <input type="hidden" name="btnIdProducto" value="<?= $producto['idProducto'] ?>">
                                            <button class="btn btn-primary">Eliminar</button>
                                        </form>

                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>

        </div>


    </div>


    <?php require '../views/layouts/footer.php' ?>
    <?php require '../views/layouts/error/error.php'; ?>
    <script src="../assets/js/ajaxJs/productoPorId.js"></script>

</body>

</html>