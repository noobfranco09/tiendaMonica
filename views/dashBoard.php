<?php
session_start();
include "../models/mySql.php";
$db = new Mysql();
$consulta = "select*from productos where estado = 1";
$resultado = $db->consultaPreparada($consulta);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dashBoard</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <div class="header">
            <div class="row ">
                <div class="col-12 d-flex justify-content-center">
                    <h2>Tienda</h2>
                </div>
            </div>
        </div>
        <aside>
            <div class="row">
                <div class="col-12">
                    <h2>prueba section</h2>
                </div>
            </div>
        </aside>


        <section>
            <div class="row m-1">
                <div class="col-12">
                    <a class="btn btn-primary" href="../controller/crearProducto.php">Crear Producto</a>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <?php
                    if (empty($resultado)) {
                        die("No hay productos para mostrar");
                    }
                    ?>
                    <?php foreach ($resultado as $producto): ?>
                        <div class="card" style="width: 18rem;">
                            <img src="..." class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $producto['nombre'] ?></h5>
                                <div class="row p-1">
                                    <div class="col-6"><?php echo "Precio: <br> " . $producto['precio'] ?></div>
                                    <div class="col-6"><?php echo "Stock: <br> " . $producto['stock'] ?></div>
                                </div>
                                <div class="row p-1">
                                    <div class="col-12">
                                        <p class="card-text"><?php echo $producto['descripcion'] ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <a class="btn btn-primary"
                                            href="../controller/eliminarProducto.php?=<?php echo $producto['idProducto']; ?>">Eliminar</a>
                                    </div>
                                    <div class="col-6">
                                        <a class="btn btn-primary"
                                            href="../controller/editarProducto.php?=<?php echo $resultado; ?>">Editar</a>
                                    </div>
                                </div>


                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
<!-- *********************************************************** Modal crear producto ************************************************************-->
            <div class="row">
                <div class="col-12">
                    <div class="modal" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Crear Producto</h5>
                            0        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="../controller/crearProducto.php" method="POST">
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="form-label" for="correo">Correo</label>
                                            <input class="form-control" type="email" required name="correo" id="correo">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="contraseña">Contraseña</label>
                                            <input class="form-control" type="text" required name="contraseña"
                                                id="contraseña">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary">Guardar cambios</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
<!-- *********************************************************** Fin modal ************************************************************-->
        </section>

    </div>


    <script src="../assets/js/bootstrap.bundle.js"></script>
</body>

</html>