<?php require $_SERVER['DOCUMENT_ROOT'] . '/tiendaMonica/rutas/rutaGlobal.php' ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once BASE_PATH . 'views/layouts/head.php' ?>
    <!-- CDN Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <div class="layout">
        <?php require BASE_PATH . 'views/layouts/navbar.php' ?>
        <main class="main-content">
            <?php require BASE_PATH . 'views/layouts/header.php' ?>

            <div class="content-box">
                <div class="row">
                    <div class="col-12" style="display:flex; gap:15px;">
                        <button class="btn btn-primary" onclick="cargarGrafico('ventas')">Ventas por Mes</button>
                        <button class="btn btn-primary" onclick="cargarGrafico('productos')">Productos Más Vendidos</button>
                        <button class="btn btn-primary" onclick="cargarGrafico('comparativa')">Compras vs Ventas</button>
                    </div>
                </div>
            </div>

            <div class="content-wrapper">
                <canvas id="grafico" style="max-width:900px; margin:auto;"></canvas>
            </div>

        </main>
    </div>

    <?php require BASE_PATH . 'views/layouts/footer.php' ?>

    <script>
        let chartActual = null;

        async function cargarGrafico(tipo) {
            const url = "/tiendaMonica/controller/reportes/dashboardController.php?tipo=" + tipo;

            const res = await fetch(url);
            const data = await res.json();

            const ctx = document.getElementById('grafico').getContext('2d');

            if (chartActual) chartActual.destroy(); // limpiar gráfico anterior

            if (tipo === "ventas") {
                chartActual = new Chart(ctx, {
                    type: "line",
                    data: {
                        labels: data.meses,
                        datasets: [{
                            label: "Ventas por mes",
                            data: data.totales,
                            borderWidth: 2
                        }]
                    }
                });
            }

            if (tipo === "productos") {
                chartActual = new Chart(ctx, {
                    type: "bar",
                    data: {
                        labels: data.productos,
                        datasets: [{
                            label: "Cantidad vendida",
                            data: data.cantidades,
                            borderWidth: 2
                        }]
                    }
                });
            }

            if (tipo === "comparativa") {
                chartActual = new Chart(ctx, {
                    type: "bar",
                    data: {
                        labels: data.meses,
                        datasets: [
                            {
                                label: "Compras",
                                data: data.compras,
                                borderWidth: 2
                            },
                            {
                                label: "Ventas",
                                data: data.ventas,
                                borderWidth: 2
                            }
                        ]
                    }
                });
            }
        }
    </script>

</body>

</html>
