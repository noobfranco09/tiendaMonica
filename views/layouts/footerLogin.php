<?php 
require_once $_SERVER['DOCUMENT_ROOT'] . '/tiendaMonica/rutas/rutaGlobal.php';?>

<footer class="main-footer">
    <p>&copy; <?= date('Y') ?> Tienda Artística. Todos los derechos reservados.</p>
    <script src="https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-2.3.4/r-3.0.7/datatables.min.js"
        integrity="sha384-LFoikRctTHRCzOQ2ubrUfFQlhXMtaj7g32RRDMk2UVJFlHlk/s3w8xMOPB5t92MP"
        crossorigin="anonymous"></script>
    <script src="<?php echo BASE_URL . '/assets/js/bootstrap.bundle.js' ?>"></script>
</footer>