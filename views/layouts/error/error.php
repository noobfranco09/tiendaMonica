<?php if (isset($_SESSION['error']) || isset($_SESSION['mensaje'])): ?>
    <div class="modal fade" id="modalSistema" tabindex="-1" aria-labelledby="modalSistemaLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">

                <!-- Header dinámico -->
                <div class="modal-header text-white 
                    <?php echo isset($_SESSION['error']) ? 'bg-danger' : 'bg-success'; ?>">
                    <h5 class="modal-title fw-semibold d-flex align-items-center" id="modalSistemaLabel">
                        <i class="fa-solid 
                            <?php echo isset($_SESSION['error']) ? 'fa-triangle-exclamation' : 'fa-circle-check'; ?> 
                            me-2 fs-4"></i>
                        <?php echo isset($_SESSION['error']) ? 'Error' : 'Éxito'; ?>
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>

                <!-- Body -->
                <div class="modal-body text-center py-4">
                    <p class="fw-semibold fs-5 text-secondary mb-0">
                        <?php
                            if (isset($_SESSION['error'])) {
                                echo htmlspecialchars($_SESSION['error']);
                                unset($_SESSION['error']);
                            }
                            if (isset($_SESSION['mensaje'])) {
                                echo htmlspecialchars($_SESSION['mensaje']);
                                unset($_SESSION['mensaje']);
                            }
                        ?>
                    </p>
                </div>

                <!-- Footer -->
                <div class="modal-footer border-0 justify-content-center pb-4">
                    <button type="button" class="btn btn-outline-secondary px-4 rounded-pill" data-bs-dismiss="modal">
                        <i class="fa-solid fa-xmark me-1"></i> Cerrar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const modalSistema = new bootstrap.Modal(document.getElementById('modalSistema'));
            modalSistema.show();
        });
    </script>
<?php endif; ?>
