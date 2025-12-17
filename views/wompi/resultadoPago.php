<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/tiendaMonica/rutas/rutaGlobal.php';
require BASE_PATH . 'models/mySql.php';
require BASE_PATH . 'functions/helpers/session.php';

$referencia = $_GET['reference'] ?? null;

if (!$referencia) {
    $_SESSION['tipoMensaje'] = 'error';
    $_SESSION['mensaje'] = 'Referencia inválida.';
    header('Location:' . BASE_URL);
    exit;
}

$db = new Mysql();

$pedido = $db->consultaPreparada(
    "SELECT idPedido, estado, total FROM pedido WHERE referencia = ?",
    "s",
    [$referencia]
);

if (empty($pedido)) {
    $_SESSION['tipoMensaje'] = 'error';
    $_SESSION['mensaje'] = 'Pedido no encontrado.';
    header('Location:' . BASE_URL);
    exit;
}

$estado = (int)$pedido[0]['estado'];

// Si el pago fue aprobado → limpiar sesiones
if ($estado === 1) {
    unset($_SESSION['carrito']);
    unset($_SESSION['pedido_pendiente']);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <?php require BASE_PATH . 'views/layouts/head.php'; ?>
</head>

<body>
<div class="layout">
    <?php require BASE_PATH . 'views/layouts/navBarCliente.php'; ?>

    <main class="main-content">
        <?php require BASE_PATH . 'views/layouts/header.php'; ?>

        <div class="content-wrapper">

            <?php if ($estado === 1): ?>

                <h2 class="text-success"> Pago aprobado</h2>
                <p>Gracias por tu compra.</p>
                <p><strong>Referencia:</strong> <?= htmlspecialchars($referencia) ?></p>

                <a href="<?= BASE_URL ?>controller/usuario/dashBoardUsuario.php"
                   class="btn btn-success mt-3">
                    Volver al inicio
                </a>

            <?php elseif ($estado === 2): ?>

                <h2 class="text-danger">Pago rechazado</h2>
                <p>El pago no pudo completarse.</p>

                <a href="<?= BASE_URL ?>views/wompi/pagarPedido.php"
                   class="btn btn-warning mt-3">
                    Intentar nuevamente
                </a>

            <?php else: ?>

                <h2> Procesando pago</h2>
                <p>Estamos validando tu pago, por favor espera...</p>

                <script>
                    setTimeout(() => {
                        location.reload();
                    }, 3000);
                </script>

            <?php endif; ?>

        </div>
    </main>
</div>

<?php require BASE_PATH . 'views/layouts/footer.php'; ?>
</body>
</html>
