<!DOCTYPE html>
<html lang="en">

<head>
    <?php require BASE_PATH . '/views/layouts/head.php' ?>
</head>

<body>


    <?php require BASE_PATH . '/views/layouts/header.php' ?>
    <?php require BASE_PATH . '/views/layouts/navBar.php' ?>

    <main>
        <div class="row d-flex justify-content-center ">
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

                    <tbody>
                        <?php foreach ($provedores as $provedor): ?>
                            <tr>
                                <td><?php echo $provedor['idProvedor'] ?></td>
                                <td><?php echo $provedor['nombre'] ?></td>
                                <td><?php echo $provedor['contacto'] ?></td>
                                <td><?php echo $provedor['estado'] ?></td>
                                <td>
                                    <button class="btn btn-success btnEditarProvedor"
                                        data-id="<?php echo $provedor['idProvedor'] ?>">Editar</button>
                                    <button class="btn btn-danger btnEliminarProvedor"
                                        data-id="<?php echo $provedor['idProvedor'] ?>">Eliminar</button>
                                </td>

                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <?php require BASE_PATH . '/views/layouts/footer.php' ?>
     <script src="<?php echo BASE_URL.'/assets/js/provedores/modalEditarProvedor.js' ?>"></script>
</body>

</html>