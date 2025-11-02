<div class="modal fade" id="modalCarrito" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content border-0 overflow-hidden shadow-lg">

      <div class="row g-0">
        <!-- COLUMNA IZQUIERDA (INFO PRODUCTO) -->
        <div class="col-md-4 bg-primary text-white d-flex flex-column justify-content-center p-4">
          <h5 class="fw-bold mb-3" id="modalProductoTitulo">Producto seleccionado</h5>
          <p class="fs-5 fw-semibold">
            $<span id="modalCarritoPrecio">0</span>
          </p>
          <p class="small opacity-75 mb-0">
            Revisa la cantidad, talla o notas antes de confirmar tu pedido.
          </p>
        </div>

        <!-- COLUMNA DERECHA (FORMULARIO) -->
        <div class="col-md-8 p-4">
          <form method="POST" action="<?php echo BASE_URL . 'controller/usuario/agregarAlCarrito.php'; ?>">
            <input type="hidden" name="id" id="modalProductoId">

            <div class="mb-3">
              <label for="cantidad" class="form-label fw-semibold">Cantidad</label>
              <input type="number" class="form-control" id="cantidad" name="cantidad" value="1" min="1">
            </div>

            <div class="mb-3">
              <label for="talla" class="form-label fw-semibold">Talla</label>
              <input type="text" class="form-control" id="talla" name="talla" placeholder="Ej. M, L, 38, 40">
            </div>

            <div class="mb-3">
              <label for="notas" class="form-label fw-semibold">Notas adicionales</label>
              <textarea class="form-control" id="notas" name="notas" rows="3"
                placeholder="Instrucciones o detalles especiales"></textarea>
            </div>

            <div class="d-grid gap-2">
              <button type="submit" class="btn btn-success btn-lg">
                <i class="fa-solid fa-check me-2"></i> Confirmar pedido
              </button>
              <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                <i class="fa-solid fa-xmark me-1"></i> Cancelar
              </button>
            </div>
          </form>
        </div>
      </div>

    </div>
  </div>
</div>
