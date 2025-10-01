<?php require $_SERVER['DOCUMENT_ROOT'] . '/tiendaMonica/rutas/rutaGlobal.php' ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require BASE_PATH . '/views/layouts/head.php' ?>
</head>

<body>

    <div class="layout">
        <?php require BASE_PATH . '/views/layouts/navBar.php' ?>
        <main class="main-content">
            <?php require BASE_PATH . '/views/layouts/header.php' ?>
            <div class="content-box">
                <div class="row">
                    <div class="col-12">
                        <button class="btn btn-primary  btnCrearCategoria" data-bs-toggle="modal"
                            data-bs-target="#modalCrearCategoria">CrearCategoría</button>
                    </div>
                </div>
            </div>
            <div class="content-wrapper">
                <table class="table table-striped" id="tablaCategorias">
                    <thead>
                        <tr class=" table-primary">
                            <th scope="col">Id</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Descripción</th>
                            <th scope="col">Estado</th>
                            <th></th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($categorias as $categoria): ?>
                            <tr>
                                <td><?php echo $categoria['idCategoria'] ?></th>
                                <td><?php echo $categoria['nombre'] ?></td>
                                <td><?php echo $categoria['descripcion'] ?></td>
                                <td><?php if ($categoria['estado'] === 1) {
                                    echo "ACTIVO";
                                } else {
                                    echo "INACTIVO";
                                } ?></td>
                                <td>
                                    <button class="btn btn-warning btnEditarCategoria"
                                        data-id="<?php echo $categoria['idCategoria'] ?>" data-bs-toggle="modal"
                                        data-bs-target="#modalEditarCategoria">Editar</button>

                                    <form method="POST"
                                        action="<?php echo BASE_URL . 'controller/categorias/eliminarCategoria.php' ?>"
                                        style="display:inline;  ">
                                        <input type="hidden" name="eliminarIdCategoria"
                                            value="<?php echo $categoria['idCategoria'] ?>">
                                        <button type="submit" class="btn btn-danger ">Eliminar</button>
                                    </form>


                                </td>

                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>

    <?php require BASE_PATH . '/views/layouts/footer.php' ?>
    <script src=" <?php echo BASE_URL . 'assets/js/dataTable/categorias.js' ?>"></script>

    <?php require_once BASE_PATH . 'views/layouts/modals/modalsCategorias/crearCategoria.php'; ?>
    <?php require_once BASE_PATH . 'views/layouts/modals/modalsCategorias/editarCategoria.php'; ?>
    <script src="<?php echo BASE_URL . 'assets/js/categorias/modalEditarCategoria.js'; ?>"></script>
    <?php require BASE_PATH . '/views/layouts/error/error.php' ?>

</body>

</html>