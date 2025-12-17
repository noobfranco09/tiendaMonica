<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/tiendaMonica/rutas/rutaGlobal.php';
require BASE_PATH . 'models/mySql.php';

// Leer payload
$payload = json_decode(file_get_contents('php://input'), true);

if (!$payload) {
    http_response_code(400);
    exit;
}

$evento = $payload['event'] ?? null;

if ($evento !== 'transaction.updated') {
    http_response_code(200);
    exit;
}

$transaccion = $payload['data']['transaction'];

$estado = $transaccion['status']; // APPROVED, DECLINED, VOIDED
$referencia = $transaccion['reference'];

if (!$referencia) {
    http_response_code(400);
    exit;
}

$db = new Mysql();

try {
    $db->iniciarTransaccion();

    // Buscar pedido
    $pedido = $db->consultaPreparada(
        "SELECT idPedido, total FROM pedido WHERE referencia = ?",
        "s",
        [$referencia]
    );

    if (empty($pedido)) {
        throw new Exception("Pedido no encontrado");
    }

    $idPedido = $pedido[0]['idPedido'];
    $totalPedido = $pedido[0]['total'];

    //  Verificar si ya existe venta
    $ventaExiste = $db->consultaPreparada(
        "SELECT idVenta FROM ventas WHERE pedido_idPedido = ?",
        "i",
        [$idPedido]
    );

    if (!empty($ventaExiste)) {
        // Ya procesado
        $db->confirmarTransaccion();
        http_response_code(200);
        exit;
    }

    if ($estado === 'APPROVED') {

        // 🧾 Crear venta
        $db->consultaPreparada(
            "INSERT INTO ventas (
                fecha,
                total,
                estadoPago,
                estadoVenta,
                pedido_idPedido
            ) VALUES (NOW(), ?, ?, ?, ?)",
            "diii",
            [
                $totalPedido,
                1, // estadoPago APROBADO
                1, // estadoVenta ACTIVA
                $idPedido
            ]
        );

        // 📦 Actualizar pedido
        $db->consultaPreparada(
            "UPDATE pedido 
             SET estado = ?, aceptado = ? 
             WHERE idPedido = ?",
            "iii",
            [1, 1, $idPedido]
        );

    } else {

        // ❌ Pago rechazado
        $db->consultaPreparada(
            "UPDATE pedido 
             SET estado = ? 
             WHERE idPedido = ?",
            "ii",
            [2, $idPedido] // RECHAZADO
        );
    }

    $db->confirmarTransaccion();
    http_response_code(200);

} catch (Exception $e) {
    $db->revertirTransaccion();
    http_response_code(500);
}
