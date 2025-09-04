<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/tiendaMonica/rutas/rutaGlobal.php';
session_start();
session_destroy();
require_once BASE_PATH.'/controller/login.php';
?>