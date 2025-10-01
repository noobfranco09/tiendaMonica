<!DOCTYPE html>
<html lang="en">

<head>
    <?php require BASE_PATH . 'views/layouts/head.php' ?>
</head>

<body>

    <div class="layout">
        <?php require BASE_PATH . 'views/layouts/navBar.php' ?>
        <main class="main-content">
            <?php require BASE_PATH . 'views/layouts/header.php' ?>
            <div class="content-box">

                <div class="row p-3">
                    <div class="col-12">
                        <button class="btn btn-primary " data-bs-toggle="modal"
                            data-bs-target="#modalCrearCategoriaProducto">Crear categoría producto</button>
                    </div>
                </div>
            </div>
            
            <div class="content-wrapper">
                <table class="table table-striped" id="tablaProvedores">
                    <thead>
                        <tr class=" table-primary">
                            <th scope="col">Id</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Descripción</th>
                            <th scope="col">Estado</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($categoriaProducto as $catProducto): ?>
                            <tr >
                                <td><?php echo $catProducto['idTipoProducto'] ?></th>
                                <td><?php echo $catProducto['nombre'] ?></td>
                                <td><?php echo $catProducto['descripcion'] ?></td>
                                <td><?php if ($catProducto['estado'] === 1) {
                                    echo "ACTIVO";
                                } else {
                                    echo "INACTIVO";
                                } ?></td>
                                <td>
                                    <button class="btn btn-success btnEditarProvedor" data-bs-toggle="modal"
                                        data-bs-target="#modalEditarProvedor"
                                        data-id="<?php echo $catProducto['idTipoProducto'] ?>">Editar</button>
                                </td>
                                <td>
                                    <form method="POST"
                                        action="<?php echo BASE_URL . 'controller/provedores/eliminarProvedor.php' ?>"
                                        style="display:inline;">
                                        <button class="btn btn-danger btnEliminarProvedor" name="idProvedor"
                                            value="<?php echo $catProducto['idTipoProducto'] ?>">Eliminar</button>
                                    </form>
                                </td>

                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>


    <?php require BASE_PATH . 'views/layouts/footer.php' ?>
    <script src=" <?php echo BASE_URL . 'assets/js/dataTable/tipoProductos.js' ?>"></script>

    <script src="<?php echo BASE_URL . 'assets/js/provedores/modalEditarProvedor.js' ?>"></script>

    <?php require_once BASE_PATH . 'views/layouts/modals/modalsCategoriaProductos/crearCategoriaProducto.php'; ?>
    <?php require_once BASE_PATH . 'views/layouts/modals/modalsProvedores/modalEditarProvedores.php'; ?>
    <?php require_once BASE_PATH . 'views/layouts/modals/modalsProvedores/modalAsignarCategoria.php'; ?>
    <script src="<?php echo BASE_URL . 'assets/js/provedores/modalAsignarCategoria.js' ?>"></script>
    <script src="<?php echo BASE_URL . 'assets/js/provedores/modalEditarProvedor.js' ?>"></script>

</body>

</html>