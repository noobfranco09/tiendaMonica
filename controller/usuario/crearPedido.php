<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/tiendaMonica/rutas/rutaGlobal.php';
require BASE_PATH . 'functions/dieAndDumb/depurar.php';
require BASE_PATH . 'models/mySql.php';

session_start();
// Solo permitir acceso a usuarios o clientes autenticados
if (!isset($_SESSION['usuario']) && !isset($_SESSION['cliente'])) {
    header('Location:' . BASE_URL . 'views/noAutorizado.php');
    exit();
}

// Si no hay carrito, no se puede generar pedido
if (empty($_SESSION['carrito'])) {
    $_SESSION['tipoMensaje'] = "error";
    $_SESSION['mensaje'] = "No hay productos en el carrito para generar un pedido.";
    header('Location:' . BASE_URL . 'controller/usuario/dashBoardUsuario.php');
    exit();
}

$db = new Mysql();
// require BASE_PATH . 'views/layouts/error/error.php';

// Solo aceptar método POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // se formatea la fecha como lo dice la doc de php 8 porque me imagino que el hosting 
    // estará en otro server y por lo tanto dará errores entre la fecha del server y la fecha 
    // de donde se vea el pedido
    //además se le pasa el formato pa que no tenga complicaciones con mariadb en su cfampo dateTime
    date_default_timezone_set('America/Bogota');
    $fecha = new DateTime();
    $fechaFormateada = $fecha->format('Y-m-d H:i:s');

    $nombres = trim($_POST['nombres'] ?? '');
    $apellidos = trim($_POST['apellidos'] ?? '');
    $observaciones = trim($_POST['observaciones'] ?? '');
    $idUsuario = $_SESSION['usuario']['idUsuario'] ?? 2;
    $celular = $_POST['celular'];
        $celular = $_POST['celular'];



    if (empty($nombres) || empty($apellidos)) {
        $_SESSION['tipoMensaje'] = "error";
        $_SESSION['mensaje'] = "Debe ingresar nombre y apellido del cliente.";
        header('Location:' . BASE_URL . 'controller/usuario/dashBoardUsuario.php');
        exit();
    }

    // Calcular el total del pedido sumando subtotales del carrito
    $total = 0;
    foreach ($_SESSION['carrito'] as $item) {
        $total += $item['subtotal'];
    }

    // Iniciar transacción (por seguridad)
    $db->iniciarTransaccion();

    try {
        $queryPedido = "
INSERT INTO pedido (nombreCliente,
    apellidoCliente,
    fechaPedido,
    observaciones,
    total,
    estado,
    aceptado,
    idUsuario) VALUES (?, ?, NOW(), ?, ?, ?, ?, ?);";

        $idPedido = $db->insertarYObtenerId($queryPedido, "sssdiii", [
            $nombres,
            $apellidos,
            $observaciones,
            $total,
            1,  // estado
            0,            // aceptado (tinyint)
            $idUsuario
        ]);


        // Insertar las variantes en la tabla pivote
        $queryPivot = "
    INSERT INTO pedido_has_variantes (
        pedido_idPedido, 
        variantes_idVariante, 
        cantidad, 
        precioUnitario, 
        subtotal, 
        notas
    ) VALUES (?, ?, ?, ?, ?, ?);";

        foreach ($_SESSION['carrito'] as $item) {
            $db->consultaPreparada(
                $queryPivot,
                "iiidds",
                [
                    $idPedido,
                    $item['idVariante'],
                    $item['cantidad'],
                    $item['precio'],
                    $item['subtotal'],
                    $item['notas'] ?? ''
                ]
            );

            // Actualizar el stock de la variante
            $db->consultaPreparada(
                "UPDATE variantes SET stock = stock - ? WHERE idVariante = ?",
                "ii",
                [$item['cantidad'], $item['idVariante']]
            );
        }

        // Confirmar transacción
        $db->confirmarTransaccion();

        // Vaciar carrito
        unset($_SESSION['carrito']);

        $_SESSION['tipoMensaje'] = "exito";
        $_SESSION['mensaje'] = "Pedido generado correctamente.";
        header('Location:' . BASE_URL . 'controller/usuario/dashBoardUsuario.php');
        exit();

    } catch (Exception $e) {
        // Revertir si algo falla
        $db->revertirTransaccion();

        $_SESSION['tipoMensaje'] = "error";
        $_SESSION['mensaje'] = "Ocurrió un error al generar el pedido: " . $e->getMessage();
        header('Location:' . BASE_URL . 'controller/usuario/dashBoardUsuario.php');
        exit();
    }
}

// Si entran sin POST
header('Location:' . BASE_URL . 'views/noAutorizado.php');
exit();
?>