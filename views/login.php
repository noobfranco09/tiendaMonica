<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-6 ">
                <form action="../controller/login.php" method="POST">
                    <div class="mb-3">
                        <label class="form-label" for="correo">Correo</label>
                        <input class="form-control" type="email" required name="correo" id="correo">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="contraseña">Contraseña</label>
                        <input class="form-control" type="text" required name="contraseña" id="contraseña">
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-primary" type="submit" id="Registrarse">Registrarse</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script src="../assets/js/bootstrap.bundle.js"></script>
</body>

</html>