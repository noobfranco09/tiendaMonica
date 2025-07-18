<!-- navbar.php -->
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="<?php echo BASE_URL.'controller/dashBoard.php' ?>">Inicio</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuPrincipal" aria-controls="menuPrincipal" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="menuPrincipal">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo BASE_URL.'controller/productos/crearProducto.php' ?>">Crear producto</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo BASE_URL.'controller/provedores/dashBoardProvedores.php' ?>">Provedores</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../controller/logout.php">Cerrar sesión</a>
                </li>
            </ul>
        </div>
    </div>
</nav>