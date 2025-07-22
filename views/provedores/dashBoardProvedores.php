<!DOCTYPE html>
<html lang="en">

<head>
    <?php require BASE_PATH . '/views/layouts/head.php' ?>
</head>

<body>


    <?php require BASE_PATH . '/views/layouts/header.php' ?>
    <?php require BASE_PATH . '/views/layouts/navBar.php' ?>

    <main>
        <div class="container ">

            <div class="row d-flex justify-content-center m-1 p-1">
                <div class="col-10 d-flex align-items-center">
                    <table class="table table-striped" id="tablaProvedores">
                        <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Contacto</th>
                                <th scope="col">Estado</th>
                                <th scope="col"></th>

                            </tr>
                        </thead>
                        <?php $idAnterior = ""; ?>
                        <tbody>
                            <?php foreach ($provedores as $provedor): ?>
                                <?php if ($provedor['idProvedor'] !== $idAnterior): ?>
                                    <tr class=" table-primary">
                                        <th><?php echo $provedor['idProvedor'] ?></th>
                                        <td><?php echo $provedor['nombreProvedor'] ?></td>
                                        <td><?php echo $provedor['contacto'] ?></td>
                                        <td><?php if ($provedor['estadoProvedor'] === 1) {
                                            echo "ACTIVO";
                                        } else {
                                            echo "INACTIVO";
                                        } ?></td>
                                        <td>

                                            <button class="btn btn-primary btnAsignarCategoria" data-bs-toggle="modal"
                                                data-bs-target="#modalAsignarCategoria"
                                                data-id="<?php echo $provedor['idProvedor'] ?>">
                                                Asignar Categoría
                                            </button>
                                            <button class="btn btn-success btnEditarProvedor"
                                                data-id="<?php echo $provedor['idProvedor'] ?>">Editar</button>

                                            <button class="btn btn-danger btnEliminarProvedor"
                                                data-id="<?php echo $provedor['idProvedor'] ?>">Eliminar</button>
                                        </td>

                                    </tr>
                                <?php endif; ?>

                                <tr>
                                    <td colspan="5">
                                        <table class="table">
                                            <thead>
                                                <?php if ($provedor['idProvedor'] !== $idAnterior): ?>
                                                    <tr>
                                                        <th scope="col" colspan="5">
                                                            <h5>Categorías/ <?php echo $provedor['nombreProvedor']; ?> </h5>
                                                        </th>
                                                    </tr>
                                                    <tr>
                                                        <th>Id Categoría </th>
                                                        <th>Nombre Categoría</th>
                                                        <th>Descripción </th>
                                                        <th>Estado</th>

                                                    </tr>
                                                <?php endif; ?>

                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th><?php echo $provedor['idCategoria'] ?></th>
                                                    <td><?php echo $provedor['nombreCategoria'] ?></td>
                                                    <td><?php echo $provedor['descripcion'] ?></td>
                                                    <td><?php echo $provedor['estadoCategoria'] ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <?php $idAnterior = $provedor['idProvedor']; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <?php require BASE_PATH . '/views/layouts/footer.php' ?>
    <script src="<?php echo BASE_URL . '/assets/js/provedores/modalEditarProvedor.js' ?>"></script>

    <?php require_once BASE_PATH . 'views/layouts/modals/modalsProvedores/modalCrearProvedor.php'; ?>
    <?php require_once BASE_PATH . 'views/layouts/modals/modalsProvedores/modalAsignarCategoria.php'; ?>
    <script src="<?php echo BASE_URL . '/assets/js/provedores/modalAsignarCategoria.js' ?>"></script>
</body>

</html>