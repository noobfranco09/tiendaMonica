<!-- Modal asignar categoria -->
<div class="modal fade" id="modalAsignarCategoria" tabindex="-1" aria-labelledby="labelAsignarCategoria"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-dark text-white">
            <div class="modal-header">
                <h5 class="modal-title" id="labelAsignarCategoria">Agregar Categoria </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <form action="<?php echo BASE_URL . 'controller/provedores/asignarCategoria.php' ?>" method="POST">
                    <div class="mb-3">
                        <input type="number" name="idProvedor" id="idAsignarCategoria" hidden>
                        <select name="categorias" id="" class="form-select">
                            <option value="" selected disabled >Elija una categoría </option>
                            <?php foreach ($categorias as $categoria) :?>
                                <option value="<?php echo $categoria['idCategoria'] ?>"><?php echo  $categoria['idCategoria']." ".$categoria['nombre'] ?></option>
                            <?php endforeach; ?>

                        </select>
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