<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/tiendaMonica/rutas/rutaGlobal.php';
require BASE_PATH . '/models/mySql.php';
require BASE_PATH . 'functions\helpers\session.php';

if (!isset($_SESSION['usuario'])) {
    header('Location:' . BASE_URL . 'views/login.php');
    exit();
}

$db = new Mysql();

// Solo procesar si viene por POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validar campos obligatorios
    $camposRequeridos = ['nombre', 'stock', 'precio', 'estado', 'tallas_idTalla', 'colores_idColor', 'productos_idProducto'];
    foreach ($camposRequeridos as $campo) {
        if (empty($_POST[$campo])) {
            $_SESSION['tipoMensaje'] = "error";
            $_SESSION['mensaje'] = "Por favor, complete todos los campos requeridos.";
            header('Location:' . BASE_URL . 'controller\variantes\dashBoardVariantes.php');
            exit();
        }
    }

    // Sanitizar datos
    $nombre = trim($_POST['nombre'] ?? '');
    $stock = intval($_POST['stock'] ?? 0);
    $precio = floatval($_POST['precio'] ?? 0);
    $estado = intval($_POST['estado'] ?? 0);
    $talla = intval($_POST['tallas_idTalla'] ?? 0);
    $color = intval($_POST['colores_idColor'] ?? 0);
    $producto = intval($_POST['productos_idProducto'] ?? 0);

    // Nombre
    if ($nombre === '' || !preg_match('/^[\p{L}0-9\s\-\.,]+$/u', $nombre)) {
        $_SESSION['tipoMensaje'] = 'error';
        $_SESSION['mensaje'] = 'El nombre contiene caracteres no permitidos.';
        header('Location:' . BASE_URL . 'controller\variantes\dashBoardVariantes.php');
        exit();
    }

    // Stock
    if ($stock < 0) {
        $_SESSION['tipoMensaje'] = 'error';
        $_SESSION['mensaje'] = 'El stock no puede ser negativo.';
        header('Location:' . BASE_URL . 'controller\variantes\dashBoardVariantes.php');
        exit();
    }

    // Precio
    if ($precio <= 0) {
        $_SESSION['tipoMensaje'] = 'error';
        $_SESSION['mensaje'] = 'El precio debe ser mayor a 0.';
        header('Location:' . BASE_URL . 'controller\variantes\dashBoardVariantes.php');
        exit();
    }

    // Estado (ej: 1 activo / 0 inactivo)
    if (!in_array($estado, [0, 1], true)) {
        $_SESSION['tipoMensaje'] = 'error';
        $_SESSION['mensaje'] = 'Estado inválido.';
        header('Location:' . BASE_URL . 'controller\variantes\dashBoardVariantes.php');
        exit();
    }

    // Talla
    if ($talla <= 0) {
        $_SESSION['tipoMensaje'] = 'error';
        $_SESSION['mensaje'] = 'Talla inválida.';
        header('Location:' . BASE_URL . 'controller\variantes\dashBoardVariantes.php');
        exit();
    }

    // Color
    if ($color <= 0) {
        $_SESSION['tipoMensaje'] = 'error';
        $_SESSION['mensaje'] = 'Color inválido.';
        header('Location:' . BASE_URL . 'controller\variantes\dashBoardVariantes.php');
        exit();
    }

    // Producto
    if ($producto <= 0) {
        $_SESSION['tipoMensaje'] = 'error';
        $_SESSION['mensaje'] = 'Producto inválido.';
        header('Location:' . BASE_URL . 'controller\variantes\dashBoardVariantes.php');
        exit();
    }


    // Validar y subir imagen
    $rutaDestino = BASE_PATH . 'images/uploads/variantes/';
    if (!file_exists($rutaDestino)) {
        mkdir($rutaDestino, 0777, true);
    }

    $imagen = null;
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $nombreArchivo = time() . '_' . basename($_FILES['imagen']['name']);
        $rutaArchivo = $rutaDestino . $nombreArchivo;

        $tipoArchivo = strtolower(pathinfo($rutaArchivo, PATHINFO_EXTENSION));
        $tiposPermitidos = ['jpg', 'jpeg', 'png', 'webp'];

        if (in_array($tipoArchivo, $tiposPermitidos)) {
            if (move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaArchivo)) {
                $imagen = 'images/uploads/variantes/' . $nombreArchivo;
            } else {
                $_SESSION['tipoMensaje'] = "error.";
                $_SESSION['mensaje'] = "error al subir la imagen.";
                header('Location:' . BASE_URL . 'controller\variantes\dashBoardVariantes.php');
                exit();
            }
        } else {
            $_SESSION['tipoMensaje'] = "error";
            $_SESSION['mensaje'] = "Formato de imagen no permitido.";
            header('Location:' . BASE_URL . 'controller\variantes\dashBoardVariantes.php');
            exit();
        }
    } else {
        $_SESSION['tipoMensaje'] = "error";
        $_SESSION['mensaje'] = "Debe seleccionar una imagen.";
        header('Location:' . BASE_URL . 'controller\variantes\dashBoardVariantes.php');
        exit();
    }

    // Insertar en base de datos
    $query = "INSERT INTO variantes 
(nombre, precio, estado, idProducto, tallas_idTalla, stock, imagen, colores_idColor)
VALUES (?, ?, ?, ?, ?, ?, ?, ?)
";
    $tipos = "sdiisiis";
    $datos = [$nombre, $precio, $estado, $producto, $talla, $stock, $imagen, $color];


    $resultado = $db->consultaPreparada($query, $tipos, $datos);

    if ($resultado) {
        $_SESSION['tipoMensaje'] = "exitp";
        $_SESSION['mensaje'] = "Variante creada con éxito.";

        header('Location:' . BASE_URL . 'controller\variantes\dashBoardVariantes.php');
        exit();
    } else {
        $_SESSION['tipoMensaje'] = "error";
        $_SESSION['mensaje'] = "tipoMensaje al crear la variante. Inténtelo de nuevo.";
        header('Location:' . BASE_URL . 'controller\variantes\dashBoardVariantes.php');
        exit();
    }
} else {
    header('Location:' . BASE_URL . 'views\noAutorizado.php');
    exit();

}


?>