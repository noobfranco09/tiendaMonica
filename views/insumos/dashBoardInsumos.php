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
            <div class="content-box">
                <div class="row">
                    <div class="col-12">
                        <button class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#modalCrearInsumo">Crear
                            Insumo</button>
                    </div>
                </div>
            </div>
            <div class="content-wrapper">


                <table class="table table-striped" id="tablaInsumos">
                    <thead>
                        <tr class=" table-primary"  >
                            <th scope="col">Id</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Descripción</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Estado</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($resultado as $insumos): ?>
                            <tr >
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
                                
                                    <form action="<?php echo BASE_URL . 'controller/insumos/eliminarInsumo.php' ?>"
                                        method="POST">
                                        <input type="hidden" name="idInsumo" value="<?php echo $insumos['idInsumo'] ?>">
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
    <script src=" <?php echo BASE_URL . 'assets/js/dataTable/insumos.js' ?>"></script>

    <?php require BASE_PATH . 'views/layouts/modals/modalsInsumos/modalEditarInsumo.php' ?>
    <?php require BASE_PATH . 'views/layouts/modals/modalsInsumos/modalCrearInsumo.php' ?>
    <script src="<?php echo BASE_URL . 'assets/js/insumos/modalEditarInsumo.js' ?>"></script>

</body>


</html>