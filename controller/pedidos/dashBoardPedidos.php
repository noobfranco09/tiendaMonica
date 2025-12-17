<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/tiendaMonica/rutas/rutaGlobal.php';
require BASE_PATH . 'functions/helpers/session.php';

if (!isset($_SESSION['usuario'])) {
    header('Location:' . BASE_URL . 'views/login.php');
    exit();
}

require_once BASE_PATH . 'models/mySql.php';
$db = new Mysql();

/* =========================
   1. PEDIDOS
========================= */
$sqlPedidos = "
    SELECT 
        p.idPedido,
        p.referencia,
        p.nombreCliente,
        p.apellidoCliente,
        p.fechaPedido,
        p.observaciones,
        p.total,
        p.estado,
        p.aceptado,
        p.idUsuario
    FROM pedido p
    ORDER BY p.fechaPedido DESC
";

$pedidosDB = $db->consultaPreparada($sqlPedidos);

/* =========================
   2. VARIANTES POR PEDIDO
========================= */
$sqlVariantes = "
    SELECT
        pv.pedido_idPedido,
        pv.variantes_idVariante AS idVariante,
        pv.nombreProducto AS producto,
        pv.talla,
        pv.color,
        pv.cantidad,
        pv.subTotal
    FROM pedido_has_variantes pv
";

$variantesDB = $db->consultaPreparada($sqlVariantes);

/* =========================
   3. ARMAR ESTRUCTURA
========================= */
$pedidos = [];

foreach ($pedidosDB as $p) {
    $p['variantes'] = [];
    $pedidos[$p['idPedido']] = $p;
}

foreach ($variantesDB as $v) {
    $idPedido = $v['pedido_idPedido'];
    if (isset($pedidos[$idPedido])) {
        $pedidos[$idPedido]['variantes'][] = [
            'idVariante' => $v['idVariante'],
            'producto'   => $v['producto'],
            'talla'      => $v['talla'],
            'color'      => $v['color'],
            'cantidad'   => $v['cantidad'],
            'subtotal'   => $v['subTotal']
        ];
    }
}

/* =========================
   4. PASAR A LA VISTA
========================= */
require BASE_PATH . 'views/pedidos/dashBoardPedidos.php';
