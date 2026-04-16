<div class="split-screen">
    <div class="left-panel">
        <h1 class="texto-hola">¡Hola!</h1>
        <h2 class="texto-bienvenido">Bien Venido a tu blog</h2>
        <p class="texto-porfavor">Por favor, inicia sesión para gestionar tu blog.</p>

        <?php if (Session::get_flash('error')): ?>
            <div class="error-message">
                <?php echo Session::get_flash('error'); ?>
            </div>
        <?php endif; ?>

        <?php echo Form::open(array('action' => '/myblog/public/posts/login', 'method' => 'POST', 'class' => 'login-form')); ?>
            <div class="form-group">
                <label>Usuario</label>
                <input type="text" name="username" required class="form-control">
            </div>
            
            <div class="form-group">
                <label>Contraseña</label>
                <input type="password" name="password" required class="form-control">
                <div class="link-container">
                    <a href="#" class="forgot-link">¿Olvidaste tu contraseña?</a>
                </div>
            </div>
            
            <button type="submit" class="btn-submit">Acceder</button>
        <?php echo Form::close(); ?>
    </div>
    <div class="right-panel"></div>
</div>