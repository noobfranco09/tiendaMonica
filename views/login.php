<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/tiendaMonica/rutas/rutaGlobal.php' ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once BASE_PATH . 'views/layouts/head.php' ?>
</head>

<body class="login-body">
    <header class="main-header">
        <h1>Tienda Artística</h1>
        <p>Camisetas estampadas, vasos, arte y más</p>
    </header>
    <?php require BASE_PATH . 'views/layouts/login.php' ?>
    <?php require BASE_PATH . 'views/layouts/footer.php' ?>
    <?php require BASE_PATH . 'views/layouts/error/errorLogin.php' ?>

    <script src="<?php echo BASE_URL . 'assets/js/bootstrap.bundle.js' ?>"></script>
</body>

</html>