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
            <div class="content-wrapper">
                <div class="row d-flex justify-content-center">
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
                                    <tr class=" table-primary">
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
                                                data-id="<?php echo $provedor['idProvedor'] ?>">
                                                Asignar Categoría
                                            </button>
                                            <button class="btn btn-success btnEditarProvedor" data-bs-toggle="modal"
                                                data-bs-target="#modalEditarProvedor"
                                                data-id="<?php echo $provedor['idProvedor'] ?>">Editar</button>
                                            <form method="POST"
                                                action="<?php echo BASE_URL . 'controller/provedores/eliminarProvedor.php' ?>"
                                                style="display:inline;">
                                                <button class="btn btn-danger btnEliminarProvedor" name="idProvedor"
                                                    value="<?php echo $provedor['idProvedor'] ?>">Eliminar</button>
                                            </form>

                                        </td>

                                    </tr>


                                    <tr>
                                        <td colspan="5">
                                            <table class="table">

                                                <thead>
                                                    <?php if ($provedor['idProvedor'] !== $idAnterior): ?>
                                                        <tr>
                                                            <th scope="col" colspan="5">
                                                                <h5>Categorías/ <?php echo $provedor['nombre']; ?> </h5>
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
                                                <?php foreach ($categoriasProvedor as $categoria): ?>
                                                    <tbody>
                                                        <?php if ($categoria['idProvedor'] === $provedor['idProvedor']): ?>
                                                            <tr>
                                                                <th><?php echo $categoria['idCategoria'] ?></th>
                                                                <td><?php echo $categoria['nombreCategoria'] ?></td>
                                                                <td><?php echo $categoria['descripcion'] ?></td>
                                                                <td><?php echo $categoria['estadoCategoria'] ?></td>
                                                            </tr>
                                                        <?php endif; ?>
                                                    </tbody>
                                                <?php endforeach; ?>
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
    </div>

    <?php require BASE_PATH . 'views/layouts/footer.php' ?>
    <script src="<?php echo BASE_URL . 'assets/js/provedores/modalEditarProvedor.js' ?>"></script>

    <?php require_once BASE_PATH . 'views/layouts/modals/modalsProvedores/modalCrearProvedor.php'; ?>
    <?php require_once BASE_PATH . 'views/layouts/modals/modalsProvedores/modalEditarProvedores.php'; ?>
    <?php require_once BASE_PATH . 'views/layouts/modals/modalsProvedores/modalAsignarCategoria.php'; ?>
    <script src="<?php echo BASE_URL . 'assets/js/provedores/modalAsignarCategoria.js' ?>"></script>
    <script src="<?php echo BASE_URL . 'assets/js/provedores/modalEditarProvedor.js' ?>"></script>

</body>

</html>