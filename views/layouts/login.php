<div class="container d-flex align-items-center justify-content-center" style="min-height: 85vh;">
    <div class="row w-100 justify-content-center">
        <div class="col-md-6 col-lg-4">
            <div class="card shadow border-0" style="border-radius: 12px;">
                <div class="card-header text-center bg-primary text-white">
                    <h4 class="m-0">Login</h4>
                </div>
                <div class="card-body p-4">
                    <form action="<?php echo BASE_URL.'controller/login.php' ?>" method="POST">
                        <div class="mb-3">
                            <label class="form-label" for="correo">Correo</label>
                            <input class="form-control border-secondary" type="email" required name="correo" id="correo">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="contraseña">Contraseña</label>
                            <input class="form-control border-secondary" type="password" required name="contraseña" id="contraseña">
                        </div>
                        <div class="d-grid">
                            <button class="btn btn-primary" type="submit">
                                Iniciar sesión
                            </button>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center small text-muted">
                    &copy; Tienda Artística
                </div>
            </div>
        </div>
    </div>  
</div>
