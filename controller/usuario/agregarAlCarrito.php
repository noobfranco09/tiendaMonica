<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/tiendaMonica/rutas/rutaGlobal.php';
require BASE_PATH . 'functions/dieAndDumb/depurar.php';
require BASE_PATH . '/models/mySql.php';
require BASE_PATH . 'functions\helpers\session.php';


// Permitir acceso a usuarios o clientes
if (!isset($_SESSION['usuario']) && !isset($_SESSION['cliente'])) {
    header('Location:' . BASE_URL . 'views/noAutorizado.php');
    exit();
}

$db = new Mysql();
require BASE_PATH . 'views/layouts/error/error.php';

// Solo aceptar POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($_POST['idVariante']) || empty($_POST['cantidad'])) {
        $_SESSION['tipoMensaje'] = "error";
        $_SESSION['mensaje'] = "Por favor, llene todos los campos.";
        header('Location:' . BASE_URL . 'controller/usuario/dashBoardUsuario.php');
        exit();
    }

    $idVariante = (int) $_POST['idVariante'];
    $cantidad = (int) $_POST['cantidad'];
    $notas = isset($_POST['notas']) ? trim($_POST['notas']) : '';

    // Buscar variante en la base de datos
    $consulta = "
        SELECT 
            v.idVariante,
            v.nombre AS nombreVariante,
            v.precio,
            v.stock,
            v.imagen,
            p.nombre AS nombreProducto,
            t.nombre AS talla,
            c.nombre AS color
        FROM variantes v
        INNER JOIN productos p ON v.idProducto = p.idProducto
        INNER JOIN tallas t ON v.tallas_idTalla = t.idTalla
        INNER JOIN colores c ON v.colores_idColor = c.idColor
        WHERE v.idVariante = ? AND v.estado = 1 AND p.estado = 1
    ";

    $variante = $db->consultaPreparada($consulta, "i", [$idVariante]);

    if (empty($variante)) {
        $_SESSION['tipoMensaje'] = "error";
        $_SESSION['mensaje'] = "El producto seleccionada no existe o está inactiva.";
        header('Location:' . BASE_URL . 'controller/usuario/dashBoardUsuario.php');
        exit();
    }

    $variante = $variante[0];

    // Validar stock
    if ($cantidad > (int) $variante['stock']) {
        $_SESSION['tipoMensaje'] = "error";
        $_SESSION['mensaje'] = "La cantidad solicitada supera el stock disponible.";
        header('Location:' . BASE_URL . 'controller/usuario/dashBoardUsuario.php');
        exit();
    }

    // Iniciar carrito si no existe
    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = [];
    }

    $subtotal = $cantidad * (float) $variante['precio'];

    // pa verificar que no pueda agregar productos de más cuando se agrega de uno en uno o varios desde la modal
    // ejemplo,el usuario primero agrega 6 productos y el stock es de 10, si luego vuelve a agregar 6, superaría 
    // el stock y es entonces cuando esta validación cobra vida
    if ($item['cantidad'] + $cantidad > $variante['stock']) {
        $_SESSION['tipoMensaje'] = "error";
        $_SESSION['mensaje'] = "La cantidad total supera el stock disponible.";
        header('Location:' . BASE_URL . 'controller/usuario/dashBoardUsuario.php');
        exit();
    }

    // Verificar si ya existe esa variante en el carrito
    $encontrada = false;
    foreach ($_SESSION['carrito'] as &$item) {
        if ($item['idVariante'] === $variante['idVariante']) {
            $item['cantidad'] += $cantidad;
            $item['subtotal'] = $item['cantidad'] * $item['precio'];
            $encontrada = true;
            break;
        }
    }
    unset($item); // romper la referencia

    // Si no está, agregar nuevo ítem
    if (!$encontrada) {
        $_SESSION['carrito'][] = [
            'idVariante' => $variante['idVariante'],
            'nombreProducto' => $variante['nombreProducto'],
            'nombreVariante' => $variante['nombreVariante'],
            'precio' => (float) $variante['precio'],
            'cantidad' => $cantidad,
            'talla' => $variante['talla'],
            'color' => $variante['color'],
            'imagen' => $variante['imagen'],
            'subtotal' => $subtotal,
            'notas' => $notas,
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