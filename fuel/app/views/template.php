<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="/myblog/public/assets/css/style.css?v=<?php echo time(); ?>">
</head>
<body>
    <div class="main-container">
        
        <?php if (Session::get_flash('success')): ?>
            <div class="alert-box">
                <div class="alert-icon" style="border-radius: 50%; background-color: #16a34a; display: grid; place-items: center; border: 2px solid #bbf7d0;"></div>
                <div class="alert-message">
                    <h4>¡Éxito!</h4>
                    <p><?php echo Session::get_flash('success'); ?></p>
                </div>
                <span style="margin-left: auto; color: #888; font-size: 18px; cursor: pointer;" onclick="this.parentElement.style.display='none'">&times;</span>
            </div>
        <?php endif; ?>

        <?php if (Session::get_flash('error')): ?>
            <div class="alert-box">
                <div class="alert-icon" style="border-radius: 50%; background-color: #dc2626; display: grid; place-items: center; border: 2px solid #fecaca; color: white; font-weight: bold; font-size: 14px;">!</div>
                <div class="alert-message">
                    <h4>Hubo un problema</h4>
                    <p><?php echo Session::get_flash('error'); ?></p>
                </div>
                <span style="margin-left: auto; color: #888; font-size: 18px; cursor: pointer;" onclick="this.parentElement.style.display='none'">&times;</span>
            </div>
        <?php endif; ?>

        <?php echo $content; ?>
        
    </div>

    <script>
        window.addEventListener('load', function() {
            setTimeout(function() {
                document.querySelectorAll('.alert-box').forEach(function(alert) {
                    alert.style.transition = 'opacity 0.5s ease-out, transform 0.5s ease-out';
                    alert.style.opacity = '0';
                    alert.style.transform = 'translateY(-10px)';
                    setTimeout(() => alert.style.display = 'none', 500);
                });
            }, 6000); // 6 segundos
        });
    </script>
</body>
</html>