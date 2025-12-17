<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/tiendaMonica/rutas/rutaGlobal.php'; ?>
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
            <div id="content-wrapper">


                <h3>Confirmar pago</h3>
                <p>Referencia: <?= $pedido['referencia'] ?></p>
                <p>Total: $<?= number_format($pedido['total'], 0, ',', '.') ?></p>
                <div id="wompi-button"></div>
            </div>
        </main>
    </div>

    <?php require BASE_PATH . 'views/layouts/footer.php' ?>
    <?php require_once BASE_PATH . 'views/layouts/error/error.php' ?>
    <script src="https://checkout.wompi.co/widget.js" data-render="button" data-container="#wompi-button"
        data-public-key="pub_test_mASO4b7U6emw3hMNIAkWdnpOj0vP9krr" data-currency="COP" data-amount-in-cents="<?= $pedido['total'] * 100 ?>"
        data-reference="<?= $pedido['referencia'] ?>"
        data-redirect-url="http://localhost/tiendaMonica/views/wompi/resultadoPago.php">
        </script>

</body>

</html>