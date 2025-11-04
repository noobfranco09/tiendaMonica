<!-- Modal: Datos del Usuario -->
<div class="modal fade" id="modalDatosUsuario" tabindex="-1" aria-labelledby="modalDatosUsuarioLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <!-- Header -->
            <div class="modal-header bg-primary text-white rounded-top-4">
                <h5 class="modal-title fw-semibold d-flex align-items-center" id="modalDatosUsuarioLabel">
                    <i class="fa-solid fa-user-pen me-2 fs-5"></i> Ingresar Datos de Envío
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Cerrar"></button>
            </div>

            <!-- Formulario -->
            <form id="formDatosUsuario" method="POST" action="procesarDatosUsuario.php">
                <div class="modal-body px-4 py-3">
                    <!-- Nombres  -->
                    <div class="mb-3">
                        <label for="nombres" class="form-label fw-semibold">Nombres</label>
                        <input type="text" class="form-control rounded-pill px-3" id="nombres" name="nombres"
                            placeholder="Ej: Juan José" required>
                    </div>
                    <!-- Apellidos  -->
                    <div class="mb-3">
                        <label for="apellidos" class="form-label fw-semibold">Apellidos</label>
                        <input type="text" class="form-control rounded-pill px-3" id="apellidos" name="apellidos"
                            placeholder="Ej: Perez Rios" required>
                    </div>
                    <!-- Dirección -->
                    <div class="mb-3">
                        <label for="direccion" class="form-label fw-semibold">Dirección</label>
                        <input type="text" class="form-control rounded-pill px-3" id="direccion" name="direccion"
                            placeholder="Ej: Calle 123 #45-67 Barrio santa maría" required>
                    </div>

                    <!-- Observaciones -->
                    <div class="mb-3">
                        <label for="observaciones" class="form-label fw-semibold">Observaciones</label>
                        <textarea class="form-control rounded-4 px-3" id="observaciones" name="observaciones" rows="3"
                            placeholder="Ej: Entregar en portería, llamar antes de llegar..."></textarea>
                    </div>
                </div>

                <!-- Footer -->
                <div class="modal-footer border-0 d-flex justify-content-between px-4 pb-4">
                    <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">
                        <i class="fa-solid fa-xmark me-1"></i> Cancelar
                    </button>
                    <button type="submit" class="btn btn-primary rounded-pill px-4 shadow-sm">
                        <i class="fa-solid fa-paper-plane me-1"></i> Enviar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>