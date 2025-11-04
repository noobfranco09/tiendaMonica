<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/tiendaMonica/rutas/rutaGlobal.php';
require BASE_PATH . 'functions/dieAndDumb/depurar.php';
require BASE_PATH . '/models/mySql.php';

session_start();

// Permitir acceso a usuarios o clientes
if (!isset($_SESSION['usuario']) && !isset($_SESSION['cliente'])) {
    header('Location:' . BASE_URL . 'views/noAutorizado.php');
    exit();
}

$db = new Mysql();
require BASE_PATH . 'views/layouts/error/error.php';

// Verificamos que sea POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($_POST['id']) || empty($_POST['cantidad']) || empty($_POST['talla'])) {
        $_SESSION['tipoMensaje'] = "error";
        $_SESSION['mensaje'] = "Por favor, llene todos los campos.";
        header('Location:' . BASE_URL . 'controller/usuario/dashBoardUsuario.php');
        exit();
    }
    $id = (int) $_POST['id'];
    $cantidad = (int) $_POST['cantidad'];
    $talla = trim($_POST['talla']);
    $notas = isset($_POST['notas']) ? trim($_POST['notas']) : '';

    // Buscar producto en la base de datos
    $producto = $db->consultaPreparada(
        "SELECT idProducto, nombre, precio, stock FROM productos WHERE idProducto = ?",
        "i",
        [$id]
    );

    if (empty($producto)) {
        $_SESSION['tipoMensaje'] = "error";
        $_SESSION['mensaje'] = "El producto no existe.";
        header('Location:' . BASE_URL . 'controller/usuario/dashBoardUsuario.php');
        exit();
    }

    $producto = $producto[0];
    $stock = (int) $producto['stock'];

    // Validar stock
    if ($cantidad > $stock) {
        $_SESSION['tipoMensaje'] = "error";
        $_SESSION['mensaje'] = "La cantidad solicitada supera el stock disponible.";
        header('Location:' . BASE_URL . 'controller/usuario/dashBoardUsuario.php');
        exit();
    }

    // Iniciar carrito si no existe
    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = [];
    }

    // Calcular subtotal del producto
    $subtotal = $cantidad * (float) $producto['precio'];

    // Verificar si ya existe el producto con la misma talla
    $producto_encontrado = false;
    foreach ($_SESSION['carrito'] as &$item) {
        if ($item['id'] === $producto['idProducto'] && $item['talla'] === $talla) {
            $item['cantidad'] += $cantidad;
            $item['subtotal'] = $item['cantidad'] * $item['precio']; // recalcular subtotal
            $producto_encontrado = true;
            break;
        }
    }
    unset($item); // romper la referencia

    // Si no existe, agregar nuevo
    if (!$producto_encontrado) {
        $_SESSION['carrito'][] = [
            'id' => $producto['idProducto'],
            'nombre' => $producto['nombre'],
            'precio' => (float) $producto['precio'],
            'cantidad' => $cantidad,
            'talla' => $talla,
            'notas' => $notas,
            'subtotal' => $subtotal
        ];
    }
    $_SESSION['tipoMensaje'] = "exito";
    $_SESSION['mensaje'] = "Producto agregado al carrito correctamente.";
    header('Location:' . BASE_URL . 'controller/usuario/dashBoardUsuario.php');
    exit();
}

// Si alguien entra sin POST
header('Location:' . BASE_URL . 'views/noAutorizado.php');
exit();
?>