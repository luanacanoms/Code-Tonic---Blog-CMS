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
        
        <?php if (Uri::string() !== 'posts/login'): ?>
            <header class="top-header">
                <div class="logo-text"><span class="code">Code</span><span class="tonic">&Tonic</span></div>
                
                <?php if(Session::get('logged_in')) : ?>
                    <a href="/myblog/public/posts/logout" class="header-action-right" onclick="return confirm('¿Estás segura de que deseas cerrar sesión?');">
                        <img src="/myblog/public/assets/img/logout-icon.png" alt="Salir">
                    </a>
                <?php endif; ?>

            </header>
        <?php endif; ?> <main class="main-layout">
            <?php echo $content; ?>
        </main>

    </div>
</body>
</html>