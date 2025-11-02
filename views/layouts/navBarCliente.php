<?php require $_SERVER['DOCUMENT_ROOT'] . '/tiendaMonica/rutas/rutaGlobal.php' ?>
<aside class="sidebar">


    <div class="sidebar-header">
        <h2><i class="fas fa-palette"></i> Tienda</h2>
    </div>
    <nav class="sidebar-nav">
        <a href="<?php echo BASE_URL . 'controller/dashBoard.php' ?>"><i class="fas fa-home"></i>Inicio</a>
        <a href="<?php echo BASE_URL . 'controller/provedores/dashBoardProvedores.php' ?>"><i class="fas fa-truck"></i>
            Proveedores</a>
        <a href="<?php echo BASE_URL . 'controller/categorias/dashBoardCategorias.php' ?>"><i class="fas fa-tags"></i>
            Categoría Proveedor</a>
        <a href="<?php echo BASE_URL . 'controller/insumos/dashBoardInsumos.php' ?>"><i class="fa-solid fa-wrench"></i>
            Insumos</a>
        <a href="<?php echo BASE_URL . 'controller/tipoProductos/dashBoardTipoProductos.php' ?>"><i class="fa-solid fa-tag"></i>
            Categoría Producto</a>

        <a href="<?php echo BASE_URL . 'controller/usuario/cerrarSesion.php' ?>"><i class="fas fa-sign-out-alt"></i>
            Cerrar sesión</a>

    </nav>
</aside>