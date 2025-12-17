<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/tiendaMonica/rutas/rutaGlobal.php';
require_once BASE_PATH . 'functions/dieAndDumb/depurar.php';
require BASE_PATH . 'models/mySql.php';
require BASE_PATH . 'functions\helpers\session.php';
// Seguridad
if (!isset($_SESSION['usuario']) && !isset($_SESSION['cliente'])) {
    header('Location:' . BASE_URL . 'views/noAutorizado.php');
    exit();
}
// dd($_SESSION['idUsuario']);


if (empty($_SESSION['carrito'])) {
    $_SESSION['tipoMensaje'] = "error";
    $_SESSION['mensaje'] = "No hay productos en el carrito.";
    header('Location:' . BASE_URL . 'controller/usuario/dashBoardUsuario.php');
    exit();
}

$db = new Mysql();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    date_default_timezone_set('America/Bogota');
    $fecha = date('Y-m-d H:i:s');

    $nombres = trim($_POST['nombres'] ?? '');
    $apellidos = trim($_POST['apellidos'] ?? '');
    $direccion = trim($_POST['direccion'] ?? '');
    $observaciones = trim($_POST['observaciones'] ?? '');
    $celular = trim($_POST['celular'] ?? '');

    // Nombres
    if ($nombres === '' || !preg_match('/^[\p{L}\s]+$/u', $nombres)) {
        $_SESSION['tipoMensaje'] = 'error';
        $_SESSION['mensaje'] = 'El nombre contiene caracteres no permitidos.';
        header('Location:' . BASE_URL . 'controller/usuario/dashBoardUsuario.php');
        exit();
    }

    // Apellidos
    if ($apellidos === '' || !preg_match('/^[\p{L}\s]+$/u', $apellidos)) {
        $_SESSION['tipoMensaje'] = 'error';
        $_SESSION['mensaje'] = 'El apellido contiene caracteres no permitidos.';
        header('Location:' . BASE_URL . 'controller/usuario/dashBoardUsuario.php');
        exit();
    }

    // Dirección
    if ($direccion === '' || !preg_match('/^[\p{L}0-9\s\#\-\.,]+$/u', $direccion)) {
        $_SESSION['tipoMensaje'] = 'error';
        $_SESSION['mensaje'] = 'La dirección contiene caracteres no permitidos.';
        header('Location:' . BASE_URL . 'controller/usuario/dashBoardUsuario.php');
        exit();
    }

    // Observaciones (opcional)
    if ($observaciones !== '' && !preg_match('/^[\p{L}0-9\s\-\.,()]+$/u', $observaciones)) {
        $_SESSION['tipoMensaje'] = 'error';
        $_SESSION['mensaje'] = 'Las observaciones contienen caracteres no permitidos.';
        header('Location:' . BASE_URL . 'controller/usuario/dashBoardUsuario.php');
        exit();
    }

    // Celular
    if (!preg_match('/^\+?[0-9\s]{7,15}$/', $celular)) {
        $_SESSION['tipoMensaje'] = 'error';
        $_SESSION['mensaje'] = 'El número de celular no es válido.';
        header('Location:' . BASE_URL . 'controller/usuario/dashBoardUsuario.php');
        exit();
    }

    $idUsuario = $_SESSION['idUsuario'] ?? 2;
    if (empty($nombres) || empty($apellidos) || empty($direccion)) {
        $_SESSION['tipoMensaje'] = "error";
        $_SESSION['mensaje'] = "Datos incompletos.";
        header('Location:' . BASE_URL . 'controller/usuario/dashBoardUsuario.php');
        exit();
    }

    // Total
    $total = 0;
    foreach ($_SESSION['carrito'] as $item) {
        $total += $item['subtotal'];
    }

    // REFERENCIA
    $referencia = 'PED-' . date('Ymd') . '-' . uniqid();

    $db->iniciarTransaccion();

    try {
        // Pedido (PENDIENTE_PAGO)
        $sqlPedido = "
            INSERT INTO pedido (
                referencia,
                nombreCliente,
                apellidoCliente,
                fechaPedido,
                direccion,
                observaciones,
                total,
                estado,
                aceptado,
                idUsuario
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ";

        $idPedido = $db->insertarYObtenerId(
            $sqlPedido,
            "ssssssdiii",
            [
                $referencia,
                $nombres,
                $apellidos,
                $fecha,
                $direccion,
                $observaciones,
                $total,
                0, // estado = PENDIENTE_PAGO
                0, // aceptado
                $idUsuario
            ]
        );

        // Detalle
        $sqlDetalle = "
            INSERT INTO pedido_has_variantes (
                pedido_idPedido,
                variantes_idVariante,
                nombreProducto,
                cantidad,
                precioUnitario,
                subtotal,
                observaciones,
                talla,
                color
            ) VALUES (?, ?, ?, ?, ?, ?,?,?,?)
        ";

        foreach ($_SESSION['carrito'] as $item) {
            $db->consultaPreparada(
                $sqlDetalle,
                "iisiddsss",
                [
                    $idPedido,
                    $item['idVariante'],
                    $item['nombreProducto'],
                    $item['cantidad'],
                    $item['precio'],
                    $item['subtotal'],
                    $item['notas'] ?? '',
                    $item['talla'],
                    $item['color'],

                ]
            );
        }

        $db->confirmarTransaccion();

        // Guardar referencia en sesión (opcional)
        $_SESSION['pedido_pendiente'] = [
            'idPedido' => $idPedido,
            'referencia' => $referencia,
            'total' => $total
        ];

        // aquí REDIRIGES a pagar
        header('Location:' . BASE_URL . 'controller/wompi/pagarPedido.php');
        exit();

    } catch (Exception $e) {
        // dd($e);
        $db->revertirTransaccion();
        $_SESSION['tipoMensaje'] = "error";
        $_SESSION['mensaje'] = "Error al crear pedido.";
        header('Location:' . BASE_URL . 'controller/usuario/dashBoardUsuario.php');
        exit();
    }
}

header('Location:' . BASE_URL . 'views/noAutorizado.php');
exit();
