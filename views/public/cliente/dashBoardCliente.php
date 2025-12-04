<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once BASE_PATH . 'views/layouts/head.php' ?>
</head>

<body>
    <div class="layout">
        <?php require BASE_PATH . 'views/layouts/navBarCliente.php' ?>
        <main class="main-content">
            <?php require BASE_PATH . 'views\layouts\header.php' ?>
            <div class="content-wrapper">

                <!-- carrito ////////////////////////////////////////////////////////// -->
                <button class="btn btn-primary position-fixed bottom-0 end-0 m-4 rounded-circle shadow" type="button"
                    data-bs-toggle="offcanvas" data-bs-target="#offcanvasCarrito" aria-controls="offcanvasCarrito"
                    style="width: 60px; height: 60px; z-index: 1055;">
                    <i class="fa-solid fa-cart-shopping fs-4"></i>
                </button>

                <!-- carrito fin /////////////////////////////////////////////////////////////// -->
                <!-- aquí inician las cards para los productos -->
                <div class="container py-4" id="contenedorCards">
                    <div class="row row-cols-1 row-cols-md-3 g-4">
                        <?php if (!empty($resultado)): ?>
                            <?php foreach ($resultado as $producto): ?>
                                <div class="col">
                                    <div class="card h-100 shadow p-3 bg-body-tertiary rounded">

                                        <img src="<?php echo BASE_URL . $producto['imagen']; ?>" class="card-img-top"
                                            alt="<?php echo htmlspecialchars($producto['nombre']); ?>">

                                        <div class="card-body">
                                            <h5 class="card-title mb-2">
                                                <?php echo htmlspecialchars($producto['nombre']); ?>
                                            </h5>

                                            <p class="card-text text-muted mb-2">
                                                <?php echo htmlspecialchars($producto['descripcion']); ?>
                                            </p>

                                            <div class="d-grid">
                                                <button class="btnAgregarAlCarrito btn btn-primary btn-sm"
                                                    data-bs-toggle="modal" data-bs-target="#modalCarrito"
                                                    data-producto="<?php echo $variante['idProducto']; ?>">
                                                    <i class="fa-solid fa-cart-plus me-1"></i> Ver producto
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>


                        <?php else: ?>
                            <div class="col-12 text-center">
                                <p class="text-muted">No hay productos disponibles.</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- aquí terminan las cards para los productos -->
            </div>
        </main>
    </div>

    <?php require BASE_PATH . 'views/layouts/footer.php' ?>
    <script src="<?php echo BASE_URL . 'assets\js\carritoDeCompras\modalAgregarProducto.js' ?>"></script>

    <?php require BASE_PATH . 'views\layouts\modals\carroDeCompras\modalCarrito.php' ?>
    <?php require BASE_PATH . 'views\layouts\modals\carroDeCompras\datosCliente.php' ?>
    <?php require BASE_PATH . 'views\layouts\modals\carroDeCompras\carrito.php' ?>




</body>

</html>