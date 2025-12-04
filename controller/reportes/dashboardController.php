<?php
require_once __DIR__ . "/../../models/ReportesDashboardModel.php";

header("Content-Type: application/json");

$tipo = $_GET["tipo"] ?? "";
$model = new ReportesDashboardModel();

switch ($tipo) {

    case "ventas":
        echo json_encode($model->ventasPorMes());
        break;

    case "productos":
        echo json_encode($model->productosMasVendidos());
        break;

    case "comparativa":
        echo json_encode($model->comprasVsVentas());
        break;

    default:
        echo json_encode(["error" => "Tipo no válido"]);
}
