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
                <div class="row">
                    <div class="col-12">
                        <button class="btn btn-primary " data-bs-toggle="modal"
                            data-bs-target="#modalCrearProducto">Crear Producto</button>
                    </div>
                </div>

                <table class="table table-striped" id="tablaProductos">
                    <thead>
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
                        <?php if (!empty($resultado)): ?>
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
                                    <button class="btn btn-success btnMostrarDetalle" data-bs-toggle="modal"
                                        data-bs-target="#modalMostrarInsumos"
                                        data-id="<?php echo $producto['idProducto'] ?>">ver</button>
                                </td>
                                <td>
                                    <button class="btn btn-success btnAsignarInsumo" data-bs-toggle="modal"
                                        data-bs-target="#modalAsignarInsumos"
                                        data-id="<?php echo $producto['idProducto'] ?>">Asignar Insumo</button>
                                </td>
                                <td>
                                    <button class="btn btn-warning btnEditarProducto"
                                        data-id="<?php echo $producto['idProducto'] ?>" data-bs-toggle="modal"
                                        data-bs-target="#modalEditarProducto">Editar</button>
                                </td>
                                <td>
                                    <form action="<?php echo BASE_URL . 'controller/productos/eliminarProducto.php' ?>"
                                        method="POST">
                                        <input type="hidden" name="btnIdProducto" value="<?= $producto['idProducto'] ?>">
                                        <button class="btn btn-danger">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        
                        <?php endif?>
                    </tbody>
                </table>
                <!--  -->

            </div>


        </main>

    </div>


    <?php require BASE_PATH . 'views/layouts/footer.php' ?>
    <script src="<?php echo BASE_URL . 'assets/js/ajaxJs/productoPorId.js' ?>"></script>
    <script src="<?php echo BASE_URL . 'assets/js/ajaxJs/asignarInsumo.js' ?>"></script>
    <script src="<?php echo BASE_URL . 'assets/js/ajaxJs/detalleProducto.js' ?>"></script>
    <?php require BASE_PATH . 'views/layouts/modals/modalsProductos/modalEditarProducto.php' ?>
    <?php require BASE_PATH . 'views/layouts/modals/modalsProductos/modalCrearProducto.php' ?>
    <?php require BASE_PATH . 'views/layouts/modals/modalsProductos/modalMostrarDetallesProducto.php' ?>
    <?php require BASE_PATH . 'views/layouts/modals/modalsProductos/modalAsignarInsumos.php' ?>

</body>


</html>