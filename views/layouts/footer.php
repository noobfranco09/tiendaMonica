<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/tiendaMonica/rutas/rutaGlobal.php' ?>
<footer class="main-footer">
  <p>&copy; <?= date('Y') ?> Gaia studio. Todos los derechos reservados.</p>
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
  <script src="https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-2.3.4/r-3.0.7/datatables.min.js"
    integrity="sha384-LFoikRctTHRCzOQ2ubrUfFQlhXMtaj7g32RRDMk2UVJFlHlk/s3w8xMOPB5t92MP"
    crossorigin="anonymous"></script>
    <script src="<?php echo BASE_URL .'/assets/js/bootstrap.bundle.js'?>"></script>