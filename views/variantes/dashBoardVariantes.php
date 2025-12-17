<?php require $_SERVER['DOCUMENT_ROOT'] . '/tiendaMonica/rutas/rutaGlobal.php' ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once BASE_PATH . 'views/layouts/head.php' ?>
</head>

<body>
    <div class="layout">
        <?php require BASE_PATH . 'views/layouts/navbar.php' ?>
        <main class="main-content">
            <?php require BASE_PATH . 'views/layouts/header.php' ?>

            <!-- estos son botones que contienen botones -->
            <div class="content-box">
                <div class="d-flex flex-wrap align-items-center gap-2 mb-3">
                    <!-- Variantes -->
                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownVariante"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-plus"></i> Variantes
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownVariante">
                            <li>
                                <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                    data-bs-target="#modalCrearVariante">
                                    <i class="fas fa-plus me-1"></i> Crear Variante
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!-- Colores -->
                    <div class="dropdown">
                        <button class="btn btn-success dropdown-toggle" type="button" id="dropdownColor"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-palette me-1"></i> Colores
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownColor">
                            <li>
                                <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                    data-bs-target="#modalCrearColor">
                                    <i class="fas fa-plus me-1"></i> Crear Color
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!-- Tallas -->
                    <div class="dropdown">
                        <button class="btn btn-warning text-white dropdown-toggle" type="button" id="dropdownTalla"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ruler-combined me-1"></i> Tallas
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownTalla">
                            <li>
                                <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                    data-bs-target="#modalCrearTalla">
                                    <i class="fas fa-plus me-1"></i> Crear Talla
                                </a>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>



            <div class="content-wrapper">
                <div class="container mt-4">

                    <div class="table-responsive">
                        <table id="tablaVariantes" class="table table-striped table-bordered text-center align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre Variante</th>
                                    <th>Talla</th>
                                    <th>Color</th>
                                    <th>Precio</th>
                                    <th>Stock</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach ($variantes as $variante): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($variante['idVariante']); ?></td>

                                        <!-- Nombre Variante -->
                                        <td><?php echo htmlspecialchars($variante['nombre_variante']); ?></td>

                                        <!-- Talla -->
                                        <td><?php echo htmlspecialchars($variante['talla'] ?? '—'); ?></td>

                                        <!-- Color -->
                                        <td><?php echo htmlspecialchars($variante['color'] ?? '—'); ?></td>

                                        <!-- Precio -->
                                        <td>
                                            <?php if (!empty($variante['precio'])): ?>
                                                $<?php echo number_format($variante['precio'], 2); ?>
                                            <?php else: ?>
                                                <span class="text-muted">No definido</span>
                                            <?php endif; ?>
                                        </td>

                                        <!-- Stock -->
                                        <td><?php echo htmlspecialchars($variante['stock'] ?? '—'); ?></td>

                                        <!-- Estado -->
                                        <td>
                                            <span
                                                class="badge <?php echo $variante['estado'] ? 'bg-success' : 'bg-danger'; ?>">
                                                <?php echo $variante['estado'] ? 'Activo' : 'Inactivo'; ?>
                                            </span>
                                        </td>

                                        <!-- Acciones -->
                                        <td>
                                            <button class="btn btn-success btn-sm" title="Ver"><i
                                                    class="fas fa-eye"></i></button>
                                            <button class="btn btn-warning btn-sm" title="Editar"><i
                                                    class="fas fa-edit"></i></button>
                                            <button class="btn btn-danger btn-sm" title="Eliminar"><i
                                                    class="fas fa-trash-alt"></i></button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <?php require BASE_PATH . 'views/layouts/footer.php' ?>
    <?php require BASE_PATH . 'views/layouts/modals/variantes/modalCrearVariante.php' ?>
    <?php require BASE_PATH . 'views/layouts/modals/tallas/modalCrearTalla.php' ?>
    <?php require BASE_PATH . 'views/layouts/modals/colores/modalCrearColor.php' ?>


    <script src="<?php BASE_URL . 'assets/js/dataTable/variantes.js' ?>"></script>
</body>