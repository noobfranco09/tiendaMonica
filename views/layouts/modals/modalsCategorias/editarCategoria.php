<!-- Modal editar categorias -->
<div class="modal fade" id="modalEditarCategoria" tabindex="-1" aria-labelledby="labelEditarCategoria" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-dark text-white">
            <div class="modal-header">
                <h5 class="modal-title" id="labelEditarCategoria">Editar Categoría</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <form action="<?php echo BASE_URL . 'controller/categorias/editarCategoria.php' ?>" method="POST">
                    <input type="number" hidden name="editarIdCategoria" id="editarIdCategoria">
                <div class="mb-3">
                        <label class="form-label" for="editarNombreCategoria">Nombre de la categoría</label>
                        <input class="form-control" type="text" required name="nombre" id="editarNombreCategoria">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="editarDescricionCategoria">Descripción de la categoría</label>
                        <input class="form-control" type="text" required name="descripcion" id="editarDescricionCategoria">
                    </div>
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
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>