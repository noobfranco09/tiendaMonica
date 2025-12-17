<!-- Modal crear producto -->
<div class="modal fade" id="modalCrearProvedor" tabindex="-1" aria-labelledby="labelCrearProvedor" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-dark text-white">
            <div class="modal-header">
                <h5 class="modal-title" id="labelCrearProvedor">Agregar Provedor</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <form action="<?php echo BASE_URL.'controller/provedores/crearProvedor.php' ?>" method="POST">
                    <div class="mb-3">
                        <label class="form-label" for="nombreProvedor">Nombre del provedor</label>
                        <input class="form-control" type="text" required name="nombreProvedor" id="nombreProvedor">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="contactoProvedor">contacto del provedor</label>
                        <input class="form-control" type="number" required name="contactoProvedor"
                            id="contactoProvedor">
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