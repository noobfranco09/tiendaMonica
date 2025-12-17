<!-- Modal Crear Variante -->
<div class="modal fade" id="modalCrearVariante" tabindex="-1" aria-labelledby="labelCrearVariante" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg rounded-4" style="background-color: #1e1e2f; color: #f5f5f5;">

            <!-- Header -->
            <div class="modal-header border-0" style="background-color: #292943;">
                <h5 class="modal-title fw-semibold" id="labelCrearVariante">
                    <i class="fas fa-box me-2 text-primary"></i> Crear Variante
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>

            <!-- Body -->
            <div class="modal-body px-4 py-3">
                <form action="<?php echo BASE_URL . 'controller/variantes/crearVariante.php' ?>" 
                      method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>

                    <!-- Imagen -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold" for="imagen">
                            <i class="fas fa-image me-1 text-info"></i> Imagen
                        </label>
                        <input class="form-control bg-dark text-white border-secondary" 
                               type="file" name="imagen" id="imagen" accept="image/*" required>
                    </div>

                    <!-- Nombre y Precio en una fila -->
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold" for="nombre">
                                <i class="fas fa-tag me-1 text-info"></i> Nombre
                            </label>
                            <input class="form-control bg-dark text-white border-secondary" 
                                   type="text" name="nombre" id="nombre" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold" for="precio">
                                <i class="fas fa-dollar-sign me-1 text-info"></i> Precio
                            </label>
                            <input class="form-control bg-dark text-white border-secondary" 
                                   type="number" step="0.01" name="precio" id="precio" required>
                        </div>
                    </div>

                    <!-- Stock y Estado -->
                    <div class="row g-3 mt-2">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold" for="stock">
                                <i class="fas fa-boxes me-1 text-info"></i> Stock
                            </label>
                            <input class="form-control bg-dark text-white border-secondary" 
                                   type="number" name="stock" id="stock" min="0" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold" for="estado">
                                <i class="fas fa-toggle-on me-1 text-info"></i> Estado
                            </label>
                            <select class="form-select bg-dark text-white border-secondary" 
                                    name="estado" id="estado" required>
                                <option value="" disabled selected>Selecciona el estado</option>
                                <option value="1">Activo</option>
                                <option value="0">Inactivo</option>
                            </select>
                        </div>
                    </div>

                    <!-- Talla, Color, Producto -->
                    <div class="row g-3 mt-2">
                        <div class="col-md-4">
                            <label class="form-label fw-semibold" for="tallas_idTalla">
                                <i class="fas fa-ruler-combined me-1 text-info"></i> Talla
                            </label>
                            <select class="form-select bg-dark text-white border-secondary" 
                                    name="tallas_idTalla" id="tallas_idTalla" required>
                                <option value="" disabled selected>Selecciona</option>
                                <?php foreach ($resultadoTallas as $talla): ?>
                                    <option value="<?php echo $talla['idTalla']; ?>">
                                        <?php echo htmlspecialchars($talla['nombre']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold" for="colores_idColor">
                                <i class="fas fa-palette me-1 text-info"></i> Color
                            </label>
                            <select class="form-select bg-dark text-white border-secondary" 
                                    name="colores_idColor" id="colores_idColor" required>
                                <option value="" disabled selected>Selecciona</option>
                                <?php foreach ($resultadoColores as $color): ?>
                                    <option value="<?php echo $color['idColor']; ?>">
                                        <?php echo htmlspecialchars($color['nombre']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold" for="productos_idProducto">
                                <i class="fas fa-box-open me-1 text-info"></i> Producto
                            </label>
                            <select class="form-select bg-dark text-white border-secondary" 
                                    name="productos_idProducto" id="productos_idProducto" required>
                                <option value="" disabled selected>Selecciona</option>
                                <?php foreach ($productos as $producto): ?>
                                    <option value="<?php echo $producto['idProducto']; ?>">
                                        <?php echo htmlspecialchars($producto['nombre_producto']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <!-- Botones -->
                    <div class="text-center mt-4">
                        <button class="btn btn-primary px-4 me-2 shadow-sm" type="submit">
                            <i class="fas fa-save me-1"></i> Guardar
                        </button>
                        <button type="button" class="btn btn-outline-light px-4" data-bs-dismiss="modal">
                            <i class="fas fa-times me-1"></i> Cancelar
                        </button>
                    </div>

                </form>
            </div>

            <!-- Footer -->
            <div class="modal-footer border-0 text-muted small text-center">
                <span>Gestión de Variantes • Tienda Artística</span>
            </div>
        </div>
    </div>
</div>
