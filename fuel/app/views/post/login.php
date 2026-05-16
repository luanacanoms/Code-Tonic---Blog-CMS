<div class="split-screen">
    
    <div class="left-panel">
        <p class="texto-hola">Hola Mariana,</p>
        <p class="texto-bienvenido">Bienvenida a Code&Tonic</p>
        <p class="texto-porfavor">Por favor, inicia sesión en tu cuenta de administradora</p>

        <form class="login-form" action="" method="POST">
            
            <?php if (Session::get_flash('error')): ?>
                <div class="error-message">
                    <?php echo Session::get_flash('error'); ?>
                </div>
            <?php endif; ?>

            <div class="form-group">
                <label>Usuario</label>
                <input type="text" name="username" class="form-control" required>
            </div>
            
            <div class="form-group">
                <label>Contraseña</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            
            <button type="submit" class="btn-submit">Iniciar Sesión</button>
        </form>
    </div>
    
    <div class="right-panel">
        </div>
    
</div>