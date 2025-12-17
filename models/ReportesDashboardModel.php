<?php
require_once __DIR__ . "/mySql.php";

class ReportesDashboardModel extends Mysql
{
    /* ============================================================
       1. Ventas por mes
    ============================================================ */
    public function ventasPorMes()
    {
        $sql = "
            SELECT DATE_FORMAT(fecha, '%Y-%m') AS mes,
                   SUM(total) AS total
            FROM ventas
            GROUP BY mes
            ORDER BY mes ASC
        ";

        $rows = $this->consultaPreparada($sql);

        $meses = [];
        $totales = [];

        foreach ($rows as $r) {
            $meses[] = $r["mes"];
            $totales[] = $r["total"];
        }

        return [
            "meses" => $meses,
            "totales" => $totales
        ];
    }

    /* ============================================================
       2. Productos más vendidos
    ============================================================ */
    public function productosMasVendidos()
    {
        $sql = "
            SELECT p.nombre AS producto,
                   SUM(pv.cantidad) AS cantidadVendida
            FROM pedido_has_variantes pv
            INNER JOIN variantes v ON pv.variantes_idVariante = v.idVariante
            INNER JOIN productos p ON v.idProducto = p.idProducto
            GROUP BY producto
            ORDER BY cantidadVendida DESC
            LIMIT 10
        ";

        $rows = $this->consultaPreparada($sql);

        $productos = [];
        $cantidades = [];

        foreach ($rows as $r) {
            $productos[] = $r["producto"];
            $cantidades[] = $r["cantidadVendida"];
        }

        return [
            "productos" => $productos,
            "cantidades" => $cantidades
        ];
    }

    /* ============================================================
       3. Comparativa compras vs ventas por mes
    ============================================================ */
    public function comprasVsVentas()
    {
        /* Ventas */
        $sqlVentas = "
            SELECT DATE_FORMAT(fecha, '%Y-%m') AS mes,
                   SUM(total) AS total
            FROM ventas
            GROUP BY mes
        ";

        /* Compras */
        $sqlCompras = "
            SELECT DATE_FORMAT(fecha, '%Y-%m') AS mes,
                   SUM(total) AS total
            FROM compras
            GROUP BY mes
        ";

        $ventas = $this->consultaPreparada($sqlVentas);
        $compras = $this->consultaPreparada($sqlCompras);

        $meses = [];
        $mapVentas = [];
        $mapCompras = [];

        foreach ($ventas as $v) {
            $mapVentas[$v["mes"]] = $v["total"];
            if (!in_array($v["mes"], $meses)) $meses[] = $v["mes"];
        }

        foreach ($compras as $c) {
            $mapCompras[$c["mes"]] = $c["total"];
            if (!in_array($c["mes"], $meses)) $meses[] = $c["mes"];
        }

        sort($meses);

        $arrayVentas = [];
        $arrayCompras = [];

        foreach ($meses as $m) {
            $arrayVentas[] = $mapVentas[$m] ?? 0;
            $arrayCompras[] = $mapCompras[$m] ?? 0;
        }

        return [
            "meses" => $meses,
            "ventas" => $arrayVentas,
            "compras" => $arrayCompras
        ];
    }
}
