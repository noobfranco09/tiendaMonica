<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/tiendaMonica/rutas/rutaGlobal.php';
require BASE_PATH . 'functions\helpers\session.php';

if (!isset($_SESSION['pedido_pendiente'])) {
    $_SESSION['tipoMensaje'] = 'error';
    $_SESSION['mensaje'] = 'No hay pagos pendientes';
    header('Location:' . BASE_URL . 'controller/usuario/dashBoardUsuario.php');
    exit();
}

$pedido = $_SESSION['pedido_pendiente'];
require_once BASE_PATH . 'views/wompi/pagarPedido.php';


