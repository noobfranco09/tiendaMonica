<?php require $_SERVER['DOCUMENT_ROOT'] . '/tiendaMonica/rutas/rutaGlobal.php' ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once BASE_PATH . 'views/layouts/head.php' ?>
</head>

<body>
    <div class="layout">
        <?php require BASE_PATH . 'views/layouts/navbar.php' ?>
        <main class="main-content">
            <?php require BASE_PATH . 'views/layouts/header.php' ?>
            <div class="content-wrapper">


                <table class="table table-striped" id="tablaProductos">
                    <thead>
                        <tr>
                            <th scope="col">
                                <button class="btn btn-primary " data-bs-toggle="modal"
                                    data-bs-target="#modalCrearProducto">Crear Producto</button>
                            </th>
                        </tr>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">stock</th>
                            <th scope="col">Precio</th>
                            <th scope="col">Descripción</th>
                            <th scope="col">Estado</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($resultado as $producto): ?>
                            <tr>
                                <td><?php echo $producto['idProducto'] ?></td>
                                <td><?php echo $producto['nombre'] ?></td>
                                <td><?php echo $producto['stock'] ?></td>
                                <td><?php echo $producto['precio'] ?></td>
                                <td><?php echo $producto['descripcion'] ?></td>
                                <td><?php if ($producto['estado'] === 1) {
                                    echo "Activo";
                                } else {
                                    echo "Inactivo";
                                } ?></td>
                                <td>
                                    <button class="btn btn-success btnMostrarInsumos" data-bs-toggle="modal"
                                        data-bs-target="#modalMostrarInsumos">ver</button>
                                </td>
                                <td>
                                    <button class="btn btn-warning btnEditarProducto"
                                        data-id="<?= $producto['idProducto'] ?>" data-bs-toggle="modal"
                                        data-bs-target="#modalEditarProducto">Editar</button>
                                </td>
                                <td>
                                    <form action="<?= BASE_URL . 'controller/productos/eliminarProducto.php' ?>"
                                        method="POST">
                                        <input type="hidden" name="btnIdProducto" value="<?= $producto['idProducto'] ?>">
                                        <button class="btn btn-danger">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

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
                                            <div class="col-4">

                                            </div>
                                            <div class="col-4">

                                            </div>
                                            <div class="col-4">

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


    <?php require BASE_PATH . 'views/layouts/footer.php' ?>
    <script src="<?php BASE_URL . 'assets/js/ajaxJs/productoPorId.js' ?>"></script>
    <?php require BASE_PATH . 'views/layouts/modals/modalsProductos/modalEditarProducto.php' ?>
    <?php require BASE_PATH . 'views/layouts/modals/modalsProductos/modalCrearProducto.php' ?>

</body>


</html>