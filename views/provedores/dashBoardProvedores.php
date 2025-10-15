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

                <div class="row">
                    <div class="col-12">
                        <button class="btn btn-primary " data-bs-toggle="modal"
                            data-bs-target="#modalCrearProvedor">Crear Provedor</button>
                    </div>
                </div>
            </div>
            <div class="content-wrapper">
                <table class="table table-striped" id="tablaProvedores">
                    <thead>
                        <tr class=" table-primary">
                            <th scope="col">Id</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Contacto</th>
                            <th scope="col">Estado</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col"></th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($provedores as $provedor): ?>
                            <tr>
                                <th><?php echo $provedor['idProvedor'] ?></th>
                                <td><?php echo $provedor['nombre'] ?></td>
                                <td><?php echo $provedor['contacto'] ?></td>
                                <td><?php if ($provedor['estado'] === 1) {
                                    echo "ACTIVO";
                                } else {
                                    echo "INACTIVO";
                                } ?></td>
                                <td>
                                    <button class="btn btn-primary btnAsignarCategoria" data-bs-toggle="modal"
                                        data-bs-target="#modalAsignarCategoria"
                                        data-id="<?php echo $provedor['idProvedor'] ?>">Asignar Categoría</button>
                                </td>
                                <td>
                                    <button class="btn btn-success btnVerProvedor" data-bs-toggle="modal"
                                        data-bs-target="#modalVerProvedor"
                                        data-id="<?php echo $provedor['idProvedor'] ?>">Ver</button>
                                </td>
                                <td>
                                    <button class="btn btn-success btnEditarProvedor" data-bs-toggle="modal"
                                        data-bs-target="#modalEditarProvedor"
                                        data-id="<?php echo $provedor['idProvedor'] ?>">Editar</button>
                                </td>
                                <td>

                                    <form method="POST"
                                        action="<?php echo BASE_URL . 'controller/provedores/eliminarProvedor.php' ?>"
                                        style="display:inline;">
                                        <button class="btn btn-danger btnEliminarProvedor" name="idProvedor"
                                            value="<?php echo $provedor['idProvedor'] ?>">Eliminar</button>
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
    <script src="<?php echo BASE_URL . 'assets/js/provedores/modalEditarProvedor.js' ?>"></script>
    <script src="<?php echo BASE_URL . 'assets/js/dataTable/provedores.js' ?>"></script>

    <?php require_once BASE_PATH . 'views/layouts/modals/modalsProvedores/modalCrearProvedor.php'; ?>
    <?php require_once BASE_PATH . 'views/layouts/modals/modalsProvedores/modalEditarProvedores.php'; ?>
    <?php require_once BASE_PATH . 'views/layouts/modals/modalsProvedores/modalAsignarCategoria.php'; ?>
    <?php require_once BASE_PATH . 'views/layouts/modals/modalsProvedores/modalVerDetalleProvedor.php'; ?>

    <script src="<?php echo BASE_URL . 'assets/js/provedores/modalAsignarCategoria.js' ?>"></script>
    <script src="<?php echo BASE_URL . 'assets/js/provedores/modalEditarProvedor.js' ?>"></script>

</body>

</html>