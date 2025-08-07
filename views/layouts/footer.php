<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/tiendaMonica/rutas/rutaGlobal.php' ?>
<footer class="main-footer">
    <p>&copy; <?= date('Y') ?> Tienda Artística. Todos los derechos reservados.</p>
    <script>
        const toggleBtn = document.getElementById('toggleSidebar');
        const sidebar = document.querySelector('.sidebar');
        const mainContent = document.querySelector('.main-content');

        toggleBtn.addEventListener('click', () => {
            sidebar.classList.toggle('collapsed');
            mainContent.classList.toggle('expanded');
        });
    </script>

</footer>

<!-- JS Bootstrap local -->
<script src="<?php echo BASE_URL . 'assets/js/bootstrap.bundle.js' ?>"></script>