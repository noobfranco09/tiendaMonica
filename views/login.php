<?php require_once $_SERVER['DOCUMENT_ROOT'].'/tiendaMonica/rutas/rutaGlobal.php' ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once BASE_PATH.'views/layouts/head.php' ?>
</head>

<body class="login-body">
    <?php require BASE_PATH.'views/layouts/header.php' ?>
  
    <?php require BASE_PATH.'views/layouts/login.php' ?>
    <?php require BASE_PATH.'views/layouts/footer.php' ?>
    <?php require BASE_PATH.'views/layouts/error/errorLogin.php' ?>

    <script src="<?php echo BASE_URL.'assets/js/bootstrap.bundle.js'?>"></script>
</body>

</html>