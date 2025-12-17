<?php
require $_SERVER['DOCUMENT_ROOT'] . '/tiendaMonica/rutas/rutaGlobal.php';

require_once BASE_PATH .'models/ReportesDashboardModel.php';

header("Content-Type: application/json");
$data = json_decode(file_get_contents("php://input"), true);


$tipo = $data["tipo"] ?? "";
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
