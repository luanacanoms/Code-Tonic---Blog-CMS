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
        <div class="logo-text">Code & Tonic</div>
        <nav class="nav-links">
            <a href="/myblog/public/posts">Inicio</a>
            <?php if(Session::get('logged_in')) : ?>
                <a href="/myblog/public/posts/logout">Cerrar Sesión</a>
            <?php else : ?>
                <a href="/myblog/public/posts/login">Iniciar Sesión</a>
            <?php endif; ?>
        </nav>
    </header>
<?php endif; ?>

        <main class="main-layout">
            <?php echo $content; ?>
        </main>
    </div>
</body>
</html>
