<div class="content-grid" style="display: block;"> 
    <div class="full-post-wrapper">
        
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
            
            <a href="/myblog/public/posts" class="btn-back" style="margin-bottom: 0;">
                ← Volver al inicio
            </a>

            <?php if(Session::get('logged_in')) : ?>
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

        <div class="full-post-header">
            <h1><?php echo $post->title; ?></h1>
            
            <div class="full-post-meta">
                <div class="post-tags">
                    <span class="bullet"></span> <?php echo $post->category; ?>
                </div>
                <span><?php echo date('d de F, Y', $post->created_at); ?></span>
            </div>
        </div>

        <img src="<?php echo $post->image_url ?: '/myblog/public/assets/img/first-fuel-project.jpg'; ?>" class="full-post-image" alt="Portada del post">

        <div class="full-post-body">
            <?php echo $post->content; ?>
        </div>
        
    </div>
</div>