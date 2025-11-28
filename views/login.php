<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/tiendaMonica/rutas/rutaGlobal.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once BASE_PATH . 'views/layouts/head.php'; ?>
</head>

<body class="login-body">
    <header class="main-header">
        <h1>Tienda Artística</h1>
        <p>Camisetas estampadas, vasos, arte y más</p>
    </header>
    <?php require BASE_PATH . 'views/layouts/login.php'; ?>
    <?php require BASE_PATH . 'views/layouts/footerLogin.php'; ?>
    <?php require_once BASE_PATH . 'views/layouts/error/error.php'; ?>

</body>

</html>