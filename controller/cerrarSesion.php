<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/tiendaMonica/rutas/rutaGlobal.php';
require BASE_PATH . 'functions\helpers\session.php';
session_unset();
session_destroy();
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),    
        '',                
        time() - 42000,    
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}
require_once BASE_PATH . '/controller/login.php';
exit()
?>