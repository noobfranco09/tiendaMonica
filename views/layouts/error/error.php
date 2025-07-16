<?php if (isset($_SESSION['error'])): ?>
    <!-- Modal de error -->
    <div class="modal fade" id="errorModalProductos" tabindex="-1" aria-labelledby="errorModalLabelProducto" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-dark text-white">
                <div class="modal-header">
                    <h5 class="modal-title" id="errorModalLabelProducto">⚠️ Advertencia</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <?php

                                echo $_SESSION['error'] ;
                                unset($_SESSION['error'])
                                

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