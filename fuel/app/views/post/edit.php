<style>
    .edit-wrapper { width: 600px; background: white; border-radius: 12px; padding: 50px; margin: 0 auto 50px auto; box-shadow: 0 4px 10px rgba(0,0,0,0.03); box-sizing: border-box; }
    .edit-wrapper h2 { text-align: center; color: var(--text-main); margin-top: 0; margin-bottom: 30px; font-weight: 500; font-size: 24px; }
    .form-group { margin-bottom: 20px; }
    .form-group label { display: block; font-size: 14px; font-weight: 500; margin-bottom: 8px; color: var(--text-main); }
    .form-control { width: 100%; height: 45px; border-radius: 6px; border: 1px solid #CECECE; padding: 0 15px; font-family: 'Poppins', sans-serif; box-sizing: border-box; outline: none; color: var(--text-main); }
    .form-control:focus { border-color: var(--logo-tonic); }
    textarea.form-control { height: auto; padding: 15px; resize: vertical; }
    .btn-submit { width: 100%; height: 48px; background: var(--accent-purple); color: white; border: none; border-radius: 8px; font-family: 'Poppins', sans-serif; font-size: 15px; font-weight: 500; cursor: pointer; transition: background 0.3s; margin-top: 20px; }
    .btn-submit:hover { background: var(--logo-tonic); }
    .btn-back { display: inline-flex; align-items: center; gap: 5px; color: var(--text-light); text-decoration: none; font-size: 14px; font-weight: 500; margin-bottom: 30px; transition: color 0.3s; }
    .btn-back:hover { color: var(--accent-purple); }
</style>

<div class="edit-wrapper">
    <a href="/myblog/public/posts" class="btn-back">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/></svg>
        Cancelar edición
    </a>

    <h2>Editar Post</h2>
    
    <form action="/myblog/public/posts/edit/<?php echo $post->id; ?>" method="POST">
        <div class="form-group">
            <label>Título del Post</label>
            <input type="text" name="title" class="form-control" value="<?php echo htmlspecialchars($post->title); ?>" required>
        </div>
        <div class="form-group">
            <label>Categoría (Tópico)</label>
            <input type="text" name="category" class="form-control" value="<?php echo htmlspecialchars($post->category); ?>" required>
        </div>

        <div class="form-group">
            <label>Slug (URL amigable)</label>
            <input type="text" name="slug" class="form-control" value="<?php echo isset($post->slug) ? htmlspecialchars($post->slug) : ''; ?>">
        </div>

        <div class="form-group">
            <label>Resumen</label>
            <textarea name="excerpt" class="form-control" rows="3"><?php echo isset($post->excerpt) ? htmlspecialchars($post->excerpt) : ''; ?></textarea>
        </div>

        <div class="form-group">
            <label>Ruta de la Imagen de Portada</label>
            <input type="text" name="image_url" class="form-control" value="<?php echo htmlspecialchars($post->image_url); ?>">
        </div>

        <div class="form-group">
            <label>Estado</label>
            <select name="status" class="form-control">
                <option value="Borrador" <?php echo (isset($post->status) && $post->status == 'Borrador') ? 'selected' : ''; ?>>Borrador</option>
                <option value="Publicado" <?php echo (isset($post->status) && $post->status == 'Publicado') ? 'selected' : ''; ?>>Publicado</option>
            </select>
        </div>

        <div class="form-group">
            <label>Contenido de tu post</label>
            <textarea name="content" class="form-control" rows="12" required><?php echo htmlspecialchars($post->content); ?></textarea>
        </div>
        
        <input type="hidden" name="send" value="1">
        <button type="submit" class="btn-submit">Actualizar Post</button>
    </form>
</div>