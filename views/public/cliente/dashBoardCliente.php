<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once BASE_PATH . 'views/layouts/head.php' ?>
</head>

<body>
    <div class="layout">
        <?php require BASE_PATH . 'views/layouts/navBarCliente.php' ?>
        <main class="main-content">
            <?php require BASE_PATH . 'views/layouts/header.php' ?>
            <div class="content-wrapper">
                <?php
                // Esta vista recibe la variable $resultado desde el controlador
                ?>

                <div class="container py-4">
                    <h2 class="text-center mb-4">Productos disponibles</h2>

                    <?php if (isset($_SESSION['error'])): ?>
                        <div class="alert alert-danger text-center">
                            <?php echo htmlspecialchars($_SESSION['error']); ?>
                        </div>
                        <?php unset($_SESSION['error']); ?>
                    <?php endif; ?>

                    <?php if (!empty($resultado)): ?>
                        <div class="row g-4">
                            <?php foreach ($resultado as $producto): ?>
                                <div class="col-sm-6 col-md-4 col-lg-3">
                                    <div class="card h-100 shadow-sm">
                                        <img src="<?php echo htmlspecialchars($producto['imagen'] ?? BASE_URL . 'assets/img/no-image.png'); ?>"
                                            class="card-img-top" alt="<?php echo htmlspecialchars($producto['nombre']); ?>"
                                            style="object-fit: cover; height: 180px;">
                                        <div class="card-body d-flex flex-column">
                                            <h5 class="card-title mb-2"><?php echo htmlspecialchars($producto['nombre']); ?>
                                            </h5>
                                            <p class="card-text flex-grow-1 text-muted">
                                                <?php echo htmlspecialchars($producto['descripcion'] ?? 'Sin descripción'); ?>
                                            </p>
                                            <div class="mt-auto">
                                                <p class="fw-semibold mb-2 text-primary">
                                                    $<?php echo number_format($producto['precio'], 2, ',', '.'); ?>
                                                </p>
                                                <button class="btn btn-primary w-100 btnVerDetalle"
                                                    data-id="<?php echo $producto['idProducto']; ?>">
                                                    Ver detalle
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-info text-center">
                            No hay productos disponibles en este momento.
                        </div>
                    <?php endif; ?>
                </div>

            </div>
        </main>
    </div>
    <?php require BASE_PATH . 'views/layouts/footer.php' ?>
</body>

</html>