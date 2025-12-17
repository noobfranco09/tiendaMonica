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

            <div class="content-wrapper">
                <table class="table table-striped table-white align-middle text-center" id="tablaPedidos">
                    <thead>
                        <tr class="table-primary text-dark">
                            <th></th> <!-- dt-control -->
                            <th>ID</th>
                            <th>Cliente</th>
                            <th>Fecha</th>
                            <th>Observaciones</th>
                            <th>Total</th>
                            <th>Estado</th>
                            <th>Aceptado</th>
                            <th>Usuario</th>
                            <th></th> <!-- acciones -->
                        </tr>
                    </thead>
                    <tbody>

                        <?php if (!empty($pedidos)): ?>
                            <?php foreach ($pedidos as $pedido): ?>
                                <tr>
                                    <td></td>
                                    <td><?= $pedido['idPedido'] ?></td>
                                    <td><?= $pedido['nombreCliente'] . ' ' . $pedido['apellidoCliente'] ?></td>
                                    <td><?= $pedido['fechaPedido'] ?></td>
                                    <td><?= $pedido['observaciones'] ?? '-' ?></td>
                                    <td>$<?= number_format($pedido['total'], 2) ?></td>
                                    <td>
                                        <span class="badge <?= $pedido['estado'] ? 'bg-success' : 'bg-danger' ?>">
                                            <?= $pedido['estado'] ? 'Activo' : 'Inactivo' ?>
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge <?= $pedido['aceptado'] ? 'bg-info' : 'bg-secondary' ?>">
                                            <?= $pedido['aceptado'] ? 'Sí' : 'No' ?>
                                        </span>
                                    </td>
                                    <td><?= $pedido['idUsuario'] ?></td>
                                    <td>
                                        <button class="btn btn-success btn-sm btn-ver-pedido"
                                            data-id="<?= $pedido['idPedido'] ?>"
                                            data-cliente="<?= htmlspecialchars($pedido['nombreCliente'] . ' ' . $pedido['apellidoCliente']) ?>"
                                            data-fecha="<?= $pedido['fechaPedido'] ?>"
                                            data-total="<?= number_format($pedido['total'], 2, '.', '') ?>"
                                            data-variantes='<?= json_encode($pedido["variantes"]) ?>' data-bs-toggle="modal"
                                            data-bs-target="#modalPedido">
                                            <i class="fa-solid fa-eye"></i>
                                        </button>
                                    </td>

                                </tr>

                            <?php endforeach; ?>
                        <?php endif; ?>

                    </tbody>
                </table>
            </div>

        </main>
    </div>

    <!-- MODAL -->
    <div class="modal fade" id="modalPedido" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content bg-dark text-white">
                <div class="modal-header">
                    <h5 class="modal-title">
                        Pedido #<span id="modalPedidoId"></span>
                    </h5>
                    <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <p><strong>Cliente:</strong> <span id="modalCliente"></span></p>
                    <p><strong>Fecha:</strong> <span id="modalFecha"></span></p>
                    <p><strong>Total:</strong> $<span id="modalTotal"></span></p>

                    <hr>

                    <table class="table table-sm table-dark table-striped text-center">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Producto</th>
                                <th>Talla</th>
                                <th>Color</th>
                                <th>Cantidad</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody id="modalVariantesBody">
                            <!-- JS inserta filas aquí -->
                        </tbody>
                    </table>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-outline-light" data-bs-dismiss="modal">
                        Cerrar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <?php require BASE_PATH . 'views/layouts/footer.php' ?>
    <script src="<?= BASE_URL ?>assets/js/dataTable/pedidos.js"></script>
    <script src="<?php echo BASE_URL.'assets\js\pedidos\llenarVariantes.js' ?>"></script>
</body>

</html>