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
                            data-bs-target="#modalCrearInsumo">Crear Insumo</button>
                    </div>
                </div>
                <table class="table table-striped" id="tablaInsumos">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Descripción</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($resultado as $insumos): ?>
                            <tr>
                                <td><?php echo $insumos['idInsumo'] ?></td>
                                <td><?php echo $insumos['nombre'] ?></td>
                                <td><?php echo $insumos['descripcion'] ?></td>
                                <td><?php echo $insumos['cantidad'] ?></td>
                                <td><?php if ($insumos['estado'] === 1) {
                                    echo "Activo";
                                } else {
                                    echo "Inactivo";
                                } ?></td>
                                <td>
                                    <button class="btn btn-warning btnEditarInsumo" data-id="<?= $insumos['idInsumo'] ?>"
                                        data-bs-toggle="modal" data-bs-target="#modalEditarInsumo">Editar</button>
                                </td>
                                <td>
                                    <form action="<?= BASE_URL . 'controller/insumos/eliminarInsumo.php' ?>" method="POST">
                                        <input type="hidden" name="idInsumo" value="<?= $insumos['idInsumo'] ?>">
                                        <button class="btn btn-danger">Eliminar</button>
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
    <?php require BASE_PATH . 'views/layouts/modals/modalsInsumos/modalEditarInsumo.php' ?>
    <?php require BASE_PATH . 'views/layouts/modals/modalsInsumos/modalCrearInsumo.php' ?>

</body>


</html>