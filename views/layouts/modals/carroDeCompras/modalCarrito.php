<!-- esta es la modal que se usa para cuando el cliente esté seleccionando el producto -->
<!-- se llena los select desde los archivos de js que están en assets,es importante que el producto tenga
  variantes,de lo contrario el cliente no podrá seleccionarlo porque la petición se enviaría con datos vacíos
  y eso no se permite. -->

<div class="modal fade" id="modalCarrito" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content border-0 overflow-hidden shadow-lg">

      <div class="row g-0">
        <!-- LEFT -->
        <div class="col-md-4 bg-primary text-white d-flex flex-column justify-content-center p-4">
          <h5 class="fw-bold mb-3" id="modalProductoTitulo">Producto</h5>
          <p class="fs-5 fw-semibold">$<span id="modalCarritoPrecio">0</span></p>
          <p class="small opacity-75 mb-0">Selecciona color y talla.</p>
        </div>

        <!-- RIGHT -->
        <div class="col-md-8 p-4">

          <form method="POST" action="<?php echo BASE_URL.'controller/usuario/agregarAlCarrito.php'; ?>">

            <input type="hidden" id="idVariante" name="idVariante">

            <!-- COLORES -->
            <div class="mb-3">
              <label class="form-label fw-semibold">Color</label>
              <div id="contenedorColores" class="d-flex gap-2 flex-wrap"></div>
            </div>

            <!-- TALLAS -->
            <div class="mb-3">
              <label class="form-label fw-semibold">Talla</label>
              <div id="contenedorTallas" class="d-flex gap-2 flex-wrap"></div>
            </div>

            <!-- CANTIDAD -->
            <div class="mb-3">
              <label class="form-label fw-semibold">Cantidad</label>
              <input type="number" id="cantidad" name="cantidad" min="1" value="1" class="form-control">
            </div>

            <div class="d-grid gap-2">
              <button class="btn btn-success btn-lg " type="submit">
                <i class="fa-solid fa-cart-plus me-2"></i>Agregar al carrito
              </button>
              <button class="btn btn-outline-secondary" data-bs-dismiss="modal" type="button">Cancelar</button>
            </div>

          </form>
        </div>
      </div>

    </div>
  </div>
</div>