<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm px-4 py-2 sticky-top">
  <div class="container-fluid">
    <!-- Logo / Nombre -->
    <a class="navbar-brand d-flex align-items-center" href="#">
      <img src="<?php echo BASE_URL; ?>assets/img/logo.png" alt="Logo" width="32" height="32" class="me-2">
      <span class="fw-bold text-dark">Tienda Artística</span>
    </a>

    <!-- Botón colapsable -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCliente" aria-controls="navbarCliente" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Enlaces -->
    <div class="collapse navbar-collapse justify-content-end" id="navbarCliente">
      <ul class="navbar-nav mb-2 mb-lg-0">
        <li class="nav-item mx-2">
          <a class="nav-link active fw-semibold text-dark" href="<?php echo BASE_URL; ?>views/cliente/inicio.php">Inicio</a>
        </li>
        <li class="nav-item mx-2">
          <a class="nav-link text-dark" href="<?php echo BASE_URL; ?>views/cliente/productos.php">Productos</a>
        </li>
        <li class="nav-item mx-2">
          <a class="nav-link text-dark" href="<?php echo BASE_URL; ?>views/cliente/categorias.php">Categorías</a>
        </li>
        <li class="nav-item mx-2">
          <a class="nav-link text-dark" href="<?php echo BASE_URL; ?>views/cliente/contacto.php">Contacto</a>
        </li>
        <li class="nav-item mx-2">
          <a class="btn btn-dark rounded-pill px-3 py-1" href="<?php echo BASE_URL; ?>views/login.php">Iniciar sesión</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
