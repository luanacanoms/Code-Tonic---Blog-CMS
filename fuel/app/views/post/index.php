<section class="hero-section">
    <div class="hero-text">
        <h1>¡Hablemos de <span>Código</span>!</h1>
        <p>Mezclando lógica de backend con un toque de estilo.</p>
    </div>
    <div class="hero-image">
        </div>
</section>

<div class="content-grid">
    
    <aside class="sidebar">
        <div class="box-sobre-mi">
            <h3 class="sidebar-title">Sobre mí</h3>
            <p>Texto sobre Mariana...</p>
        </div>
    </aside>

    <div class="posts-area">
        <?php if (empty($posts)): ?>
            <p style="text-align: center; color: var(--text-light); margin-top: 50px;">
                Aún no hay posts publicados. ¡Es hora de crear tu primer artículo!
            </p>
        <?php else: ?>
            <?php foreach ($posts as $post): ?>
                <div class="post-card">
                    
                    <img src="<?php echo !empty($post->image_url) ? $post->image_url : 'https://via.placeholder.com/243x243'; ?>" class="post-image" alt="Post Image">
                    
                    <div class="post-content">
                        <h2><?php echo $post->title; ?></h2>
                        <p><?php echo $post->excerpt; ?></p>
                        
                        <div class="post-tags" style="display: flex; align-items: center; justify-content: space-between;">
                            <span>📅 <?php echo date('d M Y', $post->created_at); ?></span>
                            <a href="/myblog/public/posts/view/<?php echo $post->id; ?>" style="color: var(--accent-purple); font-weight: 500; text-decoration: none; font-size: 14px;">Leer más →</a>
                        </div>
                    </div>

                    <?php if(Session::get('logged_in')) : ?>
                        <div class="post-actions">
                            <a href="/myblog/public/posts/edit/<?php echo $post->id; ?>" class="btn-edit-icon">✏️</a>
                            <form action="/myblog/public/posts/delete/<?php echo $post->id; ?>" method="POST" style="margin: 0;">
                                <button type="submit" class="btn-delete-icon">🗑️</button>
                            </form>
                        </div>
                    <?php endif; ?>
                    
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    
</div>