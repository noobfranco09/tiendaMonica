<?php if (isset($_SESSION['error']) || isset($_SESSION['mensaje'])): ?>
    <div class="modal fade" id="errorModalProductos" tabindex="-1" aria-labelledby="errorModalLabelProducto" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-3" style="background-color: #e3eeff;">
                <div class="modal-header" style="background-color: #2c3e50; border-bottom: 1px solid #dee2e6;">
                    <h5 class="modal-title fw-semibold text-white d-flex align-items-center" id="errorModalLabelProducto">
                        <i class="bi bi-info-circle me-2 text-primary"></i> Mensaje del sistema
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>

                <div class="modal-body text-center text-black" style="font-size: 1.2rem;">
                    <?php
                        if (isset($_SESSION['error'])) {
                            echo $_SESSION['error'];
                            unset($_SESSION['error']);
                        }
                        if (isset($_SESSION['mensaje'])) {
                            echo $_SESSION['mensaje'];
                            unset($_SESSION['mensaje']);
                        }
                    ?>
                </div>

                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" style="border-radius: 8px;">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const errorModalProducto = new bootstrap.Modal(document.getElementById('errorModalProductos'));
            errorModalProducto.show();
        });
    </script>
<?php endif; ?>
