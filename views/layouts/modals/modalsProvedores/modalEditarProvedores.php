<!-- Modal editar provedores -->
<div class="modal fade" id="modalEditarProvedor" tabindex="-1" aria-labelledby="editarLabelProvedor" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-dark text-white">
            <div class="modal-header">
                <h5 class="modal-title" id="editarLabelProvedor">Editar Producto</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <form action="<?php echo BASE_URL . 'controller/provedores/editarProvedor.php' ?>" method="POST">
                    <div class="mb-3">
                        <input class="form-control" type="hidden" required name="idProvedor" id="editarIdProvedor">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="editarNombreProvedor">Nombre del provedor</label>
                        <input class="form-control" type="text" required name="nombre" id="editarNombreProvedor">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="editarContactoProvedor">Contacto </label>
                        <input class="form-control" type="text" required name="contacto" id="editarContactoProvedor">
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