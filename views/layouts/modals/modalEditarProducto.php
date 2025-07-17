<!-- Modal editar producto -->
<div class="modal fade" id="modalEditarProducto" tabindex="-1" aria-labelledby="editarLabelProducto" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-dark text-white">
            <div class="modal-header">
                <h5 class="modal-title" id="editarLabelProducto">Editar Producto</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <form action="../controller/editarProducto.php" method="POST">
                    <div class="mb-3">
                        <input class="form-control" type="hidden" required name="editarIdProducto" id="editarIdProducto">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="editarNombreProducto">Nombre del producto</label>
                        <input class="form-control" type="text" required name="editarNombreProducto" id="editarNombreProducto">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="editarDescripcionProducto">Descripción del producto</label>
                        <input class="form-control" type="text" required name="editarDescripcionProducto"
                            id="editarDescripcionProducto">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="editarStockProducto">Stock del producto</label>
                        <input class="form-control" type="number" required name="editarStockProducto" id="editarStockProducto">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="editarPrecioProducto">Precio del producto</label>
                        <input class="form-control" type="number" required name="editarPrecioProducto" id="editarPrecioProducto">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="editarIdProvedor">Provedores:</label>
                        <select name="editarIdProvedor" id="editarIdProvedor">
                            <option value="" disabled selected>Selecciona un provedor</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="editarIdTipoProducto">Categoria del producto: </label>
                        <select name="editarIdTipoProducto" id="editarIdTipoProducto">
                            <option value="" disabled selected>Selecciona una categoría para el producto</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-6">
                                <button class="btn btn-primary " type="submit">Guardar</button>
                            </div>
                            <div class="col-6">
                                <a href="./dashBoard.php" class="btn btn-danger ">Cancelar</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>