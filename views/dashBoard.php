<!DOCTYPE html>
<html lang="en">

<head>
    <?php require '../views/layouts/head.php' ?>
</head>

<body>
    <div class="layout">
        <?php require '../views/layouts/navbar.php' ?>
        <main class="main-content">
            <?php require '../views/layouts/header.php' ?>

            <div class="content-wrapper">
                <!-- Botón Crear -->
                <div class="row m-1">
                    <div class="col-12">
                        <button class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#modalCrearProducto">Crear Prducto</button>
                    </div>
                </div>

                <div class="row">
                    <?php if (!empty($resultado)): ?>
                        <?php foreach ($resultado as $producto): ?>
                            <div class="col-12 col-md-6 col-lg-4 d-flex justify-content-around mt-3">
                                <div class="card" style="width: 18rem;">
                                    <img src="..." class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $producto['nombre'] ?></h5>
                                        <div class="row p-1">
                                            <div class="col-6"><?php echo "Precio:<br>" . $producto['precio'] ?></div>
                                            <div class="col-6"><?php echo "Stock:<br>" . $producto['stock'] ?></div>
                                        </div>
                                        <p class="card-text"><?php echo $producto['descripcion'] ?></p>
                                        <div class="row">
                                            <div class="col-6">
                                                <button class="btn btn-warning btnEditarProducto"
                                                    data-id="<?= $producto['idProducto'] ?>" data-bs-toggle="modal"
                                                    data-bs-target="#modalEditarProducto">Editar</button>
                                            </div>
                                            <div class="col-6">
                                                <form action="<?= BASE_URL . 'controller/productos/eliminarProducto.php' ?>"
                                                    method="POST">
                                                    <input type="hidden" name="btnIdProducto"
                                                        value="<?= $producto['idProducto'] ?>">
                                                    <button class="btn btn-danger">Eliminar</button>
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


        </main>
    </div>

    <?php require '../views/layouts/modals/modalsProductos/modalEditarProducto.php' ?>
    <?php require BASE_PATH . 'views/layouts/footer.php' ?>
    <script src="../assets/js/ajaxJs/productoPorId.js"></script>
    <?php require BASE_PATH . 'views/layouts/modals/modalsProductos/modalCrearProducto.php' ?>  
    
</body>


</html>