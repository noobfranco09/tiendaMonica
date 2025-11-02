<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/tiendaMonica/rutas/rutaGlobal.php' ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso no autorizado</title>
    <link rel="stylesheet" href="<?php echo BASE_URL . 'assets/css/bootstrap.min.css' ?>">
    <!-- Font Awesome para íconos -->
    <link rel="stylesheet" href="<?php echo BASE_URL . 'assets/fontAwesome/css/all.min.css' ?>">
</head>

<body class="bg-light d-flex align-items-center" style="min-height: 100vh;">

    <div class="container text-center">
        <div class="card shadow border-1 mx-auto" style="max-width: 480px;">
            <div class="card-body p-5">
                <div class="mb-4 text-danger">
                    <i class="fa-solid fa-triangle-exclamation fa-4x"></i>
                </div>
                <h3 class="mb-3">Acceso no autorizado</h3>
                <p class="text-muted mb-4">
                    Lo sentimos, no tienes permiso para acceder a esta sección.
                    Si crees que esto es un error, contacta con el administrador del sitio.
                </p>
            </div>
        </div>
    </div>

    <script src="<?php echo BASE_URL . '/assets/js/bootstrap.bundle.js' ?>"></script>
</body>

</html>