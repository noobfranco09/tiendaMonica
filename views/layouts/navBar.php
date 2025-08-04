<!-- navbar.php -->
 <?php require $_SERVER['DOCUMENT_ROOT'].'/tiendaMonica/rutas/rutaGlobal.php' ?>
<nav class="sidebar">
    <a href="<?php echo BASE_URL . 'controller/productos/dashBoard.php' ?>">Inicio</a>
    <a href="<?php echo BASE_URL . 'controller/productos/crearProducto.php' ?>">Crear producto</a>
    <a href="<?php echo BASE_URL . 'controller/provedores/dashBoardProvedores.php' ?>">Proveedores</a>
    <a href="<?php echo BASE_URL . 'controller/categorias/dashBoardCategorias.php' ?>">Categorías</a>
    <a href="<?php echo BASE_URL . 'controller/logout.php' ?>">Cerrar sesión</a>
</nav>
