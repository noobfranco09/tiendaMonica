<?php require $_SERVER['DOCUMENT_ROOT'] . '/tiendaMonica/rutas/rutaGlobal.php' ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once BASE_PATH . 'views/layouts/head.php' ?>
    <!-- CDN Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>

</head>

<body>
    <div class="layout">
        <?php require BASE_PATH . 'views/layouts/navbar.php' ?>
        <main class="main-content">
            <?php require BASE_PATH . 'views/layouts/header.php' ?>

            <div class="content-box">
                <div class="row">
                    <div class="col-12" style="display:flex; gap:15px;">
                        <button class="btn btn-primary btn-ventasMes" >Ventas por Mes</button>
                        <button class="btn btn-primary btn-masVendido" >Productos Más Vendidos</button>
                        <button class="btn btn-primary btn-comprasVentas" >Compras vs Ventas</button>
                    </div>
                </div>
            </div>

            <div class="content-wrapper">
                <canvas id="grafico"></canvas>
            </div>

        </main>
    </div>

    <?php require BASE_PATH . 'views/layouts/footer.php' ?>
    <script>
        window.APP_URL= "<?= BASE_URL?>";
    </script>
    <script src="<?php echo BASE_URL.'assets\js\reportes\reportes.js' ?>"></script>


</body>

</html>
