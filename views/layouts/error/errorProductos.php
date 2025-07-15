<?php if (isset($_GET['error'])): ?>
    <!-- Modal de error -->
    <div class="modal fade" id="errorModalProductos" tabindex="-1" aria-labelledby="errorModalLabelProducto" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-dark text-white">
                <div class="modal-header">
                    <h5 class="modal-title" id="errorModalLabelProducto">⚠️ Error</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <?php
                        switch ($_GET['error']) {
                            case 'productos':
                                echo "No hay Productos para mostrar,por favor agregue un producto";
                                break;
                        }
                    ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Mostrar modal automáticamente -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const errorModalProducto = new bootstrap.Modal(document.getElementById('errorModalProductos'));
            errorModalProducto.show();
        });
    </script>
<?php endif; ?>