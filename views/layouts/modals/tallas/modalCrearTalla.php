<!-- Modal Crear Talla -->
<div class="modal fade" id="modalCrearTalla" tabindex="-1" aria-labelledby="labelCrearTalla" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-dark text-white border border-secondary rounded-4 shadow-lg">
            <div class="modal-header border-0">
                <h5 class="modal-title fw-semibold text-light" id="labelCrearTalla">
                    <i class="fa-solid fa-ruler-combined me-2 text-primary"></i> Crear Talla
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>

            <div class="modal-body">
                <form action="<?php echo BASE_URL . 'controller/tallas/crearTalla.php' ?>" method="POST">
                    <div class="mb-3">
                        <label class="form-label text-secondary" for="nombreTalla">Nombre de la Talla</label>
                        <input class="form-control bg-dark text-white border-secondary" 
                               type="text" name="nombreTalla" id="nombreTalla" placeholder="Ej: S, M, L, XL..." required>
                    </div>

                    <div class="text-center mt-4">
                        <button class="btn btn-primary px-4 me-2" type="submit">
                            <i class="fa-solid fa-check me-1"></i> Guardar
                        </button>
                        <button type="button" class="btn btn-outline-light px-4" data-bs-dismiss="modal">
                            <i class="fa-solid fa-xmark me-1"></i> Cancelar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
