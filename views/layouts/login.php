 <!-- loginForm.php -->
<div class="container d-flex align-items-center justify-content-center" style="min-height: 85vh;">
    <div class="row w-100 justify-content-center">
        <div class="col-md-6 col-lg-4">
            <div class="card shadow border-0" style="background-color: #1f1f2e; color: #f1faee; border-radius: 12px;">
                <div class="card-header text-center" style="background: linear-gradient(90deg, #8e2de2, #4a00e0); border-top-left-radius: 12px; border-top-right-radius: 12px;">
                    <h4 class="m-0 text-white" style="text-shadow: 0 0 10px rgba(255,255,255,0.2);">Login</h4>
                </div>
                <div class="card-body p-4">
                    <form action="<?php echo BASE_URL.'controller/login.php' ?>" method="POST">
                        <div class="mb-3">
                            <label class="form-label" for="correo">Correo</label>
                            <input class="form-control bg-dark text-light border-secondary" type="email" required name="correo" id="correo">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="contraseña">Contraseña</label>
                            <input class="form-control bg-dark text-light border-secondary" type="password" required name="contraseña" id="contraseña">
                        </div>
                        <div class="d-grid">
                            <button class="btn" type="submit" style="background-color: #e63946; color: #fff; font-weight: bold;">
                                Iniciar sesión
                            </button>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center small" style="background-color: #0b0c10; border-bottom-left-radius: 12px; border-bottom-right-radius: 12px;"> 