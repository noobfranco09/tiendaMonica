<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/tiendaMonica/rutas/rutaGlobal.php';
require BASE_PATH . '/models/mySql.php';

require BASE_PATH . 'functions\helpers\session.php';
if (!isset($_SESSION['usuario'])) {
    header('Location:' . BASE_URL . 'views/login.php');
    exit();
}
$db = new Mysql();
require BASE_PATH . 'views/layouts/error/error.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (
        !isset($_POST['nombreProducto']) || !isset($_POST['descripcionProducto'])
        || !isset($_POST['idTipoProducto'])
    ) {
        $_SESSION['tipoMensaje'] = 'error';
        $_SESSION['mensaje'] = "Por favor, llene todos los campos";
        header('Location:' . BASE_URL . 'controller\dashBoard.php');
        exit();
    }

    $estado = 1;
    $idTipoProducto = $_POST['idTipoProducto'];
    $nombre = trim($_POST['nombreProducto']);
    $descripcion = trim($_POST['descripcionProducto']);

    if ($nombre === '') {
        $_SESSION['tipoMensaje'] = 'error';
        $_SESSION['mensaje'] = 'El nombre es obligatorio.';
        header('Location:' . BASE_URL . 'controller\dashBoard.php');
        exit();
    }

    if (!preg_match('/^[\p{L}0-9\s\-_,.()]+$/u', $nombre)) {
        $_SESSION['tipoMensaje'] = 'error';
        $_SESSION['mensaje'] = 'El nombre contiene caracteres no permitidos.';
        header('Location:' . BASE_URL . 'controller\dashBoard.php');
        exit();
    }

    if ($descripcion !== '' && !preg_match('/^[\p{L}0-9\s\-_,.()]+$/u', $descripcion)) {
        $_SESSION['tipoMensaje'] = 'error';
        $_SESSION['mensaje'] = 'La descripción contiene caracteres no permitidos.';
        header('Location:' . BASE_URL . 'controller\dashBoard.php');
        exit();
    }

    // MANEJO DE IMAGEN - SIEMPRE será un STRING
    $imagenRuta = '';  // String vacío por defecto
    
    // Verificar si se subió una imagen
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $extensionesPermitidas = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        $nombreArchivo = $_FILES['imagen']['name'];
        $tmpName = $_FILES['imagen']['tmp_name'];
        $tamañoArchivo = $_FILES['imagen']['size'];
        
        $extension = strtolower(pathinfo($nombreArchivo, PATHINFO_EXTENSION));
        if (!in_array($extension, $extensionesPermitidas)) {
            $_SESSION['tipoMensaje'] = 'error';
            $_SESSION['mensaje'] = 'Formato de imagen no permitido. Use: jpg, jpeg, png, gif, webp';
            header('Location:' . BASE_URL . 'controller\dashBoard.php');
            exit();
        }
        
        if ($tamañoArchivo > 5242880) {
            $_SESSION['tipoMensaje'] = 'error';
            $_SESSION['mensaje'] = 'La imagen no debe superar los 5MB';
            header('Location:' . BASE_URL . 'controller\dashBoard.php');
            exit();
        }
        
        $checkImage = getimagesize($tmpName);
        if ($checkImage === false) {
            $_SESSION['tipoMensaje'] = 'error';
            $_SESSION['mensaje'] = 'El archivo no es una imagen válida';
            header('Location:' . BASE_URL . 'controller\dashBoard.php');
            exit();
        }
        
        // Crear directorio si no existe
        $directorioDestino = $_SERVER['DOCUMENT_ROOT'] . '/tiendaMonica/images/productos';
        if (!file_exists($directorioDestino)) {
            if (!mkdir($directorioDestino, 0755, true)) {
                $_SESSION['tipoMensaje'] = 'error';
                $_SESSION['mensaje'] = 'Error al crear el directorio de imágenes';
                header('Location:' . BASE_URL . 'controller\dashBoard.php');
                exit();
            }
        }
        
        // Generar nombre único
        $nombreUnico = uniqid('prod_', true) . '.' . $extension;
        $rutaCompleta = $directorioDestino . '/' . $nombreUnico;
        
        // Mover archivo
        if (move_uploaded_file($tmpName, $rutaCompleta)) {
            // Guardar SOLO la ruta relativa como STRING
            $imagenRuta = 'images/productos/' . $nombreUnico;
        } else {
            $_SESSION['tipoMensaje'] = 'error';
            $_SESSION['mensaje'] = 'Error al guardar la imagen. Verifique los permisos del directorio.';
            header('Location:' . BASE_URL . 'controller\dashBoard.php');
            exit();
        }
    }

    // INSERTAR - SIEMPRE insertamos un string en el campo imagen (vacío o con ruta)
    $query = "INSERT INTO productos (nombre, descripcion, estado, idTipoProducto, imagen)
              VALUES (?, ?, ?, ?, ?)";
    $tipos = "ssiis";  // string, string, int, int, string
    $datos = [
        $nombre, 
        $descripcion, 
        $estado, 
        $idTipoProducto, 
        $imagenRuta  // SIEMPRE es un string ('' o 'images/productos/xxx.jpg')
    ];
    
    $resultado = $db->consultaPreparada($query, $tipos, $datos);

    if ($resultado) {
        $_SESSION['tipoMensaje'] = 'exito';
        $_SESSION['mensaje'] = "Producto agregado con éxito";
        header('Location:' . BASE_URL . 'controller/dashBoard.php');
        exit();
    } else {
        // Si falla el insert y había imagen, eliminarla
        if ($imagenRuta !== '') {
            $archivoEliminar = $_SERVER['DOCUMENT_ROOT'] . '/tiendaMonica/' . $imagenRuta;
            if (file_exists($archivoEliminar)) {
                unlink($archivoEliminar);
            }
        }
        $_SESSION['tipoMensaje'] = 'error';
        $_SESSION['mensaje'] = "Error al guardar el producto en la base de datos";
        header('Location:' . BASE_URL . 'controller\dashBoard.php');
        exit();
    }
}

require BASE_PATH . 'controller/dashBoard.php';

?>