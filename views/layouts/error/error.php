<!-- para usar esta modal se requiere pasar dos parámetros en la sesión, esto se hace desde el controlador
el primer parámetro y más importante es tipoMensaje, si se agrega una nueva opción deberá modificarse esta modal 
en el switch, solo se agrega otro caso, el segundo parámetro es el mensaje en sí mismo.
Además, no olvidar de agregar el calor del ícono y del texto del header de la modal. 
La modal borra por sí sola el mensaje de error y el tipo de mensaje -->
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/tiendaMonica/rutas/rutaGlobal.php';
require_once BASE_PATH . 'functions/helpers/session.php';
?>
<?php if (isset($_SESSION['tipoMensaje']) || isset($_SESSION['mensaje'])): ?>
    <div class="modal fade" id="modalSistema" tabindex="-1" aria-labelledby="modalSistemaLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
                <?php $colorModal = "";
                $icono = "";
                $textoHeader = ""; ?>
                <?php
                $sesion = $_SESSION['tipoMensaje'] ?? "";
                switch ($sesion) {
                    case 'error':
                        $colorModal = "bg-danger";
                        $icono = "fa-triangle-exclamation";
                        $textoHeader = "Error";
                        break;
                    case 'exito':
                        $colorModal = "bg-success";
                        $icono = "fa-circle-check";
                        $textoHeader = "Acción exitosa";
                    case "":
                        break;
                    default:
                        $colorModal = "bg-success";
                        $icono = "fa-circle-check";
                        $textoHeader = "Acción exitosa";

                        break;
                }
                ?>
                <!-- Header dinámico -->
                <div class="modal-header text-white <?php echo $colorModal ?> ">
                    <h5 class=" modal-title fw-semibold d-flex align-items-center" id="modalSistemaLabel">
                        <i class="fa-solid <?php echo $icono ?> me-2 fs-4"></i>
                        <?php echo $textoHeader; ?>
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Cerrar"></button>
                </div>
                <?php unset($_SESSION['tipoMensaje']) ?>
                <!-- Body -->
                <div class="modal-body text-center py-4">
                    <p class="fw-semibold fs-5 text-secondary mb-0">
                        <?php echo isset($_SESSION['mensaje']) ? $_SESSION['mensaje'] : "¡Oops,algo salió mal!"; ?>
                    </p>
                </div>
                <?php unset($_SESSION['mensaje']) ?>
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