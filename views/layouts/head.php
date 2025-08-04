<!-- head.php -->
<?php require $_SERVER['DOCUMENT_ROOT'].'/tiendaMonica/rutas/rutaGlobal.php' ?>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Tienda Artística</title>

<!-- Bootstrap local -->
<link rel="stylesheet" href="<?php echo BASE_URL.'assets/css/bootstrap.min.css' ?>">

<style>
    html, body {
        height: 100%;
        margin: 0;
        font-family: 'Segoe UI', sans-serif;
        background-color: #f8f9fa;
        color: #333;
    }

    body {
        display: flex;
        flex-direction: column;
    }

    header {
        background-color: #2c3e50;
        color: white;
        padding: 1rem;
        text-align: center;
    }

    main {
        flex: 1;
        display: flex;
        min-height: 0;
    }

    nav.sidebar {
        width: 220px;
        background-color: #34495e;
        color: white;
        min-height: 100%;
        padding-top: 2rem;
    }

    nav.sidebar a {
        display: block;
        padding: 0.75rem 1rem;
        color: #ecf0f1;
        text-decoration: none;
    }

    nav.sidebar a:hover {
        background-color: #3c6382;
    }

    .content-wrapper {
        flex: 1;
        padding: 2rem;
    }

    footer {
        background-color: #2c3e50;
        color: white;
        text-align: center;
        padding: 1rem;
    }

    .card-header, .card-footer {
        background-color: #2c3e50;
        color: white;
    }

    .btn {
        background-color: #2980b9;
        color: white;
    }

    .btn:hover {
        background-color: #3498db;
    }

    @media (max-width: 768px) {
        nav.sidebar {
            width: 100%;
            position: relative;
            min-height: auto;
        }

        main {
            flex-direction: column;
        }
    }
</style>
