<?php if (isset($_GET['error'])): ?>
    <!-- Modal de error -->
    <div class="modal fade" id="errorModalLogin" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-dark text-white">
                <div class="modal-header">
                    <h5 class="modal-title" id="errorModalLabel">⚠️ Error de inicio de sesión</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <?php
                        switch ($_GET['error']) {
                            case 'usuario':
                                echo "El usuario no existe.";
                                break;
                            case 'contraseña':
                                echo "La contraseña es incorrecta.";
                                break;
                            case 'datos':
                            default:
                                echo "Los datos enviados son inválidos.";
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
            const errorModal = new bootstrap.Modal(document.getElementById('errorModalLogin'));
            errorModal.show();
        });
    </script>
<?php endif; ?>
