<!-- head.php -->
 <?php require $_SERVER['DOCUMENT_ROOT'].'/tiendaMonica/rutas/rutaGlobal.php' ?>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Tienda Artística</title>

<!-- Bootstrap local -->
<link rel="stylesheet" href= <?php echo BASE_URL.'assets/css/bootstrap.min.css' ?>>




<style>
    html, body {
        height: 100%;
        margin: 0;
        background-color: #0b0c10; /* fondo galáctico oscuro */
        font-family: 'Orbitron', sans-serif;
        color: #ffffff;
    }

    body {
        display: flex;
        flex-direction: column;
    }

    main {
        flex: 1;
    }

    header {
        background: linear-gradient(90deg, #8e2de2, #4a00e0);
        color: white;
        padding: 1.5rem 0;
        text-align: center;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.6);
    }

    nav {
        background-color: #1f1f2e;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
    }

    nav a.nav-link {
        color: white !important;
    }

    footer {
        background-color: #0b0c10;
        color: white;
        padding: 1rem 0;
        text-align: center;
    }

    .btn:hover {
        opacity: 0.9;
    }
</style>