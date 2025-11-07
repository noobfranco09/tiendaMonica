<?php require $_SERVER['DOCUMENT_ROOT'] . '/tiendaMonica/rutas/rutaGlobal.php' ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <?php require_once BASE_PATH . 'views/layouts/head.php' ?>
</head>

<body>
    <div class="layout">
        <?php require BASE_PATH . 'views/layouts/navbar.php' ?>

        <main class="main-content">
            <?php require BASE_PATH . 'views/layouts/header.php' ?>

            <!-- Contenedor principal -->
            <div class="content-box">

                <!-- Botón crear pedido -->
                <div class="row mb-4">
                    <div class="col-12 text-end">
                        <button class="btn btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#modalCrearPedido">
                            <i class="fa-solid fa-cart-plus me-2"></i>Crear Pedido
                        </button>
                    </div>
                </div>

                <!-- Tabla de pedidos -->
                <div class="content-wrapper">
                    <div class="table-responsive">
                        <table id="tablaPedidos" class="table table-dark table-striped table-bordered text-center align-middle shadow-lg">
                            <thead class="table-light text-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Cliente</th>
                                    <th>Fecha</th>
                                    <th>Observaciones</th>
                                    <th>Total</th>
                                    <th>Estado</th>
                                    <th>Aceptado</th>
                                    <th>Usuario</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($pedidos as $pedido): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($pedido['idPedido']); ?></td>
                                        <td><?php echo htmlspecialchars($pedido['nombreCliente'] . ' ' . $pedido['apellidoCliente']); ?></td>
                                        <td><?php echo htmlspecialchars($pedido['fechaPedido']); ?></td>
                                        <td><?php echo htmlspecialchars($pedido['observaciones']); ?></td>
                                        <td>$<?php echo number_format($pedido['total'], 2); ?></td>
                                        <td>
                                            <span class="badge <?php echo $pedido['estado'] ? 'bg-success' : 'bg-danger'; ?>">
                                                <?php echo $pedido['estado'] ? 'Activo' : 'Inactivo'; ?>
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge <?php echo $pedido['aceptado'] ? 'bg-info' : 'bg-secondary'; ?>">
                                                <?php echo $pedido['aceptado'] ? 'Sí' : 'No'; ?>
                                            </span>
                                        </td>
                                        <td><?php echo htmlspecialchars($pedido['idUsuario']); ?></td>
                                        <td>
                                            <button class="btn btn-success btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#modalDetallePedido<?php echo $pedido['idPedido']; ?>">
                                                <i class="fa-solid fa-eye"></i>
                                            </button>
                                            <button class="btn btn-warning btn-sm">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </button>
                                            <button class="btn btn-danger btn-sm">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>

                                    <!-- Modal detalle pedido -->
                                    <div class="modal fade" id="modalDetallePedido<?php echo $pedido['idPedido']; ?>" tabindex="-1"
                                        aria-labelledby="labelDetallePedido<?php echo $pedido['idPedido']; ?>" aria-hidden="true">
                                        <div class="modal-dialog modal-lg modal-dialog-centered">
                                            <div class="modal-content bg-dark text-white border border-secondary">
                                                <div class="modal-header border-0">
                                                    <h5 class="modal-title fw-semibold" id="labelDetallePedido<?php echo $pedido['idPedido']; ?>">
                                                        <i class="fa-solid fa-file-invoice me-2 text-primary"></i>
                                                        Detalle del Pedido #<?php echo $pedido['idPedido']; ?>
                                                    </h5>
                                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                                        aria-label="Cerrar"></button>
                                                </div>

                                                <div class="modal-body">
                                                    <p><strong>Cliente:</strong> <?php echo htmlspecialchars($pedido['nombreCliente'] . ' ' . $pedido['apellidoCliente']); ?></p>
                                                    <p><strong>Fecha:</strong> <?php echo htmlspecialchars($pedido['fechaPedido']); ?></p>
                                                    <p><strong>Observaciones:</strong> <?php echo htmlspecialchars($pedido['observaciones']); ?></p>
                                                    <p><strong>Total:</strong> $<?php echo number_format($pedido['total'], 2); ?></p>

                                                    <hr class="border-secondary">

                                                    <h6 class="text-primary mb-3"><i class="fa-solid fa-shirt me-2"></i>Variantes asociadas</h6>
                                                    <div class="table-responsive">
                                                        <table class="table table-sm table-dark table-striped text-center">
                                                            <thead class="table-secondary text-dark">
                                                                <tr>
                                                                    <th>ID Var.</th>
                                                                    <th>Producto</th>
                                                                    <th>Talla</th>
                                                                    <th>Color</th>
                                                                    <th>Cantidad</th>
                                                                    <th>Subtotal</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php foreach ($pedido['variantes'] as $var): ?>
                                                                    <tr>
                                                                        <td><?php echo htmlspecialchars($var['idVariante']); ?></td>
                                                                        <td><?php echo htmlspecialchars($var['producto']); ?></td>
                                                                        <td><?php echo htmlspecialchars($var['talla']); ?></td>
                                                                        <td><?php echo htmlspecialchars($var['color']); ?></td>
                                                                        <td><?php echo htmlspecialchars($var['cantidad']); ?></td>
                                                                        <td>$<?php echo number_format($var['subtotal'], 2); ?></td>
                                                                    </tr>
                                                                <?php endforeach; ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>

                                                <div class="modal-footer border-0">
                                                    <button type="button" class="btn btn-outline-light" data-bs-dismiss="modal">
                                                        <i class="fa-solid fa-xmark me-1"></i> Cerrar
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <?php require BASE_PATH . 'views/layouts/footer.php' ?>
</body>
</html>
