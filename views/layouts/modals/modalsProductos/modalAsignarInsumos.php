<div class="modal fade" id="modalAsignarInsumos" tabindex="-1" aria-labelledby="insumosProducto" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-dark text-white">
            <div class="modal-header">
                <h5 class="modal-title" id="insumosProducto">Asignar insumos al Producto</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <form action="<?php echo BASE_URL.'controller/productos/asignarInsumo.php' ?>" method="POST">
                    <?php if (!isset($insumos)) $insumos = null; ?>
                     <input class="form-control" type="hidden"  name="idProducto" id="idProductoModalAsinarInsumo">
                    <label class="form-label" for="insumo">Asignar insumo</label>
                    <select name="idInsumo" id="agregarInsumo">
                        <?php foreach ($insumos as $insumo): ?>
                            <option value="<?php echo $insumo['idInsumo'] ?>">
                                <?php echo $insumo['nombre'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-6">
                                <button class="btn btn-primary " type="submit">Guardar</button>
                            </div>
                            <div class="col-6">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
        <div class="modal-footer">

        </div>
    </div>
</div>
</div>