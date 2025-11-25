<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/tiendaMonica/rutas/rutaGlobal.php';
require BASE_PATH . 'functions/dieAndDumb/depurar.php'; 
?>

<!-- Offcanvas carrito -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasCarrito" aria-labelledby="offcanvasCarritoLabel">
  <div class="offcanvas-header bg-primary text-white">
    <h5 class="offcanvas-title fw-bold" id="offcanvasCarritoLabel">
      <i class="fa-solid fa-cart-shopping me-2"></i> Tu carrito
    </h5>
    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Cerrar"></button>
  </div>

  <div class="offcanvas-body d-flex flex-column">
    <?php
    // dd($_SESSION['carrito']);
    $carrito = $_SESSION['carrito'] ?? [];
    if (empty($carrito)): ?>
      <div class="text-center text-muted mt-5">
        <i class="fa-solid fa-cart-arrow-down fa-3x mb-3"></i>
        <p class="fw-semibold">Tu carrito está vacío</p>
      </div>
    <?php else:
      $total = 0;
      ?>
      <div class="list-group overflow-auto mb-3" style="max-height: 60vh;">
        <?php foreach ($carrito as $item):
          $total += $item['subtotal'];
          ?>
          <div class="list-group-item d-flex justify-content-between align-items-start">
            <div>
              <h6 class="fw-bold mb-1"><?php echo htmlspecialchars($item['nombreProducto']); ?></h6>
              <small class="text-muted d-block">
                Color: <?php echo htmlspecialchars($item['color']); ?> |
                Talla: <?php echo htmlspecialchars($item['talla']); ?> |
                Cantidad: <?php echo (int) $item['cantidad']; ?>
              </small>
              <small class="text-dark fw-semibold">Precio:
                $<?php echo number_format($item['precio'], 0, ',', '.'); ?></small>
            </div>
            <div class="text-end">
              <form method="POST" action="<?php echo BASE_URL . 'controller/usuario/eliminarDelCarrito.php'; ?>">
                <input type="hidden" name="idVariante" value="<?php echo $item['idVariante']; ?>">
                <button type="submit" class="btn btn-sm btn-outline-danger">
                  <i class="fa-solid fa-trash"></i>
                </button>
              </form>
            </div>
          </div>
        <?php endforeach; ?>
      </div>

      <div class="border-top pt-3">
        <p class="fw-bold fs-5 text-end mb-3">
          Total: $<?php echo number_format($total, 0, ',', '.'); ?>
        </p>

        <a class="btn btn-success w-100" data-bs-dismiss="modal" data-bs-toggle="modal"
          data-bs-target="#modalDatosUsuario">
          <i class="fa-solid fa-credit-card me-2"></i> Confirmar pedido
        </a>
      </div>
    <?php endif; ?>
  </div>
</div>