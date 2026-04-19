<section class="hero-section">
    <div class="hero-image">
        <img src="/myblog/public/assets/img/typing-cat.jpg" alt="Mariana coding">
    </div>
    <div class="hero-text">
        <h1>Hola, soy <span>Mariana</span></h1>
        <p>Soy una estudiante de ingeniería informática en España. Me gusta trabajar con el backend of the web, esto es mi blog Code&Tonic where I share a bit of my personal projects.</p>
        
        <form class="connect-form" action="#" method="POST">
            <label>Let's Connect</label>
            <div class="form-row">
                <input type="email" placeholder="Tu correo electrónico">
                <button type="submit">Enviar</button>
            </div>
        </form>
    </div>
</section>

<section class="topics-section">
    <h3>Mis tópicos</h3>
    <div class="topics-box">
        <div class="topic-item"><img src="/myblog/public/assets/img/coding.jpg" alt="Coding"><br>Coding</div>
        <div class="topic-item"><img src="/myblog/public/assets/img/web-design.jpg" alt="Web Design"><br>Web Design</div>
        <div class="topic-item"><img src="/myblog/public/assets/img/salud-mental.jpg" alt="Salud Mental"><br>Salud Mental</div>
        <div class="topic-item"><img src="/myblog/public/assets/img/tiempo-de-calidad.jpg" alt="Tiempo de Calidad"><br>Tiempo de Calidad</div>
        <div class="topic-item"><img src="/myblog/public/assets/img/desportes.jpg" alt="Deportes"><br>Deportes</div>
        <div class="topic-item"><img src="/myblog/public/assets/img/viajes.jpg" alt="Viajes"><br>Viajes</div>
    </div>
</section>

<div class="content-grid">
    
    <aside class="sidebar">
        <div class="sidebar-section">
            <h4 class="sidebar-title">
                <img src="/myblog/public/assets/img/material-symbols_star-rounded.png" class="sidebar-icon"> Sobre mi
            </h4>
            <div class="box-sobre-mi">
                <img src="/myblog/public/assets/img/typing-cat.jpg" alt="Avatar" class="avatar-img">
                
                <p>¡Hola! Soy Mariana, una estudiante de ingeniería informática apasionada por el desarrollo web backend. Desde mi base en Alemania, comparto mis proyectos personales, retos de código y mis experiencias explorando nuevas tecnologías. Este blog es mi pequeño rincón para conectar y aprender. ¡Gracias por pasar!</p>
                
                <div class="social-icons-left">
                    <a href="#"><img src="/myblog/public/assets/img/ig-icon.png" alt="Instagram"></a>
                    <a href="#"><img src="/myblog/public/assets/img/tiktok-icon.png" alt="TikTok"></a>
                    <a href="#"><img src="/myblog/public/assets/img/youtube-icon.png" alt="YouTube"></a>
                </div>
            </div>
        </div>

        <div class="sidebar-section">
            <h4 class="sidebar-title"><img src="/myblog/public/assets/img/tag-icon.png" class="sidebar-icon"> Tag Cloud</h4>
            <div class="box-tag-cloud">
                <ul>
                    <li><span class="bullet"></span> Deportes</li>
                    <li><span class="bullet"></span> Tiempo de Calidad</li>
                    <li><span class="bullet"></span> Salud Mental</li>
                    <li><span class="bullet"></span> Viajes</li>
                    <li><span class="bullet"></span> Web Design</li>
                    <li><span class="bullet"></span> Coding</li>
                </ul>
            </div>
        </div>

        <div class="sidebar-section">
            <h4 class="sidebar-title"><img src="/myblog/public/assets/img/puzzle-icon.png" class="sidebar-icon"> Recently Uploaded</h4>
            <div class="box-recent">
                <div class="recent-post-item">
                    <img src="/myblog/public/assets/img/first-fuel-project.jpg" alt="Post" class="recent-img">
                    <div class="recent-info">
                        <a href="#" class="recent-title">My first FuelPHP Project</a>
                        <span class="recent-date">10 de noviembre, 2026</span>
                    </div>
                </div>

                <div class="recent-post-item">
                    <img src="/myblog/public/assets/img/how-journaling.jpg" alt="Post" class="recent-img">
                    <div class="recent-info">
                        <a href="#" class="recent-title">How journaling changed my life</a>
                        <span class="recent-date">08 de noviembre, 2026</span>
                    </div>
                </div>

                <div class="recent-post-item">
                    <img src="/myblog/public/assets/img/art-block.jpg" alt="Post" class="recent-img">
                    <div class="recent-info">
                        <a href="#" class="recent-title">Hitting an art block</a>
                        <span class="recent-date">05 de noviembre, 2026</span>
                    </div>
                </div>
            </div>
        </div>
    </aside>

    <main class="posts-area">
        <div class="admin-header">
            <a href="/myblog/public/posts/add" class="btn-add-post">+ Añadir Nuevo Post</a>
        </div>

        <?php if ($posts): ?>
            <?php foreach ($posts as $post): ?>
                <div class="post-card">
                    <a href="/myblog/public/posts/view/<?php echo $post->id; ?>">
                        <img src="<?php echo $post->image_url ?: '/myblog/public/assets/img/first-fuel-project.jpg'; ?>" class="post-image" alt="Post cover">
                    </a>
                    
                    <div class="post-content">
                        <h2>
                            <a href="/myblog/public/posts/view/<?php echo $post->id; ?>" class="post-title-link">
                                <?php echo $post->title; ?>
                            </a>
                        </h2>
                        
                        <p class="post-excerpt"><?php echo Str::truncate($post->content, 180); ?></p>
                        
                        <div class="post-footer">
                            <div class="post-tags">
                                <span class="bullet"></span> <?php echo $post->category; ?>
                            </div>
                            
                            <?php if(Session::get('logged_in')): ?>
                                <div class="admin-actions">
                                    <a href="/myblog/public/posts/edit/<?php echo $post->id; ?>" class="edit-btn">
                                        <img src="/myblog/public/assets/img/edit-icon.png" alt="Editar" style="height:15px;">
                                    </a>
                                    <a href="/myblog/public/posts/delete/<?php echo $post->id; ?>" class="delete-btn" onclick="return confirm('¿Estás segura?');">
                                        <img src="/myblog/public/assets/img/delete-icon.png" alt="Borrar" style="height:15px;">
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            <?php else: ?>
            <p style="padding: 40px; text-align: center;">Todavía no hay posts. ¡Anímate a escribir el primero!</p>
        <?php endif; ?>
    </main>

</div>